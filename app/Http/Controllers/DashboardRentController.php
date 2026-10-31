<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Rent;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Routing\Controller;
use App\Models\BackgroundAdminPhoto;
use Illuminate\Support\Facades\Session;

class DashboardRentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Memperbarui status untuk peminjaman yang sudah selesai
        $rentsToUpdate = Rent::where('time_end_use', '<', Carbon::now())
                            ->where('status', '!=', 'selesai')
                            ->get();
    
        // Update status menjadi selesai
        foreach ($rentsToUpdate as $rent) {
            $rent->status = 'selesai';
            $rent->transaction_end = Carbon::now(); // Waktu selesai transaksi
            $rent->save();
        }
    
        // Filter hanya status "dipinjam" dan "dikembalikan"
        $adminRents = Rent::whereIn('status', ['dipinjam', 'selesai'])->latest()->paginate(10);

        $pinjamRuangBackground = BackgroundAdminPhoto::where('code', 'pinjamRuang')->first();
    
        return view('dashboard.rents.index', [
            'adminRents' => $adminRents, 
            'userRents' => Rent::where('user_id', auth()->user()->id)->get(),
            'title' => "Peminjaman",
            'rooms' => Room::all(),
            'pinjamRuangBackground' => $pinjamRuangBackground,
        ]);
    }    
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //     $validatedData = $request->validate([
    //         'room_id' => 'required',
    //         'time_start_use' => 'required',
    //         'time_end_use' => 'required',
    //         'purpose' => 'required|max:250',
    //     ]);
    //     $validatedData['user_id'] = auth()->user()->id;
    //     $validatedData['transaction_start'] = now();
    //     $validatedData['status'] = 'pending';
    //     $validatedData['transaction_end'] = null;

    //     Rent::create($validatedData);

    //     return redirect('/dashboard/rents')->with('rentSuccess', 'Peminjaman diajukan. Harap tunggu konfirmasi admin.');
    // }
    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'room_id' => 'required',
            'time_start_use' => 'required|date|after:today',
            'time_end_use' => 'required|date|after:time_start_use',
            'purpose' => 'required|max:250',
            'logo_bidang' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Opsional, hanya gambar
        ]);
        
        // Ambil data ruangan berdasarkan room_id
        $room = Room::find($validatedData['room_id']);
        
        // Periksa jika waktu yang dipilih tumpang tindih dengan peminjaman lain
        $overlap = Rent::where('room_id', $validatedData['room_id'])
                       ->where(function($query) use ($validatedData) {
                           $query->whereBetween('time_start_use', [$validatedData['time_start_use'], $validatedData['time_end_use']])
                                 ->orWhereBetween('time_end_use', [$validatedData['time_start_use'], $validatedData['time_end_use']])
                                 ->orWhere(function($query) use ($validatedData) {
                                     $query->where('time_start_use', '<=', $validatedData['time_start_use'])
                                           ->where('time_end_use', '>=', $validatedData['time_end_use']);
                                 });
                       })->exists();
        
        if ($overlap) {
            // Menampilkan notifikasi
            Session::flash('alert', [
                'avatar' => $room && $room->img ? asset('storage/' . $room->img) : null,
                'message' => 'Upss... Ruangan yang Anda pilih sudah digunakan pada waktu tersebut!'
            ]);
        
            return redirect()->back(); // Kembali ke halaman sebelumnya
        }
        
        // Simpan peminjaman
        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['transaction_start'] = now();
        $validatedData['status'] = 'pending';
        if ($request->hasFile('logo_bidang')) {
            $validatedData['logo_bidang'] = $request->file('logo_bidang')->store('logos', 'public');
        }
        
        $rent = Rent::create($validatedData);
        $bulanIndonesia = [
            'January' => 'Januari', 'February' => 'Februari', 'March' => 'Maret',
            'April' => 'April', 'May' => 'Mei', 'June' => 'Juni',
            'July' => 'Juli', 'August' => 'Agustus', 'September' => 'September',
            'October' => 'Oktober', 'November' => 'November', 'December' => 'Desember'
        ];
        
        $startDate = date('d F Y', strtotime($request->time_start_use));
        $startDate = strtr($startDate, $bulanIndonesia);
        $startTime = date('H:i', strtotime($request->time_start_use));
        
        $endDate = date('d F Y', strtotime($request->time_end_use));
        $endDate = strtr($endDate, $bulanIndonesia);
        $endTime = date('H:i', strtotime($request->time_end_use));

        
        // Ambil admin pertama dan kedua
        $admin1 = User::where('role_id', 1)->first();
        $admin2 = User::where('role_id', 1)->skip(1)->first(); // Ambil admin kedua
        
        // Pesan WhatsApp yang akan dikirim
        $message = "\u{1F514} *Pengajuan Peminjaman Ruangan Baru* \u{1F514}\n\n"
        . "\u{1F4CC} *Ruangan:* " . $rent->room->name . "\n\n"
        . "\u{1F552} *Waktu Mulai:* \n"
        . "  \u{1F4C5} *Tanggal:* " . $startDate . "\n"
        . "  \u{23F0} *Jam:* " . $startTime . " WIB\n\n"
        . "\u{1F552} *Waktu Selesai:* \n"
        . "  \u{1F4C5} *Tanggal:* " . $endDate . "\n"
        . "  \u{23F0} *Jam:* " . $endTime . " WIB\n\n"
        . "\u{1F3AF} *Keperluan:* " . ucfirst($request->purpose) . "\n\n"
        . "\u{2705} *Mohon Segera Diproses!* \n"
        . "Admin yang terhormat, silakan segera meninjau dan menyetujui permohonan ini agar ruangan dapat digunakan sesuai jadwal.\n\n"
        . "\u{1F4AC} Jika ada pertanyaan, silakan hubungi pemohon atau lakukan konfirmasi melalui sistem.\n\n"
        . "Terima kasih atas kerja samanya! \u{1F64C}";



        
        // Tentukan nomor WhatsApp yang akan dihubungi
        $adminPhone = null;
        
        // Pilih admin pertama jika ada
        if ($admin1 && !empty($admin1->nomor_handphone)) {
            $adminPhone = $admin1->nomor_handphone;
        }
        
        // Jika admin pertama tidak valid, pilih admin kedua
        if (!$adminPhone && $admin2 && !empty($admin2->nomor_handphone)) {
            $adminPhone = $admin2->nomor_handphone;
        }
    
        if ($adminPhone) {
            session()->flash('wa_message', $message);
            session()->flash('admin_phone', $adminPhone); // Simpan nomor admin yang valid
        } else {
            session()->flash('wa_message', 'Admin tidak dapat dihubungi.');
        }
    
        // Redirect ke halaman daftar peminjaman dengan pesan sukses
        return redirect('/daftarpinjam')->with('rentSuccess', 'Peminjaman diajukan. Harap tunggu konfirmasi admin.');
    }
    
    
    


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rent  $rent
     * @return \Illuminate\Http\Response
     */
    public function show(Rent $rent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rent  $rent
     * @return \Illuminate\Http\Response
     */
    public function edit(Rent $rent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rent  $rent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rent $rent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rent  $rent
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rent $rent)
    {
        Rent::destroy($rent->id);
        return redirect('/dashboard/rents')->with('deleteRent', 'Data peminjaman berhasil dihapus');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rent  $rent
     * @return \Illuminate\Http\Response
     */
    public function endTransaction($id)
    {
        $transaction = [
            'transaction_end' => now(),
            'status' => 'selesai',
        ];

        Rent::where('id', $id)->update($transaction);

        return redirect('/dashboard/rents');
    }

    public function exportPDF(Request $request)
    {
        // Ambil tanggal awal dan akhir dari request
        $startDate = $request->start_date;
        $endDate = $request->end_date;
    
        // Ambil data peminjaman berdasarkan rentang tanggal
        $adminRents = Rent::with('room', 'user')
            ->whereDate('time_start_use', '>=', $startDate)
            ->whereDate('time_start_use', '<=', $endDate)
            ->get();
    
        // Kirim variabel startDate, endDate, dan adminRents ke view
        $pdf = Pdf::loadView('dashboard.rents.export-book', compact('adminRents', 'startDate', 'endDate'));
    
        // Download file PDF dengan nama yang sesuai
        return $pdf->download('daftar_peminjaman_' . $startDate . '_to_' . $endDate . '.pdf');
    }
    
}

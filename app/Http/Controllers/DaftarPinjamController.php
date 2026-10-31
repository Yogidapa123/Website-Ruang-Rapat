<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rent;
use App\Models\Room;
use Carbon\Carbon;

class DaftarPinjamController extends Controller
{
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
        return view('daftarpinjam', [
            'userRents' => Rent::where('user_id', auth()->user()->id)->latest()->paginate(5),
            'title' => "Riwayat Peminjaman",
            'rooms' => Room::all(),
        ]);
    }
}

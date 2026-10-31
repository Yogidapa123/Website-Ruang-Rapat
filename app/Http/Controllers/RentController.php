<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Rent;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class RentController extends Controller
{
    // Method untuk menampilkan daftar peminjaman
    // public function index()
    // {
    //     $adminRents = Rent::with('room', 'user')->latest()->paginate(10)->withQueryString();

    //     return view('dashboard.rents.index', [
    //         'title' => "Daftar Peminjaman",
    //         'adminRents' => $adminRents, // Ubah nama variable sesuai dengan view
    //     ]);
    // }

    // // Method untuk mengekspor data ke PDF
    // public function exportPDF()
    // {
    //     $adminRents = Rent::with('room', 'user')->latest()->paginate(10)->withQueryString();
    //     $pdf = Pdf::loadView('pdf.export-book',[
    //         'adminRents' => $adminRents,
    //     ]);
    //     return $pdf->download('daftar_peminjaman.pdf'.Carbon::now()->timestamp. '.pdf');
    // }

    public function showData() {
        $now = Carbon::now();
    
        // Ambil data rents yang sesuai dengan tanggal hari ini, urutkan berdasarkan waktu mulai
        $dataToday = Rent::where('status', 'dipinjam')
            ->where('room_id', 1)
            ->whereDate('time_start_use', $now->toDateString()) // Hanya untuk hari ini
            ->orderBy('time_start_use', 'asc') // Urutkan berdasarkan waktu mulai
            ->get();
    
        // Ambil rent yang aktif sesuai jam sekarang
        $activeRent = $dataToday->first(function ($rent) use ($now) {
            return $now->between($rent->time_start_use, $rent->time_end_use);
        });
    
        // Jika tidak ada rent aktif, ambil rent berikutnya
        if (!$activeRent) {
            $activeRent = $dataToday->firstWhere('time_start_use', '>', $now);
        }
    
        return view('daftarPeminjaman', compact('activeRent', 'dataToday'));
    }
    
    
}

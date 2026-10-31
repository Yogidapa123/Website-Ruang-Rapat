<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PeminjamanRuangan;
use Carbon\Carbon;

class PeminjamanRuanganController extends Controller
{
    public function index()
    {
        $this->checkExpiredRentals(); // Jalankan pengecekan otomatis

        $adminRents = PeminjamanRuangan::paginate(10);
        return view('dashboard.rents.index', compact('adminRents'));
    }

    private function checkExpiredRentals()
    {
        $expiredRents = PeminjamanRuangan::where('status', 'dipinjam')
            ->where('time_end_use', '<', Carbon::now()) // Cek waktu selesai sudah lewat
            ->get();

        foreach ($expiredRents as $rent) {
            $rent->update([
                'status' => 'dikembalikan',
                'transaction_end' => Carbon::now()
            ]);
        }
    }
}

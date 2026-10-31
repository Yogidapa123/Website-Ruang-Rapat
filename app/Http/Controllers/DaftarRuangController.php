<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Rent;
use App\Models\Building;
use Carbon\Carbon;

class DaftarRuangController extends Controller
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
        
        return view('daftarruang', [
            'title' => "Daftar Ruang 123",
            'rooms' => Room::orderBy('created_at', 'desc')->paginate(6),
        ]);  
    }

    public function show(Room $room)
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

        return view('showruang', [
            'title' => $room->name,
            'room' => $room,
            'rooms' => Room::all(),
            'rents' => Rent::where('room_id', $room->id)->latest()->paginate(5), 
        ]);
    }
}

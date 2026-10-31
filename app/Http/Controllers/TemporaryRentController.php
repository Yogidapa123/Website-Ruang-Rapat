<?php

namespace App\Http\Controllers;

use App\Models\Rent;
use App\Models\Room;
use Illuminate\Http\Request;
use App\Models\BackgroundAdminPhoto;

class TemporaryRentController extends Controller
{
    public function index()
    {
        $pinjamSementaraBackground = BackgroundAdminPhoto::where('code', 'pinjamSementara')->first();
        return view('dashboard.temporaryRents.index', [
            'title' => "Daftar Peminjaman Sementara",
            'rents' => Rent::where('status', 'pending')->latest()->paginate(10),
            'pinjamSementaraBackground' => $pinjamSementaraBackground,
        ]);
    }

    public function acceptRents($id)
    {
        $rentStatus = [
            'status' => 'dipinjam',
        ];

        $rent = Rent::where('id', $id)->update($rentStatus);

        return redirect('/dashboard/temporaryRents');
    }

    public function declineRents($id)
    {
        $rentStatus = [
            'status' => 'ditolak',
        ];

        Rent::where('id', $id)->update($rentStatus);

        return redirect('/dashboard/temporaryRents');
    }
}

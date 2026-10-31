<?php

namespace App\Http\Controllers;

use App\Models\Rent;
use App\Models\Room;
use App\Models\Building;
use Illuminate\Http\Request;
use App\Models\BackgroundAdminPhoto;
use Illuminate\Support\Facades\Storage;


class DashboardRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ruanganBackground = BackgroundAdminPhoto::where('code', 'ruangan')->first();
        return view('dashboard.rooms.index', [
            'title' => "Daftar Ruangan",
            'rooms' => Room::paginate(10),
            'ruanganBackground' => $ruanganBackground,
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
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required',
                'img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:3048',
                'tempat' => 'required',
                'capacity' => 'required',
                'description' => 'required|max:250',
            ]);

            if ($request->file('img')) {
                $validatedData['img'] = $this->uploadImage($request, $validatedData['name']);
            }

            $validatedData['status'] = false;

            Room::create($validatedData);

            return redirect('/dashboard/rooms')->with('roomSuccess', 'Data ruangan berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect('/dashboard/rooms')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

        private function uploadImage($request, $name)
    {
        $imgPath = $request->file('img')->storeAs('public/assets/images/ruang/', $name . '.' . $request->file('img')->extension());
        
        // Simpan hanya path relatif dari `storage/app/public`
        return str_replace('public/', '', $imgPath);
    }

/**
     * Display the specified resource.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function show(Room $room)
    {
        if (!$room) {
            // Jika ruangan tidak ditemukan, bisa redirect ke halaman lain
            return redirect()->route('dashboard.rooms.index')->with('error', 'Ruangan tidak ditemukan.');
        }
    
        $imageUrls = [
            asset('img/lab-komputer.jpeg'),
            asset('img/lab-praktikum.jpeg'),
            asset('img/ruang-kelas.jpeg'),
        ];
        $randomImage = $imageUrls[array_rand($imageUrls)];
    
        return view('dashboard.rooms.show', [
            'title' => $room->name,
            'room' => $room,
            'rooms' => Room::all(),
            'rents' => Rent::where('room_id', $room->id)->get(),
            'randomImage' => $randomImage, 
        ]);
    }
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function edit(Room $room)
    {
        $buildings = Building::all();

        return view('dashboard.rooms.edit', [
            'title' => 'Edit Ruangan: ' . $room->name,
            'room' => $room,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $room = Room::findOrFail($id);
            
            $validated = $request->validate([
                'name' => 'required',
                'img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:3048',
                'tempat' => 'required',
                'capacity' => 'required',
                'description' => 'required|max:250',
            ]);
    
            // Process image upload if exists
            if ($request->file('img')) {
                // Hapus gambar lama jika ada
                if ($room->img && Storage::exists('public/' . $room->img)) {
                    Storage::delete('public/' . $room->img);
                }
            
                $imgPath = $request->file('img')->storeAs('public/assets/images/ruang/', $validated['name'] . '.' . $request->file('img')->extension());
            
                // Simpan hanya path relatif
                $validated['img'] = str_replace('public/', '', $imgPath);
            }
            
    
            $room->update($validated);
    
            return redirect('/dashboard/rooms')->with('roomSuccess', 'Data ruangan berhasil diubah');
        } catch (\Exception $e) {
            return redirect('/dashboard/rooms')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function destroy(Room $room)
    {
        Room::destroy($room->id);
        return redirect('/dashboard/rooms')->with('deleteRoom', 'Data ruangan berhasil dihapus');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BackgroundAdminPhoto;
use App\Models\BackgroundLoginPhoto;
use App\Models\BackgroundUtamaPhoto;
use Illuminate\Support\Facades\Storage;

class BackgroundFotoController extends Controller
{
    // Fungsi untuk menampilkan halaman background foto
    public function index()
    {
        // Mengambil semua data dari model BackgroundUtamaPhoto dan BackgroundLoginPhoto
        $utamaPhotos = BackgroundUtamaPhoto::all();
        $loginPhotos = BackgroundLoginPhoto::all();
        $adminPhotos = BackgroundAdminPhoto::all();

        $fotoBackground = BackgroundAdminPhoto::where('code', 'fotoBackground')->first();

        return view('dashboard.backrounds.index', [
            'title' => 'Background Foto',
            'utamaPhotos' => $utamaPhotos,
            'loginPhotos' => $loginPhotos,
            'adminPhotos' => $adminPhotos,
            'fotoBackground' => $fotoBackground,
        ]);
    }

    // Fungsi untuk menampilkan form tambah data (untuk background utama)
    public function createUtama()
    {
        return view('dashboard.backrounds.createUtama');
    }

    // Fungsi untuk menampilkan form tambah data (untuk background login)
    public function createLogin()
    {
        return view('dashboard.backrounds.createLogin');
    }

    // Fungsi untuk menampilkan form tambah data (untuk background login)
    public function createAdmin()
    {
        return view('dashboard.backrounds.createAdmin');
    }

    // Fungsi untuk menyimpan data baru (untuk background utama)
    public function storeAdmin(Request $request)
    {
        $request->validate([
            'code' => 'required|in:admin,user,ruangan,pinjamSementara,pinjamRuang,fotoBackground',
            'img' => 'required|image|mimes:jpeg,png,jpg,gif|max:3048',
        ], [
            'img.max' => 'Ukuran gambar tidak boleh lebih dari 2MB.',
            'img.required' => 'Gambar harus diunggah.',
            'img.image' => 'File yang diunggah harus berupa gambar.',
            'img.mimes' => 'Gambar harus berformat jpeg, png, jpg, atau gif.',
        ]);
        

        $imagePath = $request->file('img')->store('backgrounds', 'public');

        BackgroundAdminPhoto::create([
            'code' => $request->input('code'),
            'img' => $imagePath
        ]);

        return redirect()->route('background.index')->with('success', 'Background Foto Utama berhasil ditambahkan');
    }

    // Fungsi untuk menyimpan data baru (untuk background utama)
    public function storeUtama(Request $request)
    {
        $request->validate([
            'img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'img.max' => 'Ukuran gambar tidak boleh lebih dari 2MB.',
            'img.required' => 'Gambar harus diunggah.',
            'img.image' => 'File yang diunggah harus berupa gambar.',
            'img.mimes' => 'Gambar harus berformat jpeg, png, jpg, atau gif.',
        ]);
        

        $imagePath = $request->file('img')->store('backgrounds', 'public');

        BackgroundUtamaPhoto::create([
            'img' => $imagePath
        ]);

        return redirect()->route('background.index')->with('success', 'Background Foto Utama berhasil ditambahkan');
    }

    // Fungsi untuk menyimpan data baru (untuk background login)
    public function storeLogin(Request $request)
    {
        $request->validate([
            'img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Ubah max size ke 2MB
        ], [
            'img.max' => 'Ukuran gambar tidak boleh lebih dari 2MB.',
            'img.required' => 'Gambar harus diunggah.',
            'img.image' => 'File yang diunggah harus berupa gambar.',
            'img.mimes' => 'Gambar harus berformat jpeg, png, jpg, atau gif.',
        ]);
    
        $imagePath = $request->file('img')->store('backgrounds', 'public');
    
        BackgroundLoginPhoto::create([
            'img' => $imagePath
        ]);
    
        return response()->json(['success' => 'Background Foto Login berhasil ditambahkan']);
    }

    // Fungsi untuk menghapus foto (background utama)
    public function destroyAdmin($id)
    {
        $background = BackgroundAdminPhoto::findOrFail($id);
    
        if ($background->img) {
            Storage::disk('public')->delete($background->img);
        }

        $background->delete();
    
        return redirect()->route('background.index')->with('success', 'Background Foto Admin berhasil dihapus');
    }
    

    // Fungsi untuk menghapus foto (background utama)
    public function destroyUtama($id)
    {
        $background = BackgroundUtamaPhoto::findOrFail($id);
        if ($background->img) {
            Storage::disk('public')->delete($background->img);
        }
        $background->delete();

        return redirect()->route('background.index')->with('success', 'Background Foto Utama berhasil dihapus');
    }

    // Fungsi untuk menghapus foto (background login)
    public function destroyLogin($id)
    {
        $background = BackgroundLoginPhoto::findOrFail($id);
        if ($background->img) {
            Storage::disk('public')->delete($background->img);
        }
        $background->delete();

        return redirect()->route('background.index')->with('success', 'Background Foto Login berhasil dihapus');
    }

    // Fungsi untuk menampilkan form edit data (background utama)
    public function editAdmin($id)
    {
        $background = BackgroundAdminPhoto::findOrFail($id);
        return view('dashboard.backrounds.editAdmin', compact('background'));
    }

    // Fungsi untuk menampilkan form edit data (background utama)
    public function editUtama($id)
    {
        $background = BackgroundUtamaPhoto::findOrFail($id);
        return view('dashboard.backrounds.editUtama', compact('background'));
    }

    // Fungsi untuk menampilkan form edit data (background login)
    public function editLogin($id)
    {
        $background = BackgroundLoginPhoto::findOrFail($id);
        return view('dashboard.backrounds.editLogin', compact('background'));
    }

    // Fungsi untuk memperbarui data (background admin)

    public function updateAdmin(Request $request, $id)
    {
        $request->validate([
            'code' => 'nullable|in:admin,user,ruangan,pinjamSementara,pinjamRuang,fotoBackground',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:3048',  
        ]);

        $background = BackgroundAdminPhoto::findOrFail($id);

        if ($request->hasFile('img')) {
            $imagePath = $request->file('img')->store('backgrounds', 'public');
            $background->update(['img' => $imagePath]);
        }
        return redirect()->route('background.index')->with('success', 'Background Foto Utama berhasil diperbarui');
    }

    // Fungsi untuk memperbarui data (background utama)
    public function updateUtama(Request $request, $id)
    {
        $request->validate([
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:3048', 
        ]);

        $background = BackgroundUtamaPhoto::findOrFail($id);

        if ($request->hasFile('img')) {
            $imagePath = $request->file('img')->store('backgrounds', 'public');
            $background->update(['img' => $imagePath]);
        }
        return redirect()->route('background.index')->with('success', 'Background Foto Utama berhasil diperbarui');
    }


    // Fungsi untuk memperbarui data (background login)
    public function updateLogin(Request $request, $id)
    {
        $request->validate([
            'img' => 'required|image|mimes:jpeg,png,jpg,gif|max:3048',
        ]);

        $background = BackgroundLoginPhoto::findOrFail($id);
        $imagePath = $request->file('img')->store('backgrounds', 'public');
        $background->update(['img' => $imagePath]);

        return redirect()->route('background.index')->with('success', 'Background Foto Login berhasil diperbarui');
    }
}

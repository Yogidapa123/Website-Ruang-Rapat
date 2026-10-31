<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\BackgroundLoginPhoto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;



class LoginController extends Controller
{
    public function index()
    {
        // Ambil semua foto background dari database
        $backgroundPhotos = BackgroundLoginPhoto::all();

        // Kirim data foto ke view login
        return view('auth.login', [
            'title' => 'Login',
            'active' => 'login',
            'backgroundPhotos' => $backgroundPhotos
        ]);
    }

    // public function authenticate(Request $request)
    // {
    //     // Mengubah validasi email menjadi username
    //     $credentials = $request->validate([
    //         'username' => 'required',  // Menggunakan username
    //         'password' => 'required'
    //     ]);

    //     // Menyaring berdasarkan username dan bukan email
    //     $user = User::where('username', $request->username)->first(); // Mengubah pencarian berdasarkan username

    //     if (!$user) {
    //         // Jika user tidak ditemukan
    //         return back()->with('loginError', 'USERNAME ANDA BELUM TERSEDIA');
    //     }

    //     // Menyusun attempt login dengan username dan password
    //     if (Auth::attempt($credentials)) {
    //         $request->session()->regenerate();

    //         $user = Auth::user();
    //         if ($user->role_id === 1) {
    //             return redirect()->intended('/dashboard/admin');
    //         } elseif ($user->role_id === 2) {
    //             return redirect()->intended('/');
    //         }
    //     }

    //     // Jika login gagal
    //     return back()->with('loginError', 'Username atau Password Salah!');
    // }

    // public function logout(Request $request)
    // {
    //     Auth::logout();
    //     $request->session()->invalidate();
    //     $request->session()->regenerateToken();

    //     return redirect('/');
    // }
    public function authenticate(Request $request)
    {
        // Mengubah validasi email menjadi username
        $credentials = $request->validate([
            'username' => 'required',  // Menggunakan username
            'password' => 'required'
        ]);

        // Menyaring berdasarkan username dan bukan email
        $user = User::where('username', $request->username)->first(); // Mengubah pencarian berdasarkan username

        if (!$user) {
            // Jika user tidak ditemukan
            return back()->with('loginError', 'USERNAME ANDA BELUM TERSEDIA');
        }

        // Menyusun attempt login dengan username dan password
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Buat token random untuk disimpan di cookie
            $token = Str::random(64);

            // Set cookie token dengan waktu kedaluwarsa 1 hari
            Cookie::queue('user_token', $token, 1440); // 1440 menit = 1 hari

            $user = Auth::user();
            if ($user->role_id === 1) {
                return redirect()->intended('/dashboard/admin')->withCookie(cookie('user_token', $token, 1440));
            } elseif ($user->role_id === 2) {
                return redirect()->intended('/')->withCookie(cookie('user_token', $token, 1440));
            }
        }

        // Jika login gagal
        return back()->with('loginError', 'Username atau Password Salah!');
    }

    public function logout(Request $request)
{
    Auth::logout();

    // Hapus semua session
    session()->flush(); // Membersihkan semua data session
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    // Hapus cookie secara eksplisit
    Cookie::queue(Cookie::forget('XSRF-TOKEN'));
    Cookie::queue(Cookie::forget('laravel_session'));
    Cookie::queue(Cookie::forget('user_token'));

    return redirect('/')->withCookie(Cookie::forget('XSRF-TOKEN'))
                    ->withCookie(Cookie::forget('laravel_session'))
                    ->withCookie(Cookie::forget('user_token'));

}

}
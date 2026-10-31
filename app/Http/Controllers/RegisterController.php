<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
    public function index(){
        return view('auth.register',[
            'title' => 'Register',
            'active' => 'register'
        ]);
    }

    public function register(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|max:100',
            'nomor_handphone' => 'required|string|max:15|unique:users,nomor_handphone',
            'username' => 'required',
            'password' => 'required|min:4', 
        ]);
    
        // Enkripsi password
        $validatedData['password'] = bcrypt($validatedData['password']);
        $validatedData['role_id'] = 2;
    
        try {
            User::create($validatedData);
            return redirect('/login')->with('regisSuccess', 'Berhasil Register, Silahkan Login');
        } catch (\Exception $e) {
            return redirect('/register')->with('regiserror', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    

}

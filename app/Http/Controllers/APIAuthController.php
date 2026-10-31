<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class APIAuthController extends Controller
{
    public function register(Request $request){

        $validator = Validator::make($request->all(), [
            'name'=>'required',
            'nomor_induk' => 'required|min:8|unique:users,nomor_induk',
            'email'=>'required|email',
            'password'=>'required',
        ]);

        if($validator->fails()){
            return response()->json([
            'succes'=>false,
            'message'=>'Validasi Gagal',
            'data'=>$validator->errors()
            ]);
        }

        $input = $request->all();
        $input['role_id'] = 2;
        $input['password'] = bcrypt($input['password']);
        $user= User::create($input);

        $success['token'] = $user->createToken('auth_token')->plainTextToken;
        $success['name'] = $user->name;
        return response()->json([
            'success'=>true,
            'message'=>"Registrasi Berhasil",
            'data'=>$success
        ]);
    }
    public function login(Request $request){
        if(Auth::attempt (['email' => $request->email, 'password'=>$request->password])){

            $auth = Auth::user();
            $success['token'] =$auth->createToken('auth_token')->plainTextToken;
            $success['name'] = $auth->name;
            $success['email'] = $auth->email;
            return response()->json([
                'success'=>true,
                'message'=>'Login Berhasil',
                'data'=>$success
            ]);
        }else{
            return response()->json([
                'success'=>false,
                'message'=>'Cek Kembali Email dan Password',
            ]);
        }
    }
}

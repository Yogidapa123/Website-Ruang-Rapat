<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\BackgroundAdminPhoto;
use Illuminate\Auth\Events\Validated;

class DashboardUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userBackground = BackgroundAdminPhoto::where('code', 'user')->first();
        return view('dashboard.users.index', [
            'title' => 'Daftar Bidang',
            'roles' => Role::all(),
            'users' => User::where('role_id', 2)->paginate(10),
            'userBackground' => $userBackground,
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
        $validatedData = $request->validate([
            'name' => 'required|max:100',
            'nomor_handphone' => 'required|min:8|unique:users,nomor_handphone',
            'username' => 'required|unique:users,username',
            'password' => 'required|min:4', 
            'role_id' => 'required'
        ]);
    
        $validatedData['password'] = bcrypt($validatedData['password']);
    
        try {
            User::create($validatedData);
            return redirect('/dashboard/users')->with('userSuccess', 'Data Bidang berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect('/dashboard/users')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $user = User::findOrFail($id);
        $validated = $request->validate( [  
            'name' => 'nullable|max:100',
            'username' => 'nullable',
            'nomor_handphone' => 'nullable|min:12',
            'role_id' => 'nullable',
        ]);
    
        $user->update($validated);
    
        return redirect('/dashboard/users')->with('userSuccess', 'Data Bidang berhasil diubah');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        User::destroy($user->id);
        return redirect('/dashboard/users')->with('deleteUser', 'Hapus data Bidang berhasil');
    }

    public function makeAdmin($id)
    {
        $userData = [
            'role_id' => 1,
        ];

        User::where('id', $id)->update($userData);

        return redirect('/dashboard/admin')->with('adminSuccess', 'Data admin berhasil ditambahkan');
    }
}

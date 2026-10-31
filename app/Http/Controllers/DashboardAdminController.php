<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\BackgroundAdminPhoto;

class DashboardAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $adminBackground = BackgroundAdminPhoto::where('code', 'admin')->first();
        return view('dashboard.admin.index', [
            'title' => "Daftar Admin",
            'admins' => User::where('role_id', 1)->get(),
            'users' => User::where('role_id', '<', 2)->get(),
            'adminBackground' => $adminBackground,
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
            'nomor_handphone' => 'required|min:12|unique:users,nomor_handphone',
            'username' => 'required',
            'password' => 'required|min:4'
        ]);

        $validatedData['role_id'] = 1;

        $validatedData['password'] = bcrypt($validatedData['password']);

        User::create($validatedData);

        return redirect('/dashboard/admin')->with('adminSuccess', 'Data admin berhasil ditambahkan');
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
    return view('dashboard.admin.edit', compact('user'));
}


    /**
     * Update the specified resource in storage.
     *
 * @param  \Illuminate\Http\Request  $request
 * @param  \App\Models\User  $user
 * @return \Illuminate\Http\Response
 */
public function update(Request $request, $id)
{
    $user = User::findOrFail($id);
    // Aturan validasi default
    $validated = $request->validate([
        'name' => 'nullable|max:100',
        'username' => 'nullable',
        'nomor_handphone' => 'nullable|min:12',
    ]);

    // Validasi data yang dikirim
    $user->update($validated);

    return redirect('/dashboard/admin')->with('adminSuccess', 'Data Admin berhasil diubah');
}




    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $admin)
    {
        $admin->delete();
        return redirect('/dashboard/admin')->with('deleteAdmin', 'Hapus data admin berhasil');
    }
    

    public function removeAdmin($id)
    {
        $adminData = [
            'role_id' => 1
        ];

        User::where('id', $id)->update($adminData);

        return redirect('/dashboard/admin');
    }
}

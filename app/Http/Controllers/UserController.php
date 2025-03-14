<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
// fungsi untuk menampilkan daftar akun user dengan pagination
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $data_user = User::paginate($perPage);
        return view('manajemen.pegawai', compact('data_user','perPage'));
    }

    /**
     * Show the form for creating a new resource.
     */
// fungsi untuk menampilkan form untuk menambahkan akun user
    public function create()
    {
        return view('manajemen.create');
    }

    /**
     * Store a newly created resource in storage.
     */
// fungsi untuk menyimpan data akun user ke database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:5|confirmed',
        ]);
        
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = $request->password;
            $user->role = 'pegawai';
            $user->save();

            return redirect('/pegawai');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
// fungsi untuk menampilkan form untuk mengedit data akun user tertentu berdasarkan id
    public function edit($user_id)
    {
        $user = User::find($user_id);
        return view('manajemen.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
// fungsi untuk memperbarui data akun user berdasarkan id di database
    public function update(Request $request, $user_id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'nullable|min:5',
        ]);

            $user = User::find($user_id);
            $user->name = $request->name;
            $user->email = $request->email;

            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }
            
            $user->save();

        return redirect('/pegawai');
    }

    /**
     * Remove the specified resource from storage.
     */
// fungsi untuk menghapus data akun user berdasarkan id dari database
    public function destroy($user_id)
    {
        $user = User::find($user_id);
        $user->delete();
        return redirect('/pegawai');
    }

// fungsi untuk mencari akun user berdasarkan nama
    public function search(Request $request)
    {
        $cari = $request->nama;
        $perPage = $request->input('per_page', 10); 

        $data_user = User::where('name', 'like', "%" . $cari . "%")
                        ->paginate($perPage);

        $jumlah_user = User::count();

        return view('manajemen.pegawai', [
            'data_user' => $data_user,
            'cari' => $cari ?? null, 
            'jumlah_user' => $jumlah_user,
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserAPIController extends Controller
{
   
    public function index()
    {
        $usersaatini = Auth::user();

        if ($usersaatini->role == 1) {
            $users = User::all();
            return response()->json([
                'type' => 'index',
                'status' => 'success',
                'data' => $users
            ], 200);
        }
        else {
            return response()->json([
                'type' => 'index',
                'status' => 'success',
                'data' => $usersaatini
            ], 200);
        }
    }

    public function store(Request $request)
    {
        $usersaatini = Auth::user();

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|max:255|unique:users',
            'password' => 'required|min:8',
            'role' => 'required|integer',
        ]);

        if ($usersaatini->role == 1) {
        $user = new User;
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->password =  Hash::make($validatedData['password']);
        $user->role = $validatedData['role'];
        $user->save();

        return response()->json([
            'type' => 'store',
            'status' => 'success',
            'data' => $user
        ], 200);

        } else {
            return response()->json([
                'type' => 'store',
                'status' => 'error',
                'reason' => 'Anda Tidak Memiliki Hak Akses'
            ], 200);
        }

    }

    public function show(User $user)
    {
        return response()->json([
            'type' => 'show',
            'status' => 'success',
            'data' => $user
        ], 200);
    }

    public function edit(User $user)
    {
        return response()->json([
            'type' => 'edit',
            'status' => 'success',
            'data' => $user
        ], 200);
    }

    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|max:255',
            'role' => 'required|integer',
        ]);

        $usersaatini = Auth::user();
        /** 
         * Cek Hak Akses User saat ini, jika admin maka bisa memodifikasi semua member, jika member maka hanya bisa memodifikasi akunnya sendiri
         * **/
        if ($usersaatini->role == 1) {
            
            $user->name = $validatedData['name'];
            $user->email = $validatedData['email'];
            $user->role = $validatedData['role'];

            if (!empty($request['password'])) {
                $user->password = Hash::make($request['password']);
            }

            $user->save();

            return response()->json([
                'type' => 'update',
                'status' => 'success',
                'data' => $user
            ], 200);

        } else if ($usersaatini->role != 1 & $usersaatini->id == $user->id) {

            $user->name = $validatedData['name'];
            $user->email = $validatedData['email'];

            if (!empty($request['password'])) {
                $user->password = Hash::make($request['password']);
            }

            $user->save();

            return response()->json([
                'type' => 'update',
                'status' => 'success',
                'data' => $user
            ], 200);

        } else {
            return response()->json([
                'type' => 'update',
                'status' => 'error',
                'reason' => 'Anda Tidak Memiliki Hak Akses'
            ], 200);
        }
    }

    public function destroy(User $user)
    {
        $usersaatini = Auth::user();

        if ($usersaatini->role == 1) {
            $user->delete();
            return response()->json([
                'type' => 'delete',
                'status' => 'sukses',
                'reason' => 'Anda Telah Menghapus USER'
            ], 200);
        } else {
            return response()->json([
                'type' => 'delete',
                'status' => 'error',
                'reason' => 'Anda Tidak Memiliki Hak Akses'
            ], 200);
        }
    }
}

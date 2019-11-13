<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $usersaatini = Auth::user();

        if ($usersaatini->role == 1) {
            $users = User::all();
            return view('user.index')->with('users',$users);
        }
        else {
            return redirect()->route('user.show', $usersaatini->id);
        }
    }

    public function create()
    {
        return view('user.create');
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
        }
        
        return redirect()->route('user.index');
    }

    public function show(User $user)
    {
        return view('user.show')->with('user',$user);
    }

    public function edit(User $user)
    {
        return view('user.edit')->with('user', $user);
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

            return redirect()->route('user.show', $user->id);

        } else if ($usersaatini->role != 1 & $usersaatini->id == $user->id) {

            $user->name = $validatedData['name'];
            $user->email = $validatedData['email'];

            if (!empty($request['password'])) {
                $user->password = Hash::make($request['password']);
            }

            $user->save();

            return redirect()->route('user.show', $user->id);

        } else {
            return redirect()->route('user.show', $usersaatini->id);
        }
    }

    public function destroy(User $user)
    {
        $usersaatini = Auth::user();

        if ($usersaatini->role == 1) {
            $user->delete();
        }
        return redirect()->route('user.index');
    }
}

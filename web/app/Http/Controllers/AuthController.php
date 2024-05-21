<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index(){
        return view('login');
    }

    public function proseslogin(Request $req){
        $credentials = $req->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(auth()->attempt($credentials)){
            $req->session()->regenerate();
            if(auth()->user()->role_id === 1){
                return redirect()->intended('/superadmin');
            }else if(auth()->user()->role_id === 2){
                return redirect()->intended('/guru');
            }else{
                return redirect()->intended('/siswa');
            }
        }

        return back()->with('error', 'Email atau Password tidak ditemukan');
    }

    public function logout(Request $req){
        auth()->logout();
        $req->session()->invalidate();
        $req->session()->regenerateToken();
        return redirect('/');
    }
}

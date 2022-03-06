<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function formLogin() {
        // Check auth
        if (Auth::check()) { 
            // Login Success redirect to dashboard
            return redirect()->route('dashboard');
        }
        // View
        return view('loginRS');
    }

    public function login(Request $request) {
        // Validation Input
        $request->validate([
            'username'    => 'required',
            'email'       => 'required',
            'password'    => 'required',
        ]);
        // Set data login
        $data = [
            'hospital_id'   => $request->input('username'),
            'email'         => $request->input('email'),
            'password'      => $request->input('password'),
        ];
        // Login
        Auth::attempt($data);
        // Redirect
        if (Auth::check()) {
            //Login Success
            return redirect()->route('dashboard');
        } else { // false
            //Login Fail
            Session::flash('error', 'ID, Email, atau password salah! Silahkan hubungi pusat bantuan apabila masih tidak dapat diakses.');
            return redirect()->route('login');
        }
    }

    public function logout() {
        // Logout
        Auth::logout();
        // Redirect
        return redirect()->route('landing');
    }
}

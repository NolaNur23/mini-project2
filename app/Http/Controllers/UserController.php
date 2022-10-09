<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    public function index()
    {
        if (Auth::user()) {
            return redirect('/dashboard');
        }
        return view('login');
    }
    public function login(Request $r)
    {
        $user = Auth::attempt(['email' => $r->email, 'password' => $r->password]);
        if ($user) {
            return redirect()->to('/user/dashboard');
            session()->flash('message', 'Selamat Datang' . $r->name);
        } else {
            session()->flash('message', 'Failed to login! your email or password is incorrect.');
            return Redirect::back();
        }
    }
}

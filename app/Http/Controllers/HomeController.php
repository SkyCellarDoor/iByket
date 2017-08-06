<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    public function index()
    {

        $role = Auth::user()->role;

        $messages = 1;


        return view('home')
            ->with(['messages' => $messages])
            ->with('role', $role);
    }

    public function logout()
    {

        Auth::logout();
        return view('auth.login');
    }

    public function reg()
    {

        return view('auth.register');
    }
}

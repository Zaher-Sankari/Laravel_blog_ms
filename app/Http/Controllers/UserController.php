<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->user()->usertype == 'admin') {
            return view('admin.dashboard');
        } else {
            return redirect()->route('dashboard');
        }
    }

    public function home(Request $request)
    {
        $user = $request->user();

        if ($user->usertype == 'user') {
            $favorites = $user->favorites;
            return view('dashboard', compact('favorites'));
        } else {
            return redirect()->route('admin.dashboard');
        }
    }
}

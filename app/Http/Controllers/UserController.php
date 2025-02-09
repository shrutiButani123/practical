<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        // dd(auth()->user());
        $users = User::all();
        return view('user.index', compact('users'));
    }
}

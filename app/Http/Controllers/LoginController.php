<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function create(){
        if(auth()->check()){
            return redirect()->route('dashboard');
        }
        return view('auth.login');
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            if (!auth()->user()->verified) {
                Auth::logout(); // Log out the user if not verified
                return redirect()->route('login.create')->with('error', 'Your account is not verified. Please verify your account before logging in.');
            }
            
            return redirect()->route('dashboard'); 
        }
        return redirect()->back()->with('error', 'Invalid credentials');
    }

    public function logout(){
        Auth::logout();
        // session()->flush();        
        return redirect()->route('login.create');
    }
}

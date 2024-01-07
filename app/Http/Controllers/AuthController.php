<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function create(){
        return inertia('Auth/Login');
    }

    public function store(Request $request){
        $validatedRequest=$request->validate([
            'email'=>'required|string|email',
            'password'=>'required|string'
        ]);
        if(!Auth::attempt($validatedRequest,true)){
            throw ValidationException::withMessages([
                'email'=>'認証に失敗しました。'
            ]);
        }
        $request->session()->regenerate();
        return redirect()->intended('/listing');
    }

    public function destroy(Request $request){
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('listing.index');
    }


}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
    public function index(){
        return view('register.index');
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'username'=> 'required|max:255|unique:users|min:3',
            'email'=> 'required|max:255|unique:users',
            'password'=> 'required|max:255|min:5|confirmed',
            ]);
        
        User::create($validatedData);
        
        $request->session()->flash('success','Registrasi Berhasil');

        return redirect('/login');
    }
}

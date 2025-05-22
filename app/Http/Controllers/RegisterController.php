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
        // return request()->all();
        $validatedData = $request->validate([
            'name'=> 'required|max:255',
            'username'=> 'required|max:255|unique:users|min:3',
            'email'=> 'required|max:255|unique:users',
            'password'=> 'required|max:255|min:5',
            ]);
        
        User::create($validatedData);
        
        $request->session()->flash('success','Registrasi Berhasil');

        return redirect('/login');
    }
}

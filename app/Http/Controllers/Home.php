<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class Home extends Controller
{
    public function index(){
        $dataUser = User::whereNotNull('id')->get(["name", "username", "email"]);
        return view('team', ['data'=> $dataUser]);
    }

}

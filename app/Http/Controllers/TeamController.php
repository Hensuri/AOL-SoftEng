<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class TeamController extends Controller
{
    //
    public function index(){
        $dataUser = User::whereNotNull('id')->get(["username", "email"]);
        return view('team', ['data'=> $dataUser]);
    }
}

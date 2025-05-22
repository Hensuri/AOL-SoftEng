<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Home extends Controller
{
    public function index(){
        return view('team');
    }

    public function hallo(){
        return view('main-content');
    }
}

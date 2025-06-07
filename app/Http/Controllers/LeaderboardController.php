<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class LeaderboardController extends Controller
{
    public function index(){
        $users = User::select('users.id', 'users.username', 'users.image', DB::raw('SUM(game_results.score) as total_score'))
        ->join('game_results', 'users.id', '=', 'game_results.user_id')
        ->groupBy('users.id', 'users.username', 'users.image')
        ->orderByDesc('total_score')
        ->limit(10)
        ->get();

        return view("leaderboard", [
            "users" => $users, 
        ]);
    }
}

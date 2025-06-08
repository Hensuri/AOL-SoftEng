<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    public function index(){

        if(Auth::check()){
            $user = Auth::user();
            $totalScore = $user->gameResults()->sum('score');
            return view('dashboard', [
                'totalScore' => $totalScore
            ]);
        }else{
            return redirect("/");
        }
    }

    public function update($id, Request $request){
        $user = Auth::user();
        $rules = [];
        if($user->username != $request->username){
            $rules["username"] = "required|max:255|unique:users|min:3";
        }
        if($user->email != $request->email){
            $rules["email"] = "required|max:255|unique:users";
        }

        $validatedData = $request->validate($rules);

        if($request->file('image')){
            $validatedData['image'] = $request->file('image')->store('profile');
        }
        // dd($user->id, $request->password, $user->password); 
        if (Auth::attempt(['id' => $user->id, 'password' => $request->password])) {
            User::where("id", Auth::user()->id)->update($validatedData);
            return redirect("/dashboard")->with("success", "Berhasil Update Data Anda");
        }
        return back()->with('validationError', 'Gagal Mengganti data');
    }
}

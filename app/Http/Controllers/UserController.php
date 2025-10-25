<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    public function register(Request $request){
        $fields = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed'
        ]);
        //dd($fields);
        $fields['password']=Hash::make($fields['password']);
        $user = User::create($fields);
        auth()->login($user);
        return redirect("/");
    }
    public function logout(){
        auth()->logout();
        return redirect("/");
    }
    public function login(Request $request){
        $fields = $request->validate([
            'login_email' => 'required',
            'login_password' => 'required'
        ]);
        if(auth()->attempt(['email'=>$fields['login_email'],'password'=>$fields["login_password"]])){
            $request->session()->regenerate();
        }
        return redirect("/");
    }
}

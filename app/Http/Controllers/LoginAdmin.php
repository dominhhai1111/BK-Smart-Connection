<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginAdmin extends Controller
{
    public function loginAdmin(Request $request){
        $data = [
            'username' => $request->username,
            'password' => $request->passwoed,
            'level' => 3
        ];

        if(Auth::attempt($data)){
            redirect('/admin');
        }else {
            redirect('/login');
        }
    }
}

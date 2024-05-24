<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'login' => 'required',
            'password' => 'required',
            '_token' => 'required'
        ]);

        $login = $request->input('login');
        $password = $request->input('password');

        $user = DB::table('employee')
            ->where('login', $login)
            ->where('password', $password)
            ->first();

        if ($user) {
            return "Приветствую, " . htmlspecialchars($user->name);
        } else {
            return "Неверные имя или пароль";
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|regex:/^[a-zA-Z]+$/',
            'email' => 'required|email',
            'role' => 'required|boolean',
            'password' => 'required|string|min:6'
        ]);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('login');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6'
        ]);

        if($validator->fails())
        {
            return redirect('/login')->withErrors($validator)->withInput();
        }

        $credentials = $request->only('email', 'password');
        if(Auth::attempt($credentials))
        {
            return redirect('/dashboard');
        }
        else
        {
            return redirect('/login')->with('loginError', 'Invalid Credentials');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}

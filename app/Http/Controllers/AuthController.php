<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function signup(){
        return view('auth/signup');
    }

    public function registr(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required|unique:\App\Models\User',
            'password'=>'required|min:6'
        ]);

        $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password)
        ]);
        $token = $user->createToken('MyAppToken')->plainTextToken;
        // $user->save();
        $response = [
            'user'=>$user,
            'token'=>$token
        ];
        return response()->json($response, 201);
        // return redirect()->route('login');
    }

    public function login(){
        // return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'email'=>'required|email',
            'password'=>'required|min:6'
        ]);

        $credentials = [
            'email'=>request('email'),
            'password'=>request('password')
        ];

        if(!Auth::attempt($credentials))
        {
            return response('Bad login', 401);
        }

        $user = User::where('email', request('email'))->first();
        $token = $user->createToken('MyAppToken')->plainTextToken;
        $response = [
            'user'=>$user,
            'token'=>$token
        ];
        return response()->json($response, 201);

        // return back()->withErrors([
        //     'email' => 'The provided credentials do not match our records.',
        // ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return response(['Message'=>'Log out'], 201);
        // $request->session()->invalidate();
        // $request->session()->regenerateToken();
        // return redirect('/');
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\User;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class OtherController extends Controller
{
    public function verify(Request $request)
    {
        $user = User::find($request->route('id'));

        DB::table('users')
            ->where('id', $user->id)
            ->update(['email_verified_at' => now()]);
        Auth::login($user);

        return view('home');
    }

    public function login(Request $request)
    {
        $credentials = $request ->validate([
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:6',
        ]);

        if (!Auth::attempt($credentials)) {
            return redirect()->route('login');
        }

        Auth::user();

        if (is_null($request->user()->email_verified_at) || !$request->user()) {
            return response("Verifie ton mail frero", 403);
        }
        return view('/home');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/loginPage');
    }
}

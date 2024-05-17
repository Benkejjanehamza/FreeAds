<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\Utilisateur;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $user->sendEmailVerificationNotification();

        return view('confirmMail');
    }

    //DELETE ACCOUNT

    public function deleteAccount()
    {
        $user = Auth::user();

        $user->delete();
        return view('inscription');
    }

    //READ USER INFO
    public function read()
    {
        $user = Auth::user();
        return view('myProfil', ['user' => $user]);
    }

    public function updateInfo(Request $request)
    {
        $user = Auth::user();

        $rules = [
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $dataToUpdate = [];
        if ($request->filled('name')) {
            $dataToUpdate['name'] = $request->name;
        }
        if ($request->filled('email')) {
            $dataToUpdate['email'] = $request->email;
        }
        if ($request->filled('password')) {
            $dataToUpdate['password'] = bcrypt($request->password);
        }

        if (!empty($dataToUpdate)) {
            $user->update($dataToUpdate);
            $success = 'Information bien mise à jour !';
            return view('home', ['success' => $success]);
        }

        return redirect()->back()->with('error', 'Aucune information fournie à mettre à jour.');
    }

}

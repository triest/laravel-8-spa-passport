<?php

namespace App\Http\Controllers;


use App\Http\Requests\Auth\UserRegistrationRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{


    public function showRegistrationForm()
    {
        return view('auth.register');
    }


    public function register(UserRegistrationRequest $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json($user);
    }
}

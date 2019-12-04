<?php

namespace App\Services;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
class AuthService
{
    public function login($request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $success['token'] = $user->createToken('MyApp')->accessToken;
            $success['name'] = $user->name;
             return $success;
        }
    }

    public function register($input)
    {
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        return $user;
    }

    public function logout()
    {

    }
}

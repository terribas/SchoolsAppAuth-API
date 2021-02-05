<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:55',
            'email' => 'email|required|unique:users',
            'password' => 'required|confirmed'
        ]);

        $validatedData['password'] = bcrypt($request->password);

        $user = User::create($validatedData);

        $accessToken = $user->createToken('authToken')->accessToken;
        
        $user->token = $accessToken;
        //Prefiero que token forme parte del nivel User para que sea más legible en el cliente.
        
        return response()->json($user, 200);

        //return response([ 'user' => $user, 'access_token' => $accessToken]);
    }

    public function login(Request $request)
    {
        $loginData = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if (!auth()->attempt($loginData)) {
            return response(['message' => 'Invalid Credentials']);
        }
        
        $user = auth()->user();
        
        $user->token = auth()->user()->createToken('authToken')->accessToken;
        //Prefiero que token forme parte del nivel User para que sea más legible en el cliente.
        
        
        return response()->json($user, 200);
        
        
        
        
        //$accessToken = auth()->user()->createToken('authToken')->accessToken;

        //return response(['user' => auth()->user(), 'access_token' => $accessToken]);

    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use function GuzzleHttp\Promise\all;

class AuthController extends Controller
{

    public function register(Request $request)
    {

        $this->validate($request, [
            'firstname'     => 'required',
            'lastname'      => 'required',
            'email'         =>  'required',
            'password'      =>  'required|confirmed',
            'phone'         =>  'required'
        ]);
    
        $user = User::create([
            'firstname'     => $request->firstname,
            'lastname'      => $request->lastname,
            'email'         => $request->email,
            'phone'         => $request->phone,
            'password'      => Hash::make($request->password),
        ]);

        $user_role = UserRole::create([
            'user_id'     => $user->id,
            'role_id'      => 2,
        ]);  


        return response()->json([
            'message' => 'registration successful'
        ],201);
    }
    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid login details'
            ], 401);
        }

        $user = User::where('email', $request['email'])->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            "status" => "success",
            "access_token" => $token,
            "token_type" => 'Bearer',
            "user" => $user
        ]);
    }
    public function logout(Request $request)
    {
        session()->flush();
        session()->put('is_login', false);
        return redirect()->route('login');
    }
}

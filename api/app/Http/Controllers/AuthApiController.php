<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use User;
use JWTAuth;
use Auth;

class AuthApiController extends Controller
{
    public function users()
    {
        return \App\User::all();
    }

    public function deleteUser($id)
    {
        JWTAuth::parseToken()->authenticate();

        $deleteUser = \App\User::find($id);

        $deleteUser->delete();

        //Return new users list after the delete
        return \App\User::all();
    }

    public function register(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password'  => 'required|min:3|confirmed',
        ]);
        if ($validate->fails())
        {
            return response()->json([
                'status' => 'error',
                'errors' => $validate->errors()
            ], 422);
        }
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        return response()->json(['status' => 'success'], 200);
    }

    public function login() {
        // get email and password from request
        $credentials = request(['email', 'password']);
        
        // try to auth and get the token using api authentication
        if (!$token = auth('api')->attempt($credentials)) {
            // if the credentials are wrong we send an unauthorized error in json format
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return response([
            'status' => 'success',
            'token' => $token,
            'expires' => auth('api')->factory()->getTTL() * 60, // time to expiration
        ])
        ->header('Authorization', $token);

    }

    public function logout()
    {
        Auth::guard('api')->logout();

        return response()->json([
            'status' => 'success',
            'message' => 'logout'
        ], 200);
    }

    public function user(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();

        //get the current user from the token
        $currentUser = $user;

        //get the user role
        $role = $currentUser->roles->first()->id;

        return response()->json([
            'status' => 'success',
            'data' => [ 'role'  => $role,
            'userId' => $currentUser->id,
            'name'  => $currentUser->name,
            'email' => $currentUser->email ],
        ]);
    }
}

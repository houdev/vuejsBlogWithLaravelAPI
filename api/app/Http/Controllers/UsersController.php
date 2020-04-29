<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JWTAuth;

class UsersController extends Controller
{
    public function view()
    {
        return \App\User::all();
    }

    public function store(Request $request)
    {
        
    }

    public function update($id, Request $request)
    {
        JWTAuth::parseToken()->authenticate();

        $updateUser = \App\User::find($id);

        $updateUser->name      = $request->newName;
        $updateUser->email     = $request->newEmail;
        $updateUser->password  = bcrypt($request->newPass);

        $updateUser->save();

        //Return new Users list after the update
        return \App\User::all();
    }

    public function destroy($id)
    {
        JWTAuth::parseToken()->authenticate();

        $deleteUser = \App\User::find($id);

        $deleteUser->delete();

        //Return new users list after the delete
        return \App\User::all();
    }
}

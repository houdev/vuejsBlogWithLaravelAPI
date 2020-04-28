<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use JWTAuth;

class UsersController extends Controller
{
    public function view()
    {
        return \App\User::orderBy('id', 'asc')->paginate(3);
    }

    public function store(Request $request)
    {
        JWTAuth::parseToken()->authenticate();

        $adminRole  = \App\Role::where('name', 'admin')->first();
        $authorRole = \App\Role::where('name', 'author')->first();

        $validateUser = Validator::make($request->all(),[
            'name' => 'required|min:4',
            'email' => 'required|email|unique:users|min:6',
            'password' => 'required|min:8',
        ]);

        if($validateUser->fails()){
            return response()->json([
                'error' => 'The validation failed, please check the entered details'
            ]);
        }

        $newUser = \App\User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->pass)
        ]);

        if($request->role == 'Author'){
            $newUser->roles()->attach($authorRole);
        }
        elseif($request->role == 'Admin'){
            $newUser->roles()->attach($adminRole);
        }

        //Return success message and new user list after adding new user
        return response()->json([
            "message" => "User Has Been Added Successfully",
            "data"    => \App\User::all()
        ]);
    }

    public function update($id, Request $request)
    {
        JWTAuth::parseToken()->authenticate();

        $validateUser = Validator::make($request->all(),[
            'name' => 'required|min:4',
            'email' => 'email|min:6',
            'pass' => 'required|min:8',
        ]);

        if($validateUser->fails()){
            return response()->json([
                'error' => 'The validation failed, please check the entered details'
            ]);
        }

        $updateUser = \App\User::find($id);

        // Check if the user want to change the picture or not
        if($request->hasFile('picture')){

            // If the user choose to upload new picture then upload it and update it

            $picture = $request->file('picture');
            $storePath = public_path() . '/users/pictures/';
            $pictureName = 'user_' . $id . '.' . $picture->getClientOriginalExtension();

            $picture->move($storePath, $pictureName);
            $pictureURL = url('/users/pictures/' . $pictureName);

            $updateUser->picture = $pictureURL;
        }

        $updateUser->name      = $request->name;
        $updateUser->email     = $request->email;
        $updateUser->password  = bcrypt($request->pass);

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

    public function searchUsername(Request $request)
    {
        $username = $request->username;

        $user = \App\User::where('name', 'LIKE', "%{$username}%")
            ->orderBy('created_at', 'desc')
            ->paginate(3);

        return $user;
    }
}

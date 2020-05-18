<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JWTAuth;
use App\User;

class UploadController extends Controller
{
    public function store(Request $request)
    {
        if(!$request->hasFile('picture')){
            return response()->json([
                'upload file not found', 400
            ]);
        }

        //Get the current user from the token
        $currentUser = JWTAuth::parseToken()->authenticate();

        $picture = $request->file('picture');
        $storePath = public_path() . '/users/pictures/';
        $pictureName = 'user_' . $currentUser->id . '.' . $picture->getClientOriginalExtension();

        $picture->move($storePath, $pictureName);
        $pictureURL = url('/users/pictures/' . $pictureName);

        //Update the current user's picture
        $user = User::find($currentUser->id);
        $user->picture = $pictureURL;
        $user->save();

        return response()->json([
            'Picture has been updated successfully',
        ]);
    }
}

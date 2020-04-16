<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class APILogoutController extends Controller
{
    public function logout()
    {
        Auth::guard('api')->logout();

        return response()->json([
            'status' => 'success',
            'message' => 'logout'
        ], 200);
    }
}

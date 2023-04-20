<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin')->except(['Register']);
    }


    public function Register(Request $request){

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|confirmed|min:6'
        ]);

        $admin = Admin::insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        if ($admin === true){

            $token = Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password]);
            return $this->respondWithToken($token);

        }

    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::guard('admin')->factory()->getTTL() * 60
        ]);
    }


}

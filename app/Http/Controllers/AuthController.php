<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class AuthController extends BaseController
{
    public function userLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return $this->errorMessage(false, 'Incorrect Password or Email');
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'User Login Successfully',
            'token' => $token
        ]);
    }

    public function userLogOut(Request $request){
        try{
            $request->user()->currentAccessToken()->delete();

            return $this->successMessage(true, 'Logout Successfully', null);
        }catch(\Exception $e){
            return $this->errorMessage(false, $e->getMessage());
        }
    }

    
}

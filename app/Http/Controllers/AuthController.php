<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

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

    public function registerUser(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => [
                'required',
                Password::min(6)
                    ->mixedCase()
                    ->numbers()
                    ->letters()
                    ->symbols()
            ],
            'phone' => 'required',
            'avatar_url' => 'required|image|mimes:jpg,png,jpeg|max:2048',
            'role_id' => 'required'
        ]);

        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
                'avatar_url' => '/storage/'.$request->file('avatar_url')->store('images', 'public'),
                'role_id' => $request->role_id,
                'team_id' => $request->team_id
            ]);

            return $this->successMessage(true, 'User Insert Successfully', null);
        } catch (\Exception $e) {
            return $this->errorMessage(false, $e->getMessage());
        }
    }
}

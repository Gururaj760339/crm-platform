<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class UserController extends BaseController
{
    public function allUser(){
        try {
            $users = User::paginate(10);

            return $this->successMessage(true, 'All Users Retrieve Successfully', $users);
        } catch(\Exception $e){
            return $this->errorMessage(false, $e->getMessage());
        }
    }


    public function singleUser($userId){
        try {
            $users = User::where('id', $userId)->first();

            return $this->successMessage(true, 'Users Retrieve Successfully', $users);
        } catch(\Exception $e){
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

    public function updateUser(Request $request, $userId){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'avatar_url' => 'required|image|mimes:jpg,png,jpeg|max:2048',
            'role_id' => 'required'
        ]);
        
        try {
            DB::beginTransaction();

            $user = User::findOrFail($userId);
            $data = $request->except('avatar_url');

            if($request->hasFile('avatar_url')){
                if($user->avatar_url){
                    Storage::delete($user->avatar_url);
                }
                $path = '/storage/'.$request->file('avatar_url')->store('images', 'public');

                $data['avatar_url'] = $path;
            }
            
            $user->update($data);

            DB::commit();

            return $this->successMessage(true, 'User Data Update Successfully', null);
        } catch(\Exception $e) {
            DB::rollBack();
            return $this->errorMessage(false, $e->getMessage());
        }
    }

    public function userDelete($userId){
        try{
            User::destroy($userId);

            return $this->successMessage(true, 'User Delete Successfully', null);
        }catch(\Exception $e){
            return $this->errorMessage(false, $e->getMessage());
        }
    }
}

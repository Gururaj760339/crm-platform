<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends BaseController
{
    public function registerUserRole(Request $request){
        $request->validate([
            'name' => 'required',
            'permissions' => 'required'
        ]);

        try {
            $role = Role::create([
                'name' => $request->name,
                'permissions' => $request->permissions
            ]);

            return $this->successMessage(true, 'Role Created Successfully', $role);
        }catch(\Exception $e){
            return $this->errorMessage(false, $e->getMessage());
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends BaseController
{
    public function addTeamMembar(Request $request){
        $request->validate([
            'name' => 'required',
            'manager_id' => 'required'
        ]);

        try{
            Team::create([
                'name' => $request->name,
                'manager_id' => $request->manager_id
            ]);

            return $this->successMessage(true, 'Team Member Add Successfully', null);
        }catch(\Exception $e){
            return $this->errorMessage(false, $e->getMessage());
        }
    }
}

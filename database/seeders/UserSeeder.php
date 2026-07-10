<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::create([
            'name' => 'admin',
            'permissions' => [
                "*"
            ]
        ]);

        User::create([
            'name' => 'Guru Charan Rajbangshi',
            'email' => 'www.gururaj555@gmail.com',
            'password' => Hash::make('R@j760339'),
            'phone' => '01405792315',
            'role_id' => $role->id,
            'status' => 'active'
        ]);
    }
}

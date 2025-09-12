<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = Role::where('name','Admin')->first();
        User::create([
            'name' => 'Admin RS',
            'email' => 'admin@rs.com',
            'password' => Hash::make('password123'),
            'role_id' => $adminRole->id
        ]);
    }
}

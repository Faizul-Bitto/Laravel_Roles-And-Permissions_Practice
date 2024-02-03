<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@gmail.com',
            'password' => '1234',
        ])->assignRole('SuperAdmin');
    }
}

// $user = User::create([
//     'name' => 'SuperAdmin',
//     'email' => 'superadmin@gail.com',
//     'password' => '1234',
// ]);

// $user->assignRole('Client', 'SuperAdmin');

// $role = Role::findOrCreate('SUPER_ADMIN');

// $permissions = Permission::pluck('id', 'id')->all();

// $role->syncPermissions($permissions);

// $user->assignRole([$role->id]);

<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Creating Super Admin 
        $superAdmin = User::create([
            'name' => 'Super Admin', 
            'email' => 'SA@gmail.com',
            'password' => Hash::make('123456789')
        ]);
        $superAdmin->assignRole('Super Admin');

        // Creating Admin 
        $admin = User::create([
            'name' => 'Admin', 
            'email' => 'Admin@gmail.com',
            'password' => Hash::make('123456789')
        ]);
        $admin->assignRole('Admin');

        $admin = User::create([
            'name' => 'Admin', 
            'email' => 'Admin2@gmail.com',
            'password' => Hash::make('123456789')
        ]);
        $admin->assignRole('Admin');
    }
}

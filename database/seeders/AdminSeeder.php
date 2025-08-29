<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure Super Admin role exists
        $role = Role::firstOrCreate(['name' => 'super-admin']);

        // Create default admin user
        $admin = User::firstOrCreate(
            ['email' => 'fifty.play@yopmail.com'], // change this email
            [
                'user_type' => 1,
                'name' => 'Super Admin',
                'password' => "123456", // change password
                'email_verified_at' => now(),
            ]
        );

        $admin->assignRole($role);


        $this->command->info('✅ Super Admin created with email: admin@yopmail.com and password: 123456');
    }
}

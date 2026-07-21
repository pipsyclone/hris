<?php

namespace Database\Seeders;

use App\Models\User;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superadmin = Roles::where('slug', 'superadmin')->first();

        User::firstOrCreate(
            ['email' => 'superadmin@example.com'],
            [
                'name' => 'Superadmin', 
                'username' => 'superadmin',
                'email' => 'superadmin@example.com',
                'password' => Hash::make('123'),
                'role_id' => $superadmin->id,
            ]
        );
    }
}

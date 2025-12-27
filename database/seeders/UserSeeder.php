<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Super Admin user
        User::create([
            'name' => 'Zachran Razendra',
            'email' => 'zachranraze@recodex.id',
            'email_verified_at' => now(),
            'password' => Hash::make('admin123'),
            'remember_token' => null,
            'two_factor_secret' => null,
            'two_factor_recovery_codes' => null,
            'two_factor_confirmed_at' => null,
        ]);

        // Admin user
        User::create([
            'name' => 'Admin Parle Group',
            'email' => 'admin@parle-group.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => null,
            'two_factor_secret' => null,
            'two_factor_recovery_codes' => null,
            'two_factor_confirmed_at' => null,
        ]);

        // Additional demo users
        $users = [
            [
                'name' => 'Ahmad Rizki',
                'email' => 'ahmad.rizki@parle-group.com',
            ],
            [
                'name' => 'Siti Nurhaliza',
                'email' => 'siti.nurhaliza@parle-group.com',
            ],
            [
                'name' => 'Budi Santoso',
                'email' => 'budi.santoso@parle-group.com',
            ],
            [
                'name' => 'Dewi Lestari',
                'email' => 'dewi.lestari@parle-group.com',
            ],
            [
                'name' => 'Rizky Pratama',
                'email' => 'rizky.pratama@parle-group.com',
            ],
        ];

        foreach ($users as $user) {
            User::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => null,
                'two_factor_secret' => null,
                'two_factor_recovery_codes' => null,
                'two_factor_confirmed_at' => null,
            ]);
        }
    }
}

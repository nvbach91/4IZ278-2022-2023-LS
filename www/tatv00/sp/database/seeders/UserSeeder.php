<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Sample user data
        $users = [
            [
                'name' => 'Ondrej Nagraver',
                'email' => 'nagraver@admin.com',
                'password' => 'nagraver33',
            ],
            [
                'name' => 'Keril Inferi0r',
                'email' => 'inferior@pack.com',
                'password' => 'inferior33',
            ],
            // Add more users if needed
        ];

        // Insert the users
        foreach ($users as $userData) {
            User::create([
                'name' => $userData['name'],
                'email' => $userData['email'],
                'password' => Hash::make($userData['password']),
            ]);
        }
    }
}

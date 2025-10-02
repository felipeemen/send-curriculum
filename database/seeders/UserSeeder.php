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
        $users = [

            [
                'name' => 'Administrador',
                'email' => 'admin@localhost',
                'password' => Hash::make('admin'),
                'email_verified_at' => now()
            ],
            [
                'name' => 'Usuário',
                'email' => 'user@localhost',
                'password' => Hash::make('user'),
                'email_verified_at' => now()
            ],
            [
                'name' => 'Usuário 2',
                'email' => 'user2@localhost',
                'password' => Hash::make('user2'),
                'email_verified_at' => now()
            ]
        ];

        if(User::count() > 0) {
            return;
        }

        foreach($users as $user) {
            User::create($user);
        }
    }
}

<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        $users = [
            [
                "name" => "Administrator",
                "nip" => "1209876543212345",
                "position" => "Mahasiswa",
                "phone" => "08123456789",
                "username" => "admin",
                "email" => "sipespalupinoreply@gmail.com",
                "agency" => "STIMIK Adhi Guna",
                "role" => "admin",
                "password" => Hash::make('12345678')
            ],
        ];

        foreach ($users as $user) {
            // Generate UUID for user
            $userId = (string) Str::uuid();

            // Insert user data
            DB::table('users')->insert([
                'id' => $userId,
                'name' => $user['name'],
                'nip' => $user['nip'],
                'position' => $user['position'],
                'phone' => $user['phone'],
                'username' => $user['username'],
                'email' => $user['email'],
                'agency' => $user['agency'],
                'role' => $user['role'],
                'password' => $user['password'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

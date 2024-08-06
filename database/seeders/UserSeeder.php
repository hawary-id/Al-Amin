<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'username' => 'admin',
                'email' => 'admin@mail.com',
                'password' => Hash::make('admin'),
                'status' => 'Admin',
            ],
            [
                'username' => 'user',
                'email' => 'user@mail.com',
                'password' => Hash::make('user'),
                'status' => 'BPRS',
            ],
        ];

        foreach ($data as $item){
            User::create([
                'username' => $item['username'],
                'email' => $item['email'],
                'password' => $item['password'],
                'status' => $item['status'],
            ]);
        }
    }
}

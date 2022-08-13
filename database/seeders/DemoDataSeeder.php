<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DemoDataSeeder extends Seeder
{
    public function run(): void
    {
        $this->createDemoUsers();
    }

    private function createDemoUsers()
    {
        User::create([
            'name'              => 'User',
            'email'             => 'user@gmail.com',
            'email_verified_at' => now(),
            'phone'             => '12312312312',
            'password'          => Hash::make('123123123'),
            'remember_token'    => Str::random(10),
        ])->assignRole('User');
    }
}

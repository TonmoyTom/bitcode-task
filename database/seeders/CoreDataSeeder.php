<?php

namespace Database\Seeders;

use App\Models\CompanySetting;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CoreDataSeeder extends Seeder
{
    public function run()
    {
        $this->createDefaultSettings();
        $this->createDefaultRolePermissions();
        $this->createDefaultUsers();
    }

    private function createDefaultSettings()
    {
        CompanySetting::create([
            'name'                 => 'Project',
            'mobile1'              => '01xxxxxxxxx',
            'email'                => 'info@gmail.com',
        ]);
    }

    private function createDefaultRolePermissions()
    {

        $permissions = [
            ['name' => 'user.access'],
            ['name' => 'user.create'],
            ['name' => 'user.edit'],
            ['name' => 'user.view'],
            ['name' => 'user.delete'],

            ['name' => 'profile.access'],
            ['name' => 'profile.edit'],

            ['name' => 'settings.access'],
            ['name' => 'settings.edit'],

            ['name' => 'role_permission.access'],
            ['name' => 'role_permission.create'],
            ['name' => 'role_permission.edit'],
            ['name' => 'role_permission.view'],
            ['name' => 'role_permission.delete'],
        ];

        foreach ($permissions as $permission) {
            Permission::create([
                'name' => $permission["name"]
            ]);
        };

        //get all permissions via Gate::before rule; see AuthServiceProvider
        Role::create([
            'name' => 'Super Admin'
        ]);

        $userPermissions = [
            'profile.access',
            'profile.edit',
        ];

        Role::create([
            'name' => 'User'
        ])->givePermissionTo($userPermissions);
    }

    private function createDefaultUsers()
    {
        User::create([
            'name'              => 'admin',
            'email'             => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password'          => Hash::make('123123123'),
            'remember_token'    => Str::random(10),
        ])->assignRole('Super Admin');
    }
}

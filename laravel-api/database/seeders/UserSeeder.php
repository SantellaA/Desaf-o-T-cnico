<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $roleAdmin = Role::where('autoridad', 'ROLE_ADMIN')->first();
        $roleCliente = Role::where('autoridad', 'ROLE_CLIENTE')->first();

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin'),
            'role_id' => $roleAdmin->id
        ]);

        User::factory()->create([
            'name' => 'user',
            'email' => 'user@user.com',
            'password' => bcrypt('user'),
            'role_id' => $roleCliente->id
        ]);
    }
}

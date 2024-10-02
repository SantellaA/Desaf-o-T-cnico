<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        Role::factory()->create(['autoridad' => 'ROLE_ADMIN']);
        Role::factory()->create(['autoridad' => 'ROLE_CLIENTE']);
        
    }
}

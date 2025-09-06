<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class CreateDefaultRolesSeeder extends Seeder
{
    public function run()
    {
        // Crear roles predeterminados
        $roles = ['user', 'admin'];
        
        foreach ($roles as $roleName) {
            Role::create([
                'name' => $roleName,
                'guard_name' => 'web'
            ]);
        }
    }
}
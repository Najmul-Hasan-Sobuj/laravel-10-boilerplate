<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create the first admin user
    $admin1 = Admin::factory()->create([
        'name' => 'Admin User',
        'email' => 'admin@example.com',
        'password' => Hash::make('password'),
    ]);

    // Assign role to the first admin user
    $adminRole = Role::where('name', 'admin')->first();
    $admin1->assignRole($adminRole);

    // Create another admin user
    $admin2 = Admin::factory()->create([
        'name' => 'Khandker Shahed',
        'email' => 'khandkershahed23@gmail.com',
        'password' => Hash::make('password'),
    ]);

    // Assign role to the second admin user
    $admin2->assignRole($adminRole);
    }
}

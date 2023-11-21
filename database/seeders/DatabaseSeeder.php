<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Roles y Permisos
        $this->call(RoleSeeder::class);
        // usuarios base
        $this->call(UserSeeder::class);

        \App\Models\User::factory(10)->create()->each(function($user){
             $user->assignRole('alum');
        });

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}

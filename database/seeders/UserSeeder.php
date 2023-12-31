<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
                'name' => 'Lupita Rivas',
                'email' => 'lupitarivas817@gmail.com',
                'email_verified_at' => now(),
                'password' => '$2y$10$CeezlByriCBI4XSVEdkMBOvX3RxXrLYzcgGPOYRiZmvwwIJ3t/QV2', // password
                'remember_token' => Str::random(10),
        ])->assignRole('admin');
    }
}

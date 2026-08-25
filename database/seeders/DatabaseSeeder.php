<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // Akun ini CUMA buat testing lokal. 
        User::create([
            'name' => 'Dev Test',
            'email' => 'dev@tokoutama.test',
            'username' => 'devtest',
            'password' => Hash::make('devtest-only'),
        ]);

    }
}
<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\StoreSetting;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $user = User::create([
            'name' => 'Admin Toko Utama',
            'email' => 'admin@tokoutama.test',
            'username' => 'admin',
            'password' => Hash::make('password'),
        ]);

        $rokok = Category::create(['name' => 'Rokok']);
        $sembako = Category::create(['name' => 'Sembako']);
        $snack = Category::create(['name' => 'Snack']);
        $gula = Category::create(['name' => 'Gula']);

        Product::create([
            'category_id' => $rokok->id,
            'name' => 'Djarum Super',
            'description' => 'Rokok kretek filter',
            'is_active' => true,
            'is_available' => true,
        ]);

        Product::create([
            'category_id' => $rokok->id,
            'name' => 'Sampoerna Mild',
            'description' => 'Rokok filter premium',
            'is_active' => true,
            'is_available' => true,
        ]);

        Product::create([
            'category_id' => $sembako->id,
            'name' => 'Beras Premium 5kg',
            'description' => 'Beras berkualitas',
            'is_active' => true,
            'is_available' => true,
        ]);

        Product::create([
            'category_id' => $sembako->id,
            'name' => 'Minyak Goreng 2L',
            'description' => 'Minyak goreng sawit',
            'is_active' => true,
            'is_available' => false,
        ]);

        Product::create([
            'category_id' => $snack->id,
            'name' => 'Chitato',
            'description' => 'Snack kentang',
            'is_active' => true,
            'is_available' => true,
        ]);

        Product::create([
            'category_id' => $gula->id,
            'name' => 'Gula Pasir 1kg',
            'description' => 'Gula pasir putih',
            'is_active' => true,
            'is_available' => true,
        ]);

        StoreSetting::create([
            'address' => 'Belakang Taman Pancasila, Karanganyar',
            'open_hours' => '07.00 - 21.00',
            'whatsapp_number' => '6281234567890',
        ]);
    }
}
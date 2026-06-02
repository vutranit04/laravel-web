<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            //Cac Seeder khong co khoa ngoai
            CategorySeeder::class,
            BrandSeeder::class,
            UserSeeder::class,
            //Cac Seeder co khoa ngoai
            ProductSeeder::class,
            PostSeeder::class,

        ]);
    
    }
}

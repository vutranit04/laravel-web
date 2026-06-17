<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 50; $i++) {

            $productName = fake()->unique()->words(rand(2, 4), true);

            $price = rand(100000, 50000000);

            $discount = rand(
                $price * 70 / 100,
                $price * 90 / 100
            );

            DB::table('products')->insert([
                'productname'   => ucfirst($productName),
                'slug'          => Str::slug($productName) . '-' . $i,

                'price'         => $price,
                'pricediscount' => $discount,

                'image'         => 'product-' . rand(1, 10) . '.jpg',

                'description'   => fake()->paragraphs(3, true),

                'status'        => rand(0, 1),

                // Phải tồn tại trong DB
                'brandid'       => rand(1, 10),

                // Phải tồn tại trong categories
                'cateid'        => rand(1, 10),

                'created_at'    => now(),
                'updated_at'    => now(),
            ]);
        }
    }
}
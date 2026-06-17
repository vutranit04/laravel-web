<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('vi_VN');

        for ($i = 1; $i <= 20; $i++) {

            DB::table('users')->insert([
                'fullname'   => $faker->name(),
                'username'   => $faker->unique()->userName(),
                'email'      => $faker->unique()->safeEmail(),
                'password'   => Hash::make('123456'),

                'phone'      => '0' . $faker->numerify('#########'),

                'address'    => $faker->address(),

                // 0=Nữ, 1=Nam
                'gender'     => rand(0, 1),

                'birthday'   => $faker->date('Y-m-d', '-18 years'),

                // 1=Admin, 2=User
                'role'       => rand(1, 2),

                // 0=Ẩn, 1=Hiển thị
                'status'     => rand(0, 1),

                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
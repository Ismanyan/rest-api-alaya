<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        for ($i = 1; $i <= 10; $i++) {
            DB::table('users')->insert([
                'name'     => $faker->name,
                'username' => $faker->userName,
                'email'    => $faker->unique()->email,
                'password' => Hash::make('12345'),
                'address'  => $faker->address(),
                'branch'   => $faker->city(),
                'photo'    => $faker->imageUrl(640, 480),
                'position' => 'GUEST',
                'role'     => 1,
                'pin'      => $faker->randomNumber(),
                'token'    => null
            ]);
        }
    }
}

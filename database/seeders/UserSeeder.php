<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Faker name
        $faker = \Faker\Factory::create();

        // Seeding
        DB::table('users')->insert([
            'hospital_id' => '1',
            'name'        => $faker->name(),
            'email'       => 'RS101@email.com',
            'password'    => Hash::make('password'),
            'created_at'  => \Carbon\Carbon::now(),
        ]);
        DB::table('users')->insert([
            'hospital_id' => '1',
            'name'        => $faker->name(),
            'email'       => 'RS102@email.com',
            'password'    => Hash::make('password'),
            'created_at'  => \Carbon\Carbon::now(),
        ]);
        DB::table('users')->insert([
            'hospital_id' => '2',
            'name'        => $faker->name(),
            'email'       => 'RS201@email.com',
            'password'    => Hash::make('password'),
            'created_at'  => \Carbon\Carbon::now(),
        ]);
        DB::table('users')->insert([
            'hospital_id' => '2',
            'name'        => $faker->name(),
            'email'       => 'RS202@email.com',
            'password'    => Hash::make('password'),
            'created_at'  => \Carbon\Carbon::now(),
        ]);
        DB::table('users')->insert([
            'hospital_id' => '3',
            'name'        => $faker->name(),
            'email'       => 'RS301@email.com',
            'password'    => Hash::make('password'),
            'created_at'  => \Carbon\Carbon::now(),
        ]);
        DB::table('users')->insert([
            'hospital_id' => '3',
            'name'        => $faker->name(),
            'email'       => 'RS302@email.com',
            'password'    => Hash::make('password'),
            'created_at'  => \Carbon\Carbon::now(),
        ]);
        DB::table('users')->insert([
            'hospital_id' => '4',
            'name'        => $faker->name(),
            'email'       => 'RS401@email.com',
            'password'    => Hash::make('password'),
            'created_at'  => \Carbon\Carbon::now(),
        ]);
        DB::table('users')->insert([
            'hospital_id' => '4',
            'name'        => $faker->name(),
            'email'       => 'RS402@email.com',
            'password'    => Hash::make('password'),
            'created_at'  => \Carbon\Carbon::now(),
        ]);
    }
}

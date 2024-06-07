<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'sex' => '2',
            'age' => 4,
            'email' => 'a@gmail.com',
            'email_verified_at' => new DateTime(),
            'password' => 'itssecret',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
    }
}

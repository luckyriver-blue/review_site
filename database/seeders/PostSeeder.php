<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('posts')->insert([
            'user_id' => 1,
            'hospital_id' => 1,
            'disease' => '風邪',
            'smooth_examination' => 4,
            'smooth_hospitalization' => 10,
            'star' => 5,
            'body' => 'ブラボー！',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        
        DB::table('posts')->insert([
            'user_id' => 1,
            'hospital_id' => 1,
            'star' => 2,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
    }
}

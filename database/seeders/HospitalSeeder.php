<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class HospitalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('hospitals')->insert([
            'name' => '総合病院',
            'place' => 'さいたま市',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            
        ]);
    }
}

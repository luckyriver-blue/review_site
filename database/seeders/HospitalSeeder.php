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
            'name' => 'さいたま市立病院',
            'place' => '埼玉県',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            
        ]);
    }
}

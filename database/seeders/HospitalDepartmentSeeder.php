<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class HospitalDepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('hospital_departments')->insert(
            [
                'name' => '内科',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ]);
        DB::table('hospital_departments')->insert(
            [
                'name' => '小児科',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ]);
    }
}

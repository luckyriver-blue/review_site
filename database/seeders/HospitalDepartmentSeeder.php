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
        $params =
        [       
            [
            'name' => 'アレルギー科'
            ],
            [
            'name' => '胃腸科'
            ],
            [
            'name' => '肝胆膵外科'
            ],
            [
            'name' => '眼科'
            ],
            [
            'name' => '眼形成眼窩外科'
            ],
            [
            'name' => '気管食道科'
            ],
            [
            'name' => '救急医学科'
            ],
            [
            'name' => '形成外科'
            ],
            [
            'name' => '血液科'
            ],
            [
            'name' => '血液透析科'
            ],
            [
            'name' => '血液内科'
            ],
            [
            'name' => '外科'
            ],
            [
            'name' => '膠原病リマウチ内科'
            ],
            [
            'name' => '肛門科'
            ],
            [
            'name' => '呼吸器科'
            ],
            [
            'name' => '呼吸器外科'
            ],
            [
            'name' => '呼吸器内科'
            ],
            [
            'name' => '産科'
            ],
            [
            'name' => '産婦人科'
            ],
            [
            'name' => '歯科'
            ],
            [
            'name' => '歯科矯正科'
            ],
            [
            'name' => '歯科口腔外科'
            ],
            [
            'name' => '腫瘍治療科'
            ],
            [
            'name' => '消化器科'
            ],
            [
            'name' => '消化器外科'
            ],
            [
            'name' => '消化器内科'
            ],
            [
            'name' => '小児科'
            ],
            [
            'name' => '小児外科'
            ],
            [
            'name' => '小児歯科'
            ],
            [
            'name' => '小児循環器科'
            ],
            [
            'name' => '神経科'
            ],
            [
            'name' => '神経内科'
            ],
            [
            'name' => '新生児科'
            ],
            [
            'name' => '心臓血管外科'
            ],
            [
            'name' => '心療内科'
            ],
            [
            'name' => '循環器科'
            ],
            [
            'name' => '循環器内科'
            ],
            [
            'name' => '腎移植科'
            ],
            [
            'name' => '腎臓内科'
            ],
            [
            'name' => '整形外科'
            ],
            [
            'name' => '精神科'
            ],
            [
            'name' => '性病科'
            ],
            [
            'name' => '総合診療科'
            ],
            [
            'name' => '代謝内科'
            ],
            [
            'name' => '大腸肛門科'
            ],
            [
            'name' => '糖尿内科'
            ],
            [
            'name' => '糖尿病科'
            ],
            [
            'name' => '内科'
            ],
            [
            'name' => '内分泌内科'
            ],
            [
            'name' => '乳腺甲状腺外科'
            ],
            [
            'name' => '脳神経外科'
            ],
            [
            'name' => '脳卒中科'
            ],
            [
            'name' => '泌尿器科'
            ],
            [
            'name' => '皮膚科'
            ],
            [
            'name' => '皮膚泌尿器科'
            ],
            [
            'name' => '美容外科'
            ],
            [
            'name' => '婦人科'
            ],
            [
            'name' => '不妊内分泌科'
            ],
            [
            'name' => '放射線科'
            ],
            [
            'name' => '麻酔科'
            ],
            [
            'name' => 'リハビリテーション科'
            ],
            [
            'name' => 'リマウチ科'
            ],
        ];
        
        foreach ($params as $param) {
            $param['created_at'] = new DateTime();
            $param['updated_at'] = new DateTime();
            DB::table('hospital_departments')->insert($param);
        }
    }
}

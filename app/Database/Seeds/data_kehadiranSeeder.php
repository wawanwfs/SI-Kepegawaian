<?php

namespace App\Database\Seeds;

use CodeIgniter\I18n\Time;

use CodeIgniter\Database\Seeder;

class data_kehadiranSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create('id_ID');
        $a = 1;
        for ($i = 0; $i < 1117; $i++) {
            $today = Date('ymd');
            $i = str_pad($i, 4, '0', STR_PAD_LEFT);
            $char = $today .  $i;
            $time = $faker->time('h');
            $time = substr($time, 1);
            $data = [
                'id_karyawan' => $a++,
                'tanggal_kehadiran' => date('Y-m-d'),
                'jam_masuk' => '07:5' . $time . $faker->time(':s'),
                'jam_pulang' => '17:0' . $faker->time('h:s'),
            ];
            $this->db->table('data_kehadiran')->insert($data);
        }
    }
}

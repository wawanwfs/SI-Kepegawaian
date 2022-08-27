<?php

namespace App\Database\Seeds;

use CodeIgniter\I18n\Time;

use CodeIgniter\Database\Seeder;

class data_karyawanSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create('id_ID');
        for ($i = 0; $i < 1250; $i++) {
            $today = Date('ymd');
            $i = str_pad($i, 4, '0', STR_PAD_LEFT);
            $char = $today .  $i;
            $data = [
                'nik' => $char,
                'foto' =>  $faker->randomElement($array = array('1.jpg', '2.jpg', '3.jpg', '4.jpg', '5.jpg', '6.jpg', '7.jpg', '8.jpg', '9.jpg', '10.jpg', '11.jpg', '12.jpg', '13.jpg', '14.jpg', '15.jpg', '16.jpg', '17.jpg', '18.jpg', '19.jpg', '20.jpg', '21.jpg', '22.jpg', '23.jpg', '24.jpg', '25.jpg', '26.jpg', '27.jpg')),
                'slug' => url_title($char, '-', true),
                'nama' => $faker->name,
                'tempat_lahir' => $faker->city,
                'tanggal_lahir' => $faker->date(),
                'jenis_kelamin' => $faker->randomElement($array = array('Laki-Laki', 'Perempuan')),
                'agama' => $faker->randomElement($array = array('Islam', 'Kristen', 'Katolik', 'Hindu', 'Budha')),
                'alamat' => $faker->address,
                'no_telp' => $faker->phoneNumber,
                'email' => $faker->email,
                'jabatan' => $faker->randomElement($array = array('1', '2', '3', '4', '5', '6', '7', '8')),
                'status' => $faker->randomElement($array = array('1', '2')),
                'created_at' => Time::createFromTimestamp($faker->unixTime()),
                'updated_at' => Time::now(),
            ];
            $this->db->table('data_karyawan')->insert($data);
        }
    }
}

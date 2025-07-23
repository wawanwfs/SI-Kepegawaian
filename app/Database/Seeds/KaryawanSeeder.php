<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class KaryawanSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nik' => '12345',
                'slug' => '12345',
                'nama' => 'Budi',
                'tempat_lahir' => 'Jakarta',
                'tanggal_lahir' => '1990-01-01',
                'jenis_kelamin' => 'Laki-Laki',
                'agama' => 'Islam',
                'alamat' => 'Jl. Merdeka No. 1',
                'no_telp' => '081234567890',
                'email' => 'budi@example.com',
                'jabatan' => 'Manager',
                'status' => '1',
                'foto' => 'default.jpg',
            ],
            [
                'nik' => '67890',
                'slug' => '67890',
                'nama' => 'Ani',
                'tempat_lahir' => 'Surabaya',
                'tanggal_lahir' => '1992-02-02',
                'jenis_kelamin' => 'Perempuan',
                'agama' => 'Kristen',
                'alamat' => 'Jl. Sudirman No. 2',
                'no_telp' => '087654321098',
                'email' => 'ani@example.com',
                'jabatan' => 'Staff',
                'status' => '2',
                'foto' => 'default.jpg',
            ]
        ];

        // Simple Queries
        // $this->db->query('INSERT INTO data_karyawan (nik, slug, nama, tempat_lahir, tanggal_lahir, jenis_kelamin, agama, alamat, no_telp, email, jabatan, status, foto) VALUES(:nik:, :slug:, :nama:, :tempat_lahir:, :tanggal_lahir:, :jenis_kelamin:, :agama:, :alamat:, :no_telp:, :email:, :jabatan:, :status:, :foto:)', $data);

        // Using Query Builder
        $this->db->table('data_karyawan')->insertBatch($data);
    }
}

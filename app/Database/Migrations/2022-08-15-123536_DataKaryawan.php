<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DataKaryawan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nik' => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
            ],
            'foto' => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
            ],
            'slug' => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
            ],
            'nama' => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
            ],
            'tempat_lahir' => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
            ],
            'tanggal_lahir' => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
            ],
            'jenis_kelamin' => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
            ],
            'agama' => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
            ],
            'alamat' => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
            ],
            'no_telp' => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
            ],
            'email' => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
            ],
            'jabatan' => [
                'type'           => 'INT',
                'constraint'     => '2',
            ],
            'status' => [
                'type'           => 'INT',
                'constraint'     => '2',
            ],
            'created_at' => [
                'type'           => 'DATETIME',
                'null'           => true,
            ],
            'updated_at' => [
                'type'           => 'DATETIME',
                'null'           => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('data_karyawan');
    }

    public function down()
    {
        $this->forge->dropTable('data_karyawan');
    }
}

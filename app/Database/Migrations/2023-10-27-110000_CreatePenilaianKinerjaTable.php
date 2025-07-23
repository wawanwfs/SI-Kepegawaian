<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePenilaianKinerjaTable extends Migration
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
            'id_karyawan' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'tanggal_penilaian' => [
                'type'           => 'DATE',
            ],
            'nilai' => [
                'type'           => 'INT',
                'constraint'     => 3,
            ],
            'catatan' => [
                'type'           => 'TEXT',
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
        $this->forge->addForeignKey('id_karyawan', 'data_karyawan', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('penilaian_kinerja');
    }

    public function down()
    {
        $this->forge->dropTable('penilaian_kinerja');
    }
}

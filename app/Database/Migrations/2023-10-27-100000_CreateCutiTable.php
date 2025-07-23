<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCutiTable extends Migration
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
            'tanggal_mulai' => [
                'type'           => 'DATE',
            ],
            'tanggal_selesai' => [
                'type'           => 'DATE',
            ],
            'alasan' => [
                'type'           => 'TEXT',
            ],
            'status' => [
                'type'           => 'ENUM',
                'constraint'     => ['pending', 'disetujui', 'ditolak'],
                'default'        => 'pending',
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
        $this->forge->createTable('cuti');
    }

    public function down()
    {
        $this->forge->dropTable('cuti');
    }
}

<?php

namespace App\Models;

use App\Controllers\Tunjangan;
use CodeIgniter\Model;

class TunjanganModel extends Model
{
    protected $table = 'gaji_jabatan';
    protected $allowedFields = ['id_jabatan', 'gaji_pokok', 'tunjangan', 'uang_makan', 'hari_kerja'];

    public function tunjangan()
    {
        return $this->table('gaji_jabatan')
            ->join('jabatan', 'gaji_jabatan.id_jbt = jabatan.id_jabatan', 'right');
    }

    public function search($keyword)
    {
        return $this->table('gaji_jabatan')
            ->join('jabatan', 'gaji_jabatan.id_jbt = jabatan.id_jabatan', 'right')
            ->Like('jabatan', $keyword);
    }
}

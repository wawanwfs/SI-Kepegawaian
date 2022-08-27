<?php

namespace App\Models;

use App\Controllers\Kehadiran;
use CodeIgniter\Model;

class KehadiranModel extends Model
{
    protected $table = 'data_kehadiran';
    protected $useTimestamps  = true;
    protected $allowedFields = ['id_karyawan', 'tanggal_kehadiran', 'jam_masuk', 'jam_pulang'];

    public function kehadiran()
    {
        return $this->table('data_kehadiran')
            ->join('data_karyawan', 'data_kehadiran.id_karyawan = data_karyawan.id')
            ->join('jabatan', 'data_karyawan.jabatan = jabatan.id_jabatan');
    }

    public function search($keyword)
    {
        return $this->table('data_kehadiran')->join('data_karyawan', 'data_kehadiran.id_karyawan = data_karyawan.id')->join('jabatan', 'data_karyawan.jabatan = jabatan.id_jabatan')->like('nik', $keyword);
    }
}

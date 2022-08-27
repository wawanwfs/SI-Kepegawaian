<?php

namespace App\Models;

use App\Controllers\Izin;
use CodeIgniter\Model;

class IzinModel extends Model
{
    protected $table = 'izin_karyawan';
    protected $useTimestamps  = true;
    protected $allowedFields = ['id_karyawan', 'tanggal_izin', 'jenis_izin', 'ket'];

    public function izin()
    {
        return $this->table('izin_karyawan')
            ->join('data_karyawan', 'izin_karyawan.id_karyawan = data_karyawan.id', 'right')
            ->join('jabatan', 'data_karyawan.jabatan = jabatan.id_jabatan', 'left')
            ->join('data_kehadiran', 'data_karyawan.id = data_kehadiran.id_karyawan', 'left')
            ->join('izin', 'izin_karyawan.jenis_izin = izin.id_izin', 'left')
            ->where('data_kehadiran.id_karyawan is null');
    }

    public function search($keyword)
    {
        return $this->table('izin_karyawan')->join('data_karyawan', 'izin_karyawan.id_karyawan = data_karyawan.id')->join('jabatan', 'data_karyawan.jabatan = jabatan.id_jabatan')->join('izin', 'izin_karyawan.jenis_izin = izin.id_izin')->like('nik', $keyword)->orLike('nama', $keyword)->orLike('jabatan', $keyword);
    }
}

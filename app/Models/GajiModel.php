<?php

namespace App\Models;

use App\Controllers\Gaji;
use CodeIgniter\Model;

class GajiModel extends Model
{
    protected $table = 'data_karyawan';
    protected $useTimestamps  = true;
    protected $allowedFields = ['id', 'nik', 'foto', 'slug', 'nama', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin', 'agama', 'alamat', 'no_telp', 'email', 'jabatan', 'status'];

    public function gaji()
    {
        return $this->table('data_karyawan')
            ->join('jabatan', 'data_karyawan.jabatan = jabatan.id_jabatan')
            ->join('status', 'data_karyawan.status = status.id_status')
            ->join('izin_karyawan', 'data_karyawan.id = izin_karyawan.id_karyawan', 'left')
            ->join('izin', 'izin_karyawan.jenis_izin = izin.id_izin', 'left')
            ->join('gaji_potongan', 'izin.id_izin = gaji_potongan.id_potongan ', 'left')
            ->join('gaji_jabatan', 'gaji_jabatan.id_jbt = jabatan.id_jabatan', 'left');
    }

    public function getkaryawan($slug = false)
    {
        if ($slug == false) {
            return $this->table('data_karyawan')
                ->join('jabatan', 'data_karyawan.jabatan = jabatan.id_jabatan')
                ->join('status', 'data_karyawan.status = status.id_status')
                ->join('izin_karyawan', 'data_karyawan.id = izin_karyawan.id_karyawan', 'left')
                ->join('izin', 'izin_karyawan.jenis_izin = izin.id_izin', 'left')
                ->join('gaji_potongan', 'izin.id_izin = gaji_potongan.id_potongan ', 'left')
                ->join('gaji_jabatan', 'gaji_jabatan.id_jbt = jabatan.id_jabatan', 'left')
                ->findAll();
        }

        return $this->table('data_karyawan')
            ->join('jabatan', 'data_karyawan.jabatan = jabatan.id_jabatan')
            ->join('status', 'data_karyawan.status = status.id_status')
            ->join('izin_karyawan', 'data_karyawan.id = izin_karyawan.id_karyawan', 'left')
            ->join('izin', 'izin_karyawan.jenis_izin = izin.id_izin', 'left')
            ->join('gaji_potongan', 'izin.id_izin = gaji_potongan.id_potongan ', 'left')
            ->join('gaji_jabatan', 'gaji_jabatan.id_jbt = jabatan.id_jabatan', 'left')
            ->where(['slug' => $slug])->first();
    }

    public function search($keyword)
    {
        return $this->table('data_karyawan')
            ->join('jabatan', 'data_karyawan.jabatan = jabatan.id_jabatan')
            ->join('status', 'data_karyawan.status = status.id_status')
            ->join('izin_karyawan', 'data_karyawan.id = izin_karyawan.id_karyawan', 'left')
            ->join('izin', 'izin_karyawan.jenis_izin = izin.id_izin', 'left')
            ->join('gaji_potongan', 'izin.id_izin = gaji_potongan.id_potongan ', 'left')
            ->join('gaji_jabatan', 'gaji_jabatan.id_jbt = jabatan.id_jabatan', 'left')
            ->like('nik', $keyword)->orLike('nama', $keyword)
            ->orLike('jabatan.jabatan', $keyword);
    }
}

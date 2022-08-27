<?php

namespace App\Models;

use App\Controllers\Karyawan;
use CodeIgniter\Model;

class KaryawanModel extends Model
{
    protected $table = 'data_karyawan';
    protected $useTimestamps  = true;
    protected $allowedFields = ['id', 'nik', 'foto', 'slug', 'nama', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin', 'agama', 'alamat', 'no_telp', 'email', 'jabatan', 'status'];

    public function karyawan()
    {
        return $this->table('data_karyawan')
            ->join('jabatan', 'data_karyawan.jabatan = jabatan.id_jabatan')
            ->join('status', 'data_karyawan.status = status.id_status');
    }

    public function getkaryawan($slug = false)
    {
        if ($slug == false) {
            return $this->table('data_karyawan')
                ->join('jabatan', 'data_karyawan.jabatan = jabatan.id_jabatan')
                ->join('status', 'data_karyawan.status = status.id_status')
                ->findAll();
        }

        return $this->table('data_karyawan')
            ->join('jabatan', 'data_karyawan.jabatan = jabatan.id_jabatan')
            ->join('status', 'data_karyawan.status = status.id_status')
            ->where(['slug' => $slug])->first();
    }

    public function search($keyword)
    {
        return $this->table('data_karyawan')
            ->join('jabatan', 'data_karyawan.jabatan = jabatan.id_jabatan')
            ->join('status', 'data_karyawan.status = status.id_status')
            ->like('nik', $keyword)->orLike('nama', $keyword)
            ->orLike('jabatan.jabatan', $keyword);
    }

    public function ubah($data, $id)
    {
        return $this->table('data_karyawan')->update($data, ['id' => $id]);
    }
}

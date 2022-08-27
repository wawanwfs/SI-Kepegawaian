<?php

namespace App\Controllers;

use App\Models\KaryawanModel;
use App\Models\KehadiranModel;
use App\Models\IzinModel;


class Home extends BaseController
{
    protected $karyawanModel;
    public function __construct()
    {
        $this->karyawanModel = new KaryawanModel();
        $this->kehadiranModel = new KehadiranModel();
        $this->izinModel = new IzinModel();
    }

    public function index()
    {
        $jumlah_karyawan = $this->karyawanModel->countAll();
        $karyawan_masuk = $this->kehadiranModel->countAll();
        $karyawan_laki = $this->karyawanModel->where('jenis_kelamin', 'Laki-Laki')->countAllResults();
        $karyawan_perem = $this->karyawanModel->where('jenis_kelamin', 'Perempuan')->countAllResults();
        $karyawan_tetap = $this->karyawanModel->where('status', '1')->countAllResults();
        $karyawan_kontrak = $this->karyawanModel->where('status', '2')->countAllResults();

        $data = [
            'title' => 'SIK - Dashboard',
            'jumlah_karyawan' => $jumlah_karyawan,
            'karyawan_masuk' => $karyawan_masuk,
            'karyawan_laki' => $karyawan_laki,
            'karyawan_perem' => $karyawan_perem,
            'karyawan_tetap' => $karyawan_tetap,
            'karyawan_kontrak' => $karyawan_kontrak,


        ];
        return view('pages/index', $data);
    }
}

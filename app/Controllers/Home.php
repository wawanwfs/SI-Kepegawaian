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
        $karyawan_laki = $this->karyawanModel->where('jenis_kelamin', 'Laki-Laki')->countAllResults();
        $karyawan_perem = $this->karyawanModel->where('jenis_kelamin', 'Perempuan')->countAllResults();
        $karyawan_tetap = $this->karyawanModel->where('status', '1')->countAllResults();
        $karyawan_kontrak = $this->karyawanModel->where('status', '2')->countAllResults();

        // Dummy data for monthly attendance
        $kehadiran_bulanan = [
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
            'data' => [80, 85, 90, 88, 92, 95, 93, 96, 94, 98, 97, 100]
        ];

        $data = [
            'title' => 'SIK - Dashboard',
            'jumlah_karyawan' => $jumlah_karyawan,
            'karyawan_laki' => $karyawan_laki,
            'karyawan_perem' => $karyawan_perem,
            'karyawan_tetap' => $karyawan_tetap,
            'karyawan_kontrak' => $karyawan_kontrak,
            'kehadiran_bulanan' => json_encode($kehadiran_bulanan)
        ];
        return view('pages/index', $data);
    }
}

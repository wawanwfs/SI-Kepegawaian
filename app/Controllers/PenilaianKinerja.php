<?php

namespace App\Controllers;

use App\Models\PenilaianKinerjaModel;
use App\Models\KaryawanModel;

class PenilaianKinerja extends BaseController
{
    protected $penilaianKinerjaModel;
    protected $karyawanModel;

    public function __construct()
    {
        $this->penilaianKinerjaModel = new PenilaianKinerjaModel();
        $this->karyawanModel = new KaryawanModel();
    }

    public function index()
    {
        $data = [
            'title' => 'SIK - Penilaian Kinerja',
            'penilaian_kinerja' => $this->penilaianKinerjaModel->getPenilaianKinerja()
        ];

        return view('penilaian_kinerja/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'SIK - Form Penilaian Kinerja',
            'validation' => \Config\Services::validation(),
            'karyawan' => $this->karyawanModel->findAll()
        ];

        return view('penilaian_kinerja/create', $data);
    }

    public function store()
    {
        if (!$this->validate([
            'id_karyawan' => 'required',
            'tanggal_penilaian' => 'required',
            'nilai' => 'required|numeric|greater_than_equal_to[0]|less_than_equal_to[100]',
            'catatan' => 'required'
        ])) {
            return redirect()->to('/penilaian_kinerja/create')->withInput();
        }

        $this->penilaianKinerjaModel->save([
            'id_karyawan' => $this->request->getVar('id_karyawan'),
            'tanggal_penilaian' => $this->request->getVar('tanggal_penilaian'),
            'nilai' => $this->request->getVar('nilai'),
            'catatan' => $this->request->getVar('catatan')
        ]);

        session()->setFlashdata('pesan', 'Penilaian kinerja berhasil ditambahkan.');

        return redirect()->to('/penilaian_kinerja');
    }
}

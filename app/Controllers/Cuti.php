<?php

namespace App\Controllers;

use App\Models\CutiModel;

class Cuti extends BaseController
{
    protected $cutiModel;

    public function __construct()
    {
        $this->cutiModel = new CutiModel();
    }

    public function index()
    {
        $data = [
            'title' => 'SIK - Pengajuan Cuti',
            'cuti' => $this->cutiModel->getCuti()
        ];

        return view('cuti/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'SIK - Form Pengajuan Cuti',
            'validation' => \Config\Services::validation()
        ];

        return view('cuti/create', $data);
    }

    public function store()
    {
        if (!$this->validate([
            'tanggal_mulai' => 'required',
            'tanggal_selesai' => 'required',
            'alasan' => 'required'
        ])) {
            return redirect()->to('/cuti/create')->withInput();
        }

        $this->cutiModel->save([
            'id_karyawan' => session()->get('id_karyawan'), // asumsikan id karyawan disimpan di session
            'tanggal_mulai' => $this->request->getVar('tanggal_mulai'),
            'tanggal_selesai' => $this->request->getVar('tanggal_selesai'),
            'alasan' => $this->request->getVar('alasan')
        ]);

        session()->setFlashdata('pesan', 'Pengajuan cuti berhasil dikirim.');

        return redirect()->to('/cuti');
    }

    public function approve($id)
    {
        $this->cutiModel->update($id, ['status' => 'disetujui']);
        session()->setFlashdata('pesan', 'Cuti berhasil disetujui.');
        return redirect()->to('/cuti');
    }

    public function reject($id)
    {
        $this->cutiModel->update($id, ['status' => 'ditolak']);
        session()->setFlashdata('pesan', 'Cuti berhasil ditolak.');
        return redirect()->to('/cuti');
    }
}

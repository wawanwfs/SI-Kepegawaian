<?php

namespace App\Controllers;

use App\Models\IzinModel;
use CodeIgniter\HTTP\Request;

class Izin extends BaseController
{
    protected $izinModel;
    public function __construct()
    {
        $this->izinModel = new IzinModel();
    }
    public function index()
    {
        $currentPage = $this->request->getVar('page_izin') ? $this->request->getVar('page_izin') : 1;

        $keyword = $this->request->getVar('keyword') ? $this->request->getVar('keyword') : '';
        if ($keyword) {
            $izin = $this->izinModel->search($keyword);
        } else {
            $izin = $this->izinModel->izin()->orderBy('nik', 'ASC');
        }

        $data = [
            'title' => 'SIK - Izin Karyawan',
            'validation' => \config\Services::validation(),
            'izin' => $izin->paginate(10, 'izin'),
            'pager' => $this->izinModel->pager,
            'currentPage' => $currentPage,
        ];


        return view('karyawan/izin_karyawan', $data);
    }

    public function save()
    {
        $this->izinModel->save([
            'id_karyawan' =>  $this->request->getVar('id_karyawan'),
            'tanggal_izin' =>  $this->request->getVar('tanggal_izin'),
            'jenis_izin' => $this->request->getVar('jenis_izin'),
            'ket' => $this->request->getVar('ket'),
        ]);
        session()->setFlashdata('pesan', 'Izin berhasil diproses.');
        return redirect()->to('/izinkaryawan');
    }
}

<?php

namespace App\Controllers;

use App\Models\TunjanganModel;
use CodeIgniter\HTTP\Request;

class Tunjangan extends BaseController
{
    protected $tunjanganModel;
    public function __construct()
    {
        $this->tunjanganModel = new TunjanganModel();
    }
    public function index()
    {
        $currentPage = $this->request->getVar('page_tunjangan') ? $this->request->getVar('page_tunjangan') : 1;

        $keyword = $this->request->getVar('keyword') ? $this->request->getVar('keyword') : '';
        if ($keyword) {
            $tunjangan = $this->tunjanganModel->search($keyword);
        } else {
            $tunjangan = $this->tunjanganModel->tunjangan()->orderBy('id_jabatan', 'ASC');
        }

        $data = [
            'title' => 'SIK - Tunjangan Karyawan',
            'validation' => \config\Services::validation(),
            'gaji' => $tunjangan->paginate(10, 'tunjangan'),
            'pager' => $this->tunjanganModel->pager,
            'currentPage' => $currentPage,
        ];


        return view('gaji/tunjangan', $data);
    }

    public function ubah($id)
    {
        $this->tunjanganModel->save([
            'id' => $id,
            'id_jbt' => $this->request->getVar('id_jabatan'),
            'gaji_pokok' =>  $this->request->getVar('gaji_pokok'),
            'tunjangan' =>  $this->request->getVar('tunjangan'),
            'uang_makan' => $this->request->getVar('uang_makan'),
            'hari_kerja' => $this->request->getVar('hari_kerja'),
        ]);
        session()->setFlashdata('pesan', 'Tunjangan berhasil diubah.');
        return redirect()->to('/tunjangan');
    }
}

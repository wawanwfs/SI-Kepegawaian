<?php

namespace App\Controllers;

use App\Models\PotonganModel;
use CodeIgniter\HTTP\Request;

class Potongan extends BaseController
{
    protected $potonganModel;
    public function __construct()
    {
        $this->potonganModel = new PotonganModel();
    }
    public function index()
    {
        $currentPage = $this->request->getVar('page_potongan') ? $this->request->getVar('page_potongan') : 1;

        $keyword = $this->request->getVar('keyword') ? $this->request->getVar('keyword') : '';
        if ($keyword) {
            $potongan = $this->potonganModel->search($keyword);
        } else {
            $potongan = $this->potonganModel->potongan()->orderBy('id_izin', 'ASC');
        }

        $data = [
            'title' => 'SIK - Potongan Karyawan',
            'validation' => \config\Services::validation(),
            'gaji' => $potongan->paginate(10, 'potongan'),
            'pager' => $this->potonganModel->pager,
            'currentPage' => $currentPage,
        ];


        return view('gaji/potongan', $data);
    }

    public function ubah($id)
    {
        $this->potonganModel->save([
            'id' => $id,
            'id_potongan' => $this->request->getVar('id_potongan'),
            'potongan' =>  $this->request->getVar('potongan'),
            'ket' =>  $this->request->getVar('ket'),
        ]);
        session()->setFlashdata('pesan', 'Potongan berhasil diubah.');
        return redirect()->to('/potongan');
    }
}

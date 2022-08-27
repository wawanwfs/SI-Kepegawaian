<?php

namespace App\Controllers;

use App\Models\GajiModel;
use App\Models\IzinModel;
use CodeIgniter\HTTP\Request;

class Gaji extends BaseController
{
    protected $gajiModel;
    protected $izinModel;
    public function __construct()
    {
        $this->gajiModel = new GajiModel();
        $this->izinModel = new IzinModel();
    }
    public function index()
    {
        $currentPage = $this->request->getVar('page_gaji') ? $this->request->getVar('page_gaji') : 1;

        $keyword = $this->request->getVar('keyword') ? $this->request->getVar('keyword') : '';
        if ($keyword) {
            $gaji = $this->gajiModel->search($keyword);
        } else {
            $gaji = $this->gajiModel->gaji()->orderBy('nik', 'ASC');
        }
        $izin = $this->izinModel->izin();
        $data = [
            'title' => 'SIK - Gaji Karyawan',
            'validation' => \config\Services::validation(),
            'gaji' => $gaji->paginate(10, 'gaji'),
            'pager' => $this->gajiModel->pager,
            'currentPage' => $currentPage,
            'izin' => $izin,
        ];


        return view('gaji/gaji', $data);
    }
}

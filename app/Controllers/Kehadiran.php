<?php

namespace App\Controllers;

use App\Models\KehadiranModel;
use CodeIgniter\HTTP\Request;

class Kehadiran extends BaseController
{
    protected $kehadiranModel;
    public function __construct()
    {
        $this->kehadiranModel = new KehadiranModel();
    }
    public function index()
    {
        $currentPage = $this->request->getVar('page_kehadiran') ? $this->request->getVar('page_kehadiran') : 1;

        $keyword = $this->request->getVar('keyword') ? $this->request->getVar('keyword') : '';
        if ($keyword) {
            $kehadiran = $this->kehadiranModel->search($keyword);
        } else {
            $kehadiran = $this->kehadiranModel->kehadiran()->orderBy('jam_masuk', 'ASC');
        }


        $data = [
            'title' => 'SIK - Daftar Kehadiran',
            'validation' => \config\Services::validation(),
            'kehadiran' => $kehadiran->paginate(10, 'kehadiran'),
            'pager' => $this->kehadiranModel->pager,
            'currentPage' => $currentPage,
        ];


        return view('karyawan/daftar_kehadiran', $data);
    }
}

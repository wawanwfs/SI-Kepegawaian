<?php

namespace App\Controllers;

use App\Models\KaryawanModel;
use App\Models\IzinModel;
use CodeIgniter\HTTP\Request;

class Karyawan extends BaseController
{
    protected $karyawanModel;
    public function __construct()
    {
        $this->karyawanModel = new KaryawanModel();
    }
    public function index()
    {
        $data = [
            'title' => 'SIK - Daftar Karyawan',
            'karyawan' => $this->karyawanModel->getkaryawan(),
        ];
        return view('karyawan/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'SIK - Tambah Karyawan',
            'validation' => \config\Services::validation(),
        ];
        return view('karyawan/create', $data);
    }

    public function store()
    {
        if (!$this->validate([
            'nik' => [
                'rules' => 'required|is_unique[data_karyawan.nik]',
                'errors' => [
                    'required' => '{field} Nomor Induk Karyawan harus diisi.',
                    'is_unique' => 'Nomor Induk Karyawan sudah terdaftar'
                ]
            ],
            'foto' => [
                'rules' => 'max_size[foto,1024]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar terlalu besar',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ]
        ])) {
            return redirect()->to('/karyawan/create')->withInput();
        }

        $filefoto = $this->request->getFile('foto');
        if ($filefoto->getError() == 4) {
            $namafoto = 'default.jpg';
        } else {
            $namafoto = $filefoto->getRandomName();
            $filefoto->move('./profile', $namafoto);
        }

        $slug = url_title($this->request->getVar('nik'), '-', true);
        $this->karyawanModel->save([
            'nik' =>  $this->request->getVar('nik'),
            'slug' => $slug,
            'nama' => $this->request->getVar('nama'),
            'tempat_lahir' => $this->request->getVar('tempat_lahir'),
            'tanggal_lahir' => $this->request->getVar('tanggal_lahir'),
            'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
            'agama' => $this->request->getVar('agama'),
            'alamat' => $this->request->getVar('alamat'),
            'no_telp' => $this->request->getVar('no_telp'),
            'email' => $this->request->getVar('email'),
            'jabatan' => $this->request->getVar('jabatan'),
            'status' => $this->request->getVar('status'),
            'foto' => $namafoto
        ]);
        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');
        return redirect()->to('/karyawan');
    }

    public function detail($slug)
    {
        $data = [
            'title' => 'SIK - Detail Karyawan',
            'karyawan' => $this->karyawanModel->getkaryawan($slug),
        ];
        return view('karyawan/detail', $data);
    }

    public function edit($id)
    {
        $data = [
            'title' => 'SIK - Ubah Data Karyawan',
            'validation' => \config\Services::validation(),
            'karyawan' => $this->karyawanModel->find($id)
        ];
        return view('karyawan/edit', $data);
    }

    public function update($id)
    {
        $karyawanLama = $this->karyawanModel->find($id);
        if ($karyawanLama['nik'] == $this->request->getVar('nik')) {
            $rule_nik = 'required';
        } else {
            $rule_nik = 'required|is_unique[data_karyawan.nik]';
        }
        if (!$this->validate([
            'nik' => [
                'rules' => $rule_nik,
                'errors' => [
                    'required' => '{field} harus diisi.',
                    'is_unique' => '{field} sudah terdaftar'
                ]
            ],
            'foto' => [
                'rules' => 'max_size[foto,1024]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar terlalu besar',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ]
        ])) {
            return redirect()->to('/karyawan/edit/' . $id)->withInput();
        }
        $fileFoto = $this->request->getFile('foto');
        if ($fileFoto->getError() == 4) {
            $namafoto = $karyawanLama['foto'];
        } else {
            $namafoto = $fileFoto->getRandomName();
            $fileFoto->move('./profile/', $namafoto);
            if ($karyawanLama['foto'] != 'default.jpg') {
                unlink('./profile/' . $karyawanLama['foto']);
            }
        }

        $slug = url_title($this->request->getVar('nik'), '-', true);
        $this->karyawanModel->save([
            'id' => $id,
            'nik' =>  $this->request->getVar('nik'),
            'slug' => $slug,
            'nama' => $this->request->getVar('nama'),
            'tempat_lahir' => $this->request->getVar('tempat_lahir'),
            'tanggal_lahir' => $this->request->getVar('tanggal_lahir'),
            'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
            'agama' => $this->request->getVar('agama'),
            'alamat' => $this->request->getVar('alamat'),
            'no_telp' => $this->request->getVar('no_telp'),
            'email' => $this->request->getVar('email'),
            'jabatan' => $this->request->getVar('jabatan'),
            'status' => $this->request->getVar('status'),
            'foto' => $namafoto
        ]);


        session()->setFlashdata('pesan', 'Data berhasil diubah.');

        return redirect()->to('/karyawan');
    }

    public function delete($id)
    {
        $karyawan = $this->karyawanModel->find($id);
        if ($karyawan['foto'] != 'default.jpg') {
            unlink('./profile/' . $karyawan['foto']);
        }
        $this->karyawanModel->Delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/karyawan');
    }
}

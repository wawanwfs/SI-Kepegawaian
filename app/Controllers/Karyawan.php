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
        $currentPage = $this->request->getVar('page_karyawan') ? $this->request->getVar('page_karyawan') : 1;

        $keyword = $this->request->getVar('keyword') ? $this->request->getVar('keyword') : '';
        if ($keyword) {
            $karyawan = $this->karyawanModel->search($keyword);
        } else {
            $karyawan = $this->karyawanModel->karyawan()->orderBy('nik', 'ASC');
        }
        $data = [
            'title' => 'SIK - Daftar Karyawan',
            'validation' => \config\Services::validation(),
            'karyawan' => $karyawan->paginate(10, 'karyawan'),
            'pager' => $this->karyawanModel->pager,
            'currentPage' => $currentPage,
            'jumlah_karyawan' => $this->karyawanModel->countAll(),
        ];
        return view('karyawan/daftar_karyawan', $data);
    }

    public function detail($slug)
    {
        $slug = substr($slug, 1, -1);
        $data = [
            'title' => 'SIK - Detail Karyawan',
            'karyawan' => $this->karyawanModel->getkaryawan($slug),
        ];
        return view('karyawan/daftar_karyawan/detail_karyawan', $data);
    }

    public function save()
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
            return redirect()->to('/daftarkaryawan')->withInput();
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
        return redirect()->to('/daftarkaryawan');
    }

    public function delete($id)
    {
        $id = substr($id, 1, -1);
        $karyawan = $this->karyawanModel->find($id);
        if ($karyawan['foto'] != 'default.jpg') {
            unlink('./profile/' . $karyawan['foto']);
        }
        $this->karyawanModel->Delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/daftarkaryawan');
    }

    public function edit($slug)
    {
        $slug = substr($slug, 1, -1);
        $data = [
            'title' => 'SIK - Ubah Data Karyawan',
            'validation' => \config\Services::validation(),
            'k' => $this->karyawanModel->getkaryawan($slug)
        ];
        return view('karyawan/daftar_karyawan/edit', $data);
    }

    public function update($nik)
    {
        $karyawanLama = $this->karyawanModel->getkaryawan($this->request->getVar('slug'));
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
            return redirect()->to('/daftarkaryawan/edit/' . $this->request->getVar('slug'))->withInput();
        }
        $fileFoto = $this->request->getFile('foto');
        if ($fileFoto->getError() == 4) {
            $namafoto = $karyawanLama['foto'];
        } else {
            $namafoto = $fileFoto->getRandomName();
            $fileFoto->move('./profile/', $namafoto);
            unlink('./profile/' . $karyawanLama['foto']);
        }

        $slug = url_title($this->request->getVar('nik'), '-', true);
        $this->karyawanModel->save([
            'id' => $this->request->getVar('id'),
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

        return redirect()->to('daftarkaryawan');
    }
}

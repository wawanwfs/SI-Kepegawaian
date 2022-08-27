<?php

namespace App\Controllers;

use App\Models\ModelLogin;

class Login extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Login Pegawai',
        ];
        return view('auth/login', $data);
    }

    public function cekUser()
    {
        $nama = $this->request->getPost('iduser');
        $pass = $this->request->getPost('pass');
        $validation = \Config\Services::validation();

        $valid = $this->validate([
            'iduser' => [
                'label' => 'Nama User',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'pass' => [
                'label' => 'Password',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Password Tidak Boleh Kosong'
                ]
            ]
        ]);

        if (!$valid) {
            $sessError = [
                'errNamaUser' => $validation->getError('iduser'),
                'errPassword' => $validation->getError('pass'),
            ];

            session()->setFlashdata($sessError);
            return redirect()->to(site_url('login/index'));
        } else {
            $modelLogin = new ModelLogin();
            $cekuserLogin = $modelLogin->find($nama, $pass);
            // $cekuserLogin = $modelLogin->find($nama, $pass);

            // var_dump($cekuserLogin);

            if ($cekuserLogin == null) {
                $sessError = [
                    'errNamaUser' => 'Maaf user, tidak terdaftar',
                ];

                session()->setFlashdata($sessError);
                return redirect()->to(site_url('login/index'));
            } else {
                if ($cekuserLogin['useraktif'] != '1') {
                    $sessError = [
                        'errNamaUser' => 'Maaf user tidak aktif, silahkan hubungi admin',
                    ];

                    session()->setFlashdata($sessError);
                    return redirect()->to(site_url('login/index'));
                } else {
                    $passwordUser = $cekuserLogin['userpassword'];
                    if (password_verify($pass, $passwordUser)) {
                        //lanjutkan
                        $idlevel = $cekuserLogin['userlevelid'];

                        $simpan_session = [
                            'iduser' => $nama,
                            'namauser' => $cekuserLogin['username'],
                            'idlevel' => $idlevel
                        ];
                        session()->set($simpan_session);

                        return redirect()->to('/home');
                    } else {
                        $sessError = [
                            'errPassword' => 'Password anda salah',
                        ];
                        session()->setFlashdata($sessError);
                        return redirect()->to(site_url('login/index'));
                    }
                }
            }
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(site_url('login/index'));
    }
}

<?php

namespace App\Controllers;

use App\Models\Modeluser;

use App\Controllers\BaseController;

class User extends BaseController
{

    public function index()
    {
        $data = [
            'title' => 'Reset Password',
        ];
        return view('user/reset', $data);
    }

    function updatepassword()
    {
        if ($this->request->isAJAX()) {
            $iduser = session()->iduser;
            $passlama = $this->request->getPost('passlama');
            $passbaru = $this->request->getPost('passbaru');
            $confirmpass = $this->request->getPost('confirmpass');

            $validation = \Config\Services::validation();

            $valid = $this->validate([
                'passlama' => [
                    'rules' => 'required',
                    'label' => 'Password Lama',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]
                ],
                'passbaru' => [
                    'rules' => 'required',
                    'label' => 'Password Baru',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]
                ],
                'confirmpass' => [
                    'rules' => 'required|matches[passbaru]',
                    'label' => 'Confirm Password',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'matches' => '{field} harus sama'
                    ]
                ]
            ]);

            if (!$valid) {
                $error = [
                    'passlama' => $validation->getError('passlama'),
                    'passbaru' => $validation->getError('passbaru'),
                    'confirmpass' => $validation->getError('confirmpass'),
                ];

                $json = [
                    'error' => $error
                ];
            } else {
                $modelUser = new Modeluser();
                $rowData = $modelUser->find($iduser);
                $passUser = $rowData['userpassword'];

                if (password_verify($passlama, $passUser)) {

                    $hashPasswordBaru = password_hash($passbaru, PASSWORD_DEFAULT);
                    $modelUser->update($iduser, [
                        'userpassword' => $hashPasswordBaru
                    ]);

                    $json = [
                        'sukses' => 'Password anda berhasil diganti'
                    ];
                } else {
                    $error = [
                        'passlama' => 'Password Lama tidak sama'
                    ];
                    $json = [
                        'error' => $error
                    ];
                }
            }

            echo json_encode($json);
        }
    }
}

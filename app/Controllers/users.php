<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Modeluser;
use \Hermawan\DataTables\DataTable;

class Users extends BaseController
{
    protected $helpers = ['form', 'url'];
    public function index()
    {
        $data = [
            'title' => 'Management User',
        ];
        return view('users/data', $data);
    }

    function listData()
    {
        if ($this->request->isAJAX()) {
            $db = \Config\Database::connect();
            $builder = $db->table('users')->select('userid, username, levelnama, useraktif,userlevelid')
                ->join('levels', 'levelid = userlevelid');


            return DataTable::of($builder)
                ->addNumbering('nomor')
                ->add('status', function ($row) {
                    if ($row->useraktif == '1') {
                        return '<span class="badge badge-success">Active</span>';
                    } else {
                        return '<span class="badge badge-danger">Non Active</span>';
                    }
                })
                ->add('aksi', function ($row) {
                    if ($row->userlevelid != '1') {
                        return "<button type=\"button\" class=\"btn btn-sm btn-info\" onclick=\"view('" . $row->userid . "')\">
                            View
                        </button>";
                    }
                })
                ->toJson(true);
        }
    }

    function formtambah()
    {
        helper(['form', 'url']);
        if ($this->request->isAJAX()) {
            $db = db_connect();
            $data = [
                'datalevel' => $db->table('levels')->where('levelid !=', '0')->get()
            ];
            echo view('users/modaltambah', $data);
        }
    }

    function formedit()
    {
        if ($this->request->isAJAX()) {
            $iduser = $this->request->getPost('userid');
            $modelUser = new Modeluser();
            $rowUser = $modelUser->find($iduser);

            if ($rowUser) {
                $db = \Config\Database::connect();

                $data = [
                    'datalevel' => $db->table('levels')->where('levelid !=', '0')->get(),
                    'iduser' => $iduser,
                    'namalengkap' => $rowUser['username'],
                    'level' => $rowUser['userlevelid'],
                    'status' => $rowUser['useraktif']
                ];
                echo view('users/modaledit', $data);
            }
        }
    }

    function simpan()
    {
        if ($this->request->isAJAX()) {
            $iduser = $this->request->getVar('iduser');
            $namalengkap = $this->request->getVar('namalengkap');
            $level = $this->request->getVar('level');

            $validation = \Config\Services::validation();

            $valid = $this->validate([
                'iduser' => [
                    'rules' => 'required|is_unique[users.userid]',
                    'label' => 'ID User',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'is_unique' => '{field} tidak boleh ada yang sama',
                    ]
                ],
                'namalengkap' => [
                    'rules' => 'required',
                    'label' => 'Nama Lengkap',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'level' => [
                    'rules' => 'required',
                    'label' => 'Level',
                    'errors' => [
                        'required' => '{field} wajib di pilih',
                    ]
                ],
            ]);

            if (!$valid) {
                $error = [
                    'iduser' => $validation->getError('iduser'),
                    'namalengkap' => $validation->getError('namalengkap'),
                    'level' => $validation->getError('level'),
                ];

                $json = [
                    'error' => $error
                ];
            } else {
                $modelUser = new Modeluser();
                $modelUser->insert([
                    'userid' => $iduser,
                    'username' => $namalengkap,
                    'userlevelid' => $level
                ]);

                $json = [
                    'sukses' => 'Simpan Data user berhasil !'
                ];
            }

            echo json_encode($json);
        }
    }

    function update()
    {
        if ($this->request->isAJAX()) {
            $iduser = $this->request->getVar('iduser');
            $namalengkap = $this->request->getVar('namalengkap');
            $level = $this->request->getVar('level');


            $modelUser = new Modeluser();
            $modelUser->update($iduser, [
                'userid' => $iduser,
                'username' => $namalengkap,
                'userlevelid' => $level
            ]);

            $json = [
                'sukses' => 'Update Data user berhasil !'
            ];


            echo json_encode($json);
        }
    }

    function updateStatus()
    {
        if ($this->request->isAJAX()) {
            $iduser = $this->request->getVar('iduser');
            $modelUser = new Modeluser();
            $rowuser = $modelUser->find($iduser);

            $useraktif = $rowuser['useraktif'];

            if ($useraktif == '1') {
                $modelUser->update($iduser, [
                    'useraktif' => '0'
                ]);
            } else {
                $modelUser->update($iduser, [
                    'useraktif' => '1'
                ]);
            }

            $json = [
                'sukses' => ''
            ];
            echo json_encode($json);
        }
    }

    function hapus()
    {
        if ($this->request->isAJAX()) {
            $iduser = $this->request->getPost('iduser');

            $modelUser = new Modeluser();
            $modelUser->delete($iduser);

            $json = [
                'sukses' => 'Id User berhasil dihapus !'
            ];
            echo json_encode($json);
        }
    }

    function resetPassword()
    {
        if ($this->request->isAJAX()) {
            $iduser = $this->request->getPost('iduser');

            $modelUser = new Modeluser();
            $passRandom = rand(1, 99999);

            $passHashBaru = password_hash($passRandom, PASSWORD_DEFAULT);

            $modelUser->update($iduser, [
                'userpassword' => $passHashBaru
            ]);

            $json = [
                'sukses' => '',
                'passwordBaru' => $passRandom
            ];

            echo json_encode($json);
        }
    }
}

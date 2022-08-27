<?php

namespace App\Models;

use App\Controllers\Potongan;
use CodeIgniter\Model;

class PotonganModel extends Model
{
    protected $table = 'gaji_potongan';
    protected $allowedFields = ['id', 'id_potongan', 'potongan', 'ket'];

    public function potongan()
    {
        return $this->table('gaji_potongan')
            ->join('izin', 'gaji_potongan.id_potongan = izin.id_izin', 'right');
    }

    public function search($keyword)
    {
        return $this->table('gaji_potongan')
            ->join('izin', 'gaji_potongan.id_potongan = izin.id_izin', 'right')
            ->Like('jenis_izin', $keyword);
    }
}

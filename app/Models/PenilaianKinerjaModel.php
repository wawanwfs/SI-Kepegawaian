<?php

namespace App\Models;

use CodeIgniter\Model;

class PenilaianKinerjaModel extends Model
{
    protected $table            = 'penilaian_kinerja';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $allowedFields    = ['id_karyawan', 'tanggal_penilaian', 'nilai', 'catatan'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getPenilaianKinerja($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }

        return $this->where(['id' => $id])->first();
    }
}

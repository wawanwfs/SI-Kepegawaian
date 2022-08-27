<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelUser extends Model
{
    protected $table                = 'users';
    protected $primaryKey           = 'userid';
    protected $allowedFields        = [
        'userid', 'username', 'userpassword', 'useraktif', 'userlevelid'
    ];
}

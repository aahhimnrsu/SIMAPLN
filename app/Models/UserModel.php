<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = "tb_user";
    protected $returnType = 'object';
    protected $primaryKey = "id";
    protected $allowedFields = ["nama", "username","password","qrcode","role"];
    protected $useTimestamps = false;

}
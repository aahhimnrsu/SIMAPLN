<?php

namespace App\Models;

use CodeIgniter\Model;

class NotifikasiModel extends Model
{
    protected $table = "tb_notifikasi";
    protected $returnType = 'object';
    protected $primaryKey = "id";
    protected $allowedFields = ["id_user","id_penerima", "notifikasi","timestamp","status"];
    protected $useTimestamps = false;

}
<?php

namespace App\Models;

use CodeIgniter\Model;

class PesertaModel extends Model
{
    protected $table = "tb_peserta";
    protected $returnType = 'object';
    protected $primaryKey = "id";
    protected $allowedFields = ["nama","instansi","tglmasuk", "tglkeluar", "id_user","id_pembimbing","tim"];
    protected $useTimestamps = false;

}


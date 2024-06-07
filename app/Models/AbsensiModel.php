<?php

namespace App\Models;

use CodeIgniter\Model;

class AbsensiModel extends Model
{
    protected $table = "tb_absensi";
    protected $returnType = 'object';
    protected $primaryKey = "id";
    protected $allowedFields = ["idpeserta","nama", "instansi", "tim", "tanggal","waktukehadiran","lokasikehadiran", "fotokehadiran","waktukepulangan","lokasikepulangan","fotokepulangan","fotoeviden","keteranganeviden","suratsakit","keteranganizin", "statuskehadiran"];
    protected $useTimestamps = false;

}


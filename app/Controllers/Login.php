<?php

namespace App\Controllers;

use App\Models\PesertaModel;
use App\Models\AbsensiModel;
use App\Models\UserModel;

class Login extends BaseController
{
    public function __construct()
    {
        $PesertaModel = new PesertaModel();
        $session = \Config\Services::session();
    }
    public function autoabsen()
    {
        $time = date('H:i:s');
        $date = date('Y-m-d');
        $day = date('D');
        $AbsensiModel = new AbsensiModel();
        $PesertaModel = new PesertaModel();

        $tanggal = $AbsensiModel->select('tanggal')->orderBy('tanggal', 'DESC')->first();
        $data = $PesertaModel->findAll();
        $dataalfa = $AbsensiModel->where(['tanggal' => $date, 'waktukehadiran' => NULL, 'statuskehadiran !=' => 'Alfa'])->get()->getResult();
        // $tanggal = $AbsensiModel->findColumn('tanggal');
        $instansipeserta = $PesertaModel->findColumn('instansi');
        $timpeserta = $PesertaModel->findColumn('tim');

        if(empty($tanggal->tanggal)){
            foreach ($data as $datas) {
                $AbsensiModel->insert([
                    'idpeserta' => $datas->id,
                    'nama' => $datas->nama,
                    'instansi' => $datas->instansi,
                    'tim' => $datas->tim,
                    'tanggal' => $date,
                    'statuskehadiran' => 'Belum Absen',
                ]);
            }
        }elseif($tanggal->tanggal != $date){
            foreach ($data as $datas) {
                $AbsensiModel->insert([
                    'idpeserta' => $datas->id,
                    'nama' => $datas->nama,
                    'instansi' => $datas->instansi,
                    'tim' => $datas->tim,
                    'tanggal' => $date,
                    'statuskehadiran' => 'Belum Absen',
                ]);
            }
        }

        if($time > '16:00:00' && $time < '23:59:59'){
            foreach($dataalfa as $alfa){
                $AbsensiModel->update($alfa->id,[
                    'waktukehadiran' => '-',
                    'lokasikehadiran' => '-',
                    'fotokehadiran' => '-',
                    'waktukepulangan' => '-',
                    'lokasikepulangan' => '-',
                    'fotokepulangan' => '-',
                    'fotoeviden' => '-',
                    'keteranganeviden' => '-',
                    'statuskehadiran' => 'Alfa',
                ]);
            }
        }

    }
    public function index()
    {
        return view('loginbiasa');
    }

    public function loginqrcode()
    {
        
        $this->autoabsen();
        return view('login');
    }

    public function proses()
    {
        $session = \Config\Services::session();
        $UserModel = new UserModel();
        $PesertaModel = new PesertaModel();
        //ambil data dari form
        $data = $this->request->getPost();

        //ambil data user di database yang usernamenya sama 
        $user = $UserModel->where('username', $data['username'])->first();
        $id_user = $user->id;
        $peserta = $PesertaModel->where('id_user', $id_user)->first();

        //cek apakah username ditemukan
        if ($user) {
            //cek password
            //jika salah arahkan lagi ke halaman login
            if ($user->password != $data['password']) {
                session()->setFlashdata('password', 'Password Salah');
                return redirect()->to('/');
            } else {
                //jika benar, arahkan user masuk ke aplikasi 
                if(empty($peserta->id)){
                    $sessLogin = [
                    'isLogin' => true,
                    'username' => $user->username,
                    'nama' => $user->nama,
                    'id_user' => $id_user,
                    'role' => $user->role
                    ];    
                }else{
                    $sessLogin = [
                    'isLogin' => true,
                    'username' => $user->username,
                    'nama' => $user->nama,
                    'instansi' => $peserta->instansi,
                    'tim' => $peserta->tim,
                    'id' => $peserta->id,
                    'id_user' => $id_user,
                    'role' => $user->role
                    ];
                }
                $session->set($sessLogin);

                return redirect()->to('dashboard');
            }
        } else {
            //jika username tidak ditemukan, balikkan ke halaman login
            session()->setFlashdata('username', 'username Tidak Terdaftar');
            return redirect()->to('/');
        }
    }

    public function prosesqrcode()
    {
        $session = \Config\Services::session();
        $PesertaModel = new PesertaModel();
        $UserModel = new UserModel();
        //ambil data dari form
        $data = $this->request->getPost();
        $config         = new \Config\Encryption();
        $config->key    = 'simapln123';
        $config->driver = 'OpenSSL';
        $config->rawData  = false;

        $encrypter = \Config\Services::encrypter($config);
        // echo $encrypter->encrypt(base64_encode('2'));
        
        $id_user = $encrypter->decrypt($data['id']);
        // var_dump($id_user);
        // die;

        //ambil data user di database yang usernamenya sama 
        $peserta = $PesertaModel->where('id_user', $id_user)->first();
        $user = $UserModel->where('id', $id_user)->first();
        $id_user = $user->id;

        //cek apakah username ditemukan
        if ($user) {

            if(empty($peserta->id)){
                $sessLogin = [
                'isLogin' => true,
                'username' => $user->username,
                'nama' => $user->nama,
                'id_user' => $id_user,
                'role' => $user->role
                ];    
            }else{
                $sessLogin = [
                'isLogin' => true,
                'username' => $user->username,
                'nama' => $user->nama,
                'instansi' => $peserta->instansi,
                'tim' => $peserta->tim,
                'id' => $peserta->id,
                'id_user' => $id_user,
                'role' => $user->role
                ];
            }
            $session->set($sessLogin);

            return redirect()->to('dashboard');
        } else {
            //jika username tidak ditemukan, balikkan ke halaman login
            session()->setFlashdata('username', 'username Tidak Terdaftar');
            return redirect()->to('/');
        }
    }

    function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}

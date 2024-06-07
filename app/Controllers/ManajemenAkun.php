<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\NotifikasiModel;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\Logo\Logo;
use Endroid\QrCode\RoundBlockSizeMode;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Writer\ValidationException;



class ManajemenAkun extends BaseController
{
    public function akunadmin()
    {

        if (session()->isLogin != true) {
            return redirect('/');
        }

        $UserModel = new UserModel();
        $NotifikasiModel = new NotifikasiModel();
        $data = array(
            'countnotif' => $NotifikasiModel->where(['id_penerima'=> session()->get('id_user'), 'status' => 'Unread'])->countAllResults(),
            'notif' => $NotifikasiModel->where(['id_penerima'=> session()->get('id_user'), 'status' => 'Unread'])->orderBy('id', 'DESC')->limit(4)->get()->getResult(),
            'datapeserta' => $UserModel->where('role', 'Admin')->get()->getResult(),
            'page' => 'Manajemen Akun'
        );
        echo view('partials/header', $data);
        echo view('partials/navbar', $data);
        echo view('partials/sidebar', $data);
        echo view('manajemenakun/vw_dataakun', $data);
        echo view('partials/footer', $data);
    }

    public function akundosenguru()
    {

        if (session()->isLogin != true) {
            return redirect('/');
        }

        $UserModel = new UserModel();
        $NotifikasiModel = new NotifikasiModel();
        $data = array(
            'countnotif' => $NotifikasiModel->where(['id_penerima'=> session()->get('id_user'), 'status' => 'Unread'])->countAllResults(),
            'notif' => $NotifikasiModel->where(['id_penerima'=> session()->get('id_user'), 'status' => 'Unread'])->orderBy('id', 'DESC')->limit(4)->get()->getResult(),
            'datapeserta' => $UserModel->where('role', 'Dosen/Guru')->get()->getResult(),
            'page' => 'Manajemen Akun'
        );
        echo view('partials/header', $data);
        echo view('partials/navbar', $data);
        echo view('partials/sidebar', $data);
        echo view('manajemenakun/vw_dataakun', $data);
        echo view('partials/footer', $data);
    }

    public function akunpeserta()
    {

        if (session()->isLogin != true) {
            return redirect('/');
        }

        $UserModel = new UserModel();
        $NotifikasiModel = new NotifikasiModel();
        $data = array(
            'countnotif' => $NotifikasiModel->where(['id_penerima'=> session()->get('id_user'), 'status' => 'Unread'])->countAllResults(),
            'notif' => $NotifikasiModel->where(['id_penerima'=> session()->get('id_user'), 'status' => 'Unread'])->orderBy('id', 'DESC')->limit(4)->get()->getResult(),
            'datapeserta' => $UserModel->where('role', 'Peserta')->get()->getResult(),
            'page' => 'Manajemen Akun'
        );
        echo view('partials/header', $data);
        echo view('partials/navbar', $data);
        echo view('partials/sidebar', $data);
        echo view('manajemenakun/vw_dataakun', $data);
        echo view('partials/footer', $data);
    }

    public function tambah()
    {

        if (session()->isLogin != true) {
            return redirect('/');
        }

        $NotifikasiModel = new NotifikasiModel();
        $data = array(
            'countnotif' => $NotifikasiModel->where(['id_penerima'=> session()->get('id_user'), 'status' => 'Unread'])->countAllResults(),
            'notif' => $NotifikasiModel->where(['id_penerima'=> session()->get('id_user'), 'status' => 'Unread'])->orderBy('id', 'DESC')->limit(4)->get()->getResult(),
            'page' => 'Tambah Akun'
        );
        echo view('partials/header', $data);
        echo view('partials/navbar', $data);
        echo view('partials/sidebar', $data);
        echo view('manajemenakun/vw_tambahakun', $data);
        echo view('partials/footer', $data);
    }

    public function prosestambah()
    {
        $UserModel = new UserModel();
        
        $UserModel->insert([
            'nama' => $this->request->getPost('nama'),
            'username' => $this->request->getPost('username'),
            'password' => $this->request->getPost('password'),
            'role' => $this->request->getPost('role'),
            'qrcode' => '/assets/img/qrcodex.png',
        ]);

        return redirect()->to(base_url('manajemenakun/admin'));
        
    }

    public function generateqr($id = false)
    {
        $UserModel = new UserModel();
        $writer = new PngWriter();
        $config         = new \Config\Encryption();
        $config->key    = 'simapln123';
        $config->driver = 'OpenSSL';
        $config->rawData  = false;
    
        $encrypter = \Config\Services::encrypter($config);
        $id_user = $encrypter->encrypt($id);
        // Create QR code
        $qrCode = QrCode::create($id_user)
            ->setEncoding(new Encoding('UTF-8'))
            ->setErrorCorrectionLevel(ErrorCorrectionLevel::Low)
            ->setSize(300)
            ->setMargin(10)
            ->setRoundBlockSizeMode(RoundBlockSizeMode::Margin)
            ->setForegroundColor(new Color(0, 0, 0))
            ->setBackgroundColor(new Color(255, 255, 255));

    
        $result = $writer->write($qrCode);

        // Save it to a file
        $result->saveToFile('assets/uploads/qrcode/qrcode'.$id.'.png');

        $UserModel->update($id,[
            'qrcode' => '/assets/uploads/qrcode/qrcode'.$id.'.png',
        ]);
        // $writer->validateResult($result, $id);
        return redirect()->back();
    }

    public function detail($id = false)
    {

        if (session()->isLogin != true) {
            return redirect('/');
        }

        $UserModel = new UserModel();
        $NotifikasiModel = new NotifikasiModel();
        $data = array(
            'countnotif' => $NotifikasiModel->where(['id_penerima'=> session()->get('id_user'), 'status' => 'Unread'])->countAllResults(),
            'notif' => $NotifikasiModel->where(['id_penerima'=> session()->get('id_user'), 'status' => 'Unread'])->orderBy('id', 'DESC')->limit(4)->get()->getResult(),
            'dataakun' => $UserModel->where('id', $id)->get()->getResult(),
            'page' => 'Detail Akun'
        );
        echo view('partials/header', $data);
        echo view('partials/navbar', $data);
        echo view('partials/sidebar', $data);
        echo view('manajemenakun/vw_detailakun', $data);
        echo view('partials/footer', $data);
    }

    public function edit($id = false)
    {

        if (session()->isLogin != true) {
            return redirect('/');
        }

        $UserModel = new UserModel();
        $NotifikasiModel = new NotifikasiModel();
        $data = array(
            'countnotif' => $NotifikasiModel->where(['id_penerima'=> session()->get('id_user'), 'status' => 'Unread'])->countAllResults(),
            'notif' => $NotifikasiModel->where(['id_penerima'=> session()->get('id_user'), 'status' => 'Unread'])->orderBy('id', 'DESC')->limit(4)->get()->getResult(),
            'dataakun' => $UserModel->where('id', $id)->get()->getResult(),
            'page' => 'Manajemen Akun'
        );
        echo view('partials/header', $data);
        echo view('partials/navbar', $data);
        echo view('partials/sidebar', $data);
        echo view('manajemenakun/vw_editakun', $data);
        echo view('partials/footer', $data);
    }

    public function prosesedit()
    {
        $UserModel = new UserModel();
        $id = $this->request->getPost('id');
        $password = $this->request->getPost('password');

        if($password != ''){
            $UserModel->update($id,[
                'nama' => $this->request->getPost('nama'),
                'username' => $this->request->getPost('username'),
                'password' => $this->request->getPost('password'),
                'role' => $this->request->getPost('role'),
            ]);
        }else{
            $UserModel->update($id,[
                'nama' => $this->request->getPost('nama'),
                'username' => $this->request->getPost('username'),
                'role' => $this->request->getPost('role'),
            ]);
        }

        return redirect()->to(base_url('manajemenakun/admin'));
        
    }

    public function hapus($id = false)
    {
        $UserModel = new UserModel();
        $UserModel->delete($id);
        return redirect()->to(base_url('peserta'));
    }

    public function download($id = false)
    {
        return $this->response->download('assets/uploads/qrcode/' . $id.'.png', null);
    }
}

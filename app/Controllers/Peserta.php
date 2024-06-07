<?php

namespace App\Controllers;

use App\Models\PesertaModel;
use App\Models\AbsensiModel;
use App\Models\NotifikasiModel;
use App\Models\UserModel;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\Logo\Logo;
use Endroid\QrCode\RoundBlockSizeMode;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Writer\ValidationException;



class Peserta extends BaseController
{
    public function index()
    {

        if (session()->isLogin != true) {
            return redirect('/');
        }
        // $abspath=$_SERVER['DOCUMENT_ROOT']; 
        // print_r($abspath);

        $PesertaModel = new PesertaModel();
        if(session()->get('role') == 'Admin'){
            $datapeserta = $PesertaModel->findAll();
        }else{
            $datapeserta = $PesertaModel->where('id_pembimbing', session()->get('id_user'))->get()->getResult();
        }
        
        $NotifikasiModel = new NotifikasiModel();
        $data = array(
            'countnotif' => $NotifikasiModel->where(['id_penerima'=> session()->get('id_user'), 'status' => 'Unread'])->countAllResults(),
            'notif' => $NotifikasiModel->where(['id_penerima'=> session()->get('id_user'), 'status' => 'Unread'])->orderBy('id', 'DESC')->limit(4)->get()->getResult(),
            'datapeserta' => $datapeserta,
            'page' => 'Peserta'
        );
        echo view('partials/header', $data);
        echo view('partials/navbar', $data);
        echo view('partials/sidebar', $data);
        echo view('peserta/vw_datapeserta', $data);
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
            'page' => 'Peserta'
        );
        echo view('partials/header', $data);
        echo view('partials/navbar', $data);
        echo view('partials/sidebar', $data);
        echo view('peserta/vw_tambahpeserta', $data);
        echo view('partials/footer', $data);
    }

    public function prosestambah()
    {
        $PesertaModel = new PesertaModel();
        
        $PesertaModel->insert([
            'nama' => $this->request->getPost('nama'),
            'id_user' => $this->request->getPost('id_user'),
            'id_pembimbing' => $this->request->getPost('id_pembimbing'),
            'instansi' => $this->request->getPost('instansi'),
            'tim' => $this->request->getPost('tim'),
            'tglmasuk' => $this->request->getPost('tglmasuk'),
            'tglkeluar' => $this->request->getPost('tglkeluar'),
        ]);

        session()->destroy();
        return redirect()->to('/');
        
    }

    public function generateqr($id = false)
    {
        $PesertaModel = new PesertaModel();
        $writer = new PngWriter();
        // Create QR code
        $qrCode = QrCode::create($id)
            ->setEncoding(new Encoding('UTF-8'))
            ->setErrorCorrectionLevel(ErrorCorrectionLevel::Low)
            ->setSize(300)
            ->setMargin(10)
            ->setRoundBlockSizeMode(RoundBlockSizeMode::Margin)
            ->setForegroundColor(new Color(0, 0, 0))
            ->setBackgroundColor(new Color(255, 255, 255));

    
        $result = $writer->write($qrCode);

        // Save it to a file
        $result->saveToFile('assets/uploads/qrcode/'. $id . '.png');

        $PesertaModel->update($id,[
            'qrcode' => '/assets/uploads/qrcode/'.$id.'.png',
        ]);
        // $writer->validateResult($result, $id);
        return redirect()->back();
    }

    public function detail($id = false)
    {

        if (session()->isLogin != true) {
            return redirect('/');
        }

        $PesertaModel = new PesertaModel();
        $AbsensiModel = new AbsensiModel();
        $UserModel = new UserModel();
        $datapeserta = $PesertaModel->where('id', $id)->get()->getResult();
        foreach($datapeserta as $data){
            $id_user = $data->id_user;
        };
        $NotifikasiModel = new NotifikasiModel();
        $data = array(
            'countnotif' => $NotifikasiModel->where(['id_penerima'=> session()->get('id_user'), 'status' => 'Unread'])->countAllResults(),
            'notif' => $NotifikasiModel->where(['id_penerima'=> session()->get('id_user'), 'status' => 'Unread'])->orderBy('id', 'DESC')->limit(4)->get()->getResult(),
            'datakehadiran' => $AbsensiModel->orderBy('id','DESC')->where(['idpeserta' => $id])->get()->getResult(),
            'datapeserta' => $PesertaModel->where('id', $id)->get()->getResult(),
            'dataakun' => $UserModel->where('id', $id_user)->get()->getResult(),
            'page' => 'Peserta'
        );
        echo view('partials/header', $data);
        echo view('partials/navbar', $data);
        echo view('partials/sidebar', $data);
        echo view('peserta/vw_detailpeserta', $data);
        echo view('partials/footer', $data);
    }

    public function edit($id = false)
    {

        if (session()->isLogin != true) {
            return redirect('/');
        }

        $PesertaModel = new PesertaModel();
        $UserModel = new UserModel();
        $NotifikasiModel = new NotifikasiModel();
        $data = array(
            'countnotif' => $NotifikasiModel->where(['id_penerima'=> session()->get('id_user'), 'status' => 'Unread'])->countAllResults(),
            'notif' => $NotifikasiModel->where(['id_penerima'=> session()->get('id_user'), 'status' => 'Unread'])->orderBy('id', 'DESC')->limit(4)->get()->getResult(),
            'datapeserta' => $PesertaModel->where('id', $id)->get()->getResult(),
            'pembimbing' => $UserModel->where('role', 'Dosen/Guru')->get()->getResult(), //MENAMPILKAN DATA PESERTA
            'page' => 'Peserta'
        );
        echo view('partials/header', $data);
        echo view('partials/navbar', $data);
        echo view('partials/sidebar', $data);
        echo view('peserta/vw_editpeserta', $data);
        echo view('partials/footer', $data);
    }

    public function prosesedit()
    {
        $PesertaModel = new PesertaModel();
        $id = $this->request->getPost('id');
        $id_pembimbing = $this->request->getPost('id_pembimbing');

        if($id_pembimbing != ''){
            $PesertaModel->update($id,[
                'nama' => $this->request->getPost('nama'),
                'instansi' => $this->request->getPost('instansi'),
                'tim' => $this->request->getPost('tim'),
                'tglmasuk' => $this->request->getPost('tglmasuk'),
                'tglkeluar' => $this->request->getPost('tglkeluar'),
                'id_user' => $this->request->getPost('id_user'),
                'id_pembimbing' => $this->request->getPost('id_pembimbing'),
            ]);
        }else{
            $PesertaModel->update($id,[
                'nama' => $this->request->getPost('nama'),
                'instansi' => $this->request->getPost('instansi'),
                'tim' => $this->request->getPost('tim'),
                'tglmasuk' => $this->request->getPost('tglmasuk'),
                'tglkeluar' => $this->request->getPost('tglkeluar'),
                'id_user' => $this->request->getPost('id_user'),
                'id_pembimbing' => $this->request->getPost('id_pembimbing'),
            ]);
        }

        return redirect()->to(base_url('peserta'));
        
    }

    public function hapus($id = false)
    {
        $PesertaModel = new PesertaModel();
        $AbsensiModel = new AbsensiModel();
        
        $dataabsensi = $AbsensiModel->where('idpeserta', $id)->get()->getResult();
        foreach($dataabsensi as $data){
            unlink('C:/xampp/htdocs/SIMAPLN/public/assets/uploads/fotokehadiran/'.$data->fotokehadiran);
            unlink('C:/xampp/htdocs/SIMAPLN/public/assets/uploads/fotokepulangan/'.$data->fotokepulangan);
            unlink('C:/xampp/htdocs/SIMAPLN/public/assets/uploads/fotoeviden/'.$data->fotoeviden);
            $AbsensiModel->delete($data->id);
        };
        $PesertaModel->delete($id);
        return redirect()->to(base_url('peserta'));
    }

    public function download($id = false)
    {
        return $this->response->download('assets/uploads/qrcode/' . $id.'.png', null);
    }
}

<?php

namespace App\Controllers;

use App\Models\PesertaModel;
use App\Models\UserModel;
use App\Models\AbsensiModel;
use App\Models\NotifikasiModel;

class Dashboard extends BaseController
{

    //TAMPILAN DASHBOARD
    public function index()
    {
        $PesertaModel = new PesertaModel();
        $AbsensiModel = new AbsensiModel();
        if(session()->get('role') == 'Admin'){
            $datapeserta = $PesertaModel->findAll();
        }else{
            $datapeserta = $PesertaModel->where('id_pembimbing', session()->get('id_user'))->get()->getResult();
        }
        if(session()->isLogin != true){
            return redirect('/');
        }
        $NotifikasiModel = new NotifikasiModel();
        $data = array(
            'countnotif' => $NotifikasiModel->where(['id_penerima'=> session()->get('id_user'), 'status' => 'Unread'])->countAllResults(),
            'notif' => $NotifikasiModel->where(['id_penerima'=> session()->get('id_user'), 'status' => 'Unread'])->orderBy('id', 'DESC')->limit(4)->get()->getResult(),
            'datapeserta' => $datapeserta,
            'datakehadiran' => $AbsensiModel->where('idpeserta', session()->get('id'))->get()->getResult(), //UNTUK MENAMPILKAN DATA KEHADIRAN
            'counthadir' => $AbsensiModel->where(['idpeserta'=> session()->get('id'), 'statuskehadiran' => 'Hadir'])->countAllResults(), //UNTUK MENGHITUNG JUMLAH KEHADIRAN
            'countizin' => $AbsensiModel->where(['idpeserta'=> session()->get('id'), 'statuskehadiran' => 'Izin'])->countAllResults(), //UNTUK MENGHITUNG JUMLAH IZIN
            'countsakit' => $AbsensiModel->where(['idpeserta'=> session()->get('id'), 'statuskehadiran' => 'Sakit'])->countAllResults(), //UNTUK MENGHITUNG JUMLAH SAKIT
            'countalfa' => $AbsensiModel->where(['idpeserta'=> session()->get('id'), 'statuskehadiran' => 'Alfa'])->countAllResults(), //UNTUK MENGHITUNG JUMLAH TERLAMBAT
            'countterlambat' => $AbsensiModel->where(['idpeserta'=> session()->get('id'), 'statuskehadiran' => 'Terlambat'])->countAllResults(), //UNTUK MENGHITUNG JUMLAH TERLAMBAT
            'page' => 'Dashboard'
        );
        echo view('partials/header', $data);
        echo view('partials/navbar', $data);
        echo view('partials/sidebar', $data);
        echo view('vw_dashboard');
        echo view('partials/footer', $data);
    }


    //TAMPILAN PROFILE
    public function profile()
    {

        if (session()->isLogin != true) {
            return redirect('/');
        }

        $id = session()->get('id');
        $id_user = session()->get('id_user');
        $PesertaModel = new PesertaModel();
        $UserModel = new UserModel();
        $NotifikasiModel = new NotifikasiModel();
        $data = array(
            'countnotif' => $NotifikasiModel->where(['id_penerima'=> session()->get('id_user'), 'status' => 'Unread'])->countAllResults(),
            'notif' => $NotifikasiModel->where(['id_penerima'=> session()->get('id_user'), 'status' => 'Unread'])->orderBy('id', 'DESC')->limit(4)->get()->getResult(),
            'datapeserta' => $PesertaModel->where('id', $id)->get()->getResult(), //MENAMPILKAN DATA PESERTA
            'pembimbing' => $UserModel->where('role', 'Dosen/Guru')->get()->getResult(), //MENAMPILKAN DATA PESERTA
            'dataakun' => $UserModel->where('id', $id_user)->get()->getResult(), //MENAMPILKAN DATA PESERTA
            'page' => 'Profile'
        );
        echo view('partials/header', $data);
        echo view('partials/navbar', $data);
        echo view('partials/sidebar', $data);
        echo view('peserta/vw_editpeserta', $data);
        echo view('partials/footer', $data);
    }


    //EDIT DATA PROFILE
    public function prosesedit()
    {
        $PesertaModel = new PesertaModel();
        $UserModel = new UserModel();
        $id = $this->request->getPost('id');
        $id_user = session()->get('id_user');
        $password = $this->request->getPost('password');

            $PesertaModel->update($id,[
                'nama' => $this->request->getPost('nama'),
                'instansi' => $this->request->getPost('instansi'),
                'tim' => $this->request->getPost('tim'),
                'tglmasuk' => $this->request->getPost('tglmasuk'),
                'tglkeluar' => $this->request->getPost('tglkeluar'),
            ]);
            $UserModel->update($id_user,[
                'username' => $this->request->getPost('username'),
                'password' => $this->request->getPost('password'),
            ]);

        return redirect()->to(base_url('profile'));
        
    }

    public function notifikasi()
    {

        if (session()->isLogin != true) {
            return redirect('/');
        }

        $id = session()->get('id');
        $id_user = session()->get('id_user');
        $PesertaModel = new PesertaModel();
        $UserModel = new UserModel();
        $NotifikasiModel = new NotifikasiModel();
        $data = array(
            'countnotif' => $NotifikasiModel->where(['id_penerima'=> $id_user, 'status' => 'Unread'])->countAllResults(),
            'countdatanotif' => $NotifikasiModel->where(['id_penerima'=> $id_user])->countAllResults(),
            'notif' => $NotifikasiModel->where(['id_penerima'=> $id_user, 'status' => 'Unread'])->orderBy('id', 'DESC')->limit(4)->get()->getResult(),
            'datanotif' => $NotifikasiModel->where('id_penerima', $id_user)->get()->getResult(),
            'page' => 'Notifikasi'
        );
        echo view('partials/header', $data);
        echo view('partials/navbar', $data);
        echo view('partials/sidebar', $data);
        echo view('vw_notifikasi', $data);
        echo view('partials/footer', $data);
    }

    function hapusall()
    {
        $NotifikasiModel = new NotifikasiModel();
        $datanotif = $NotifikasiModel->where('id_penerima',session()->get('id_user'))->get()->getResult();
        foreach($datanotif as $data){
            $NotifikasiModel->delete($data->id);
        }
        return redirect()->to(base_url('/notifikasi'));
    }

    function readall()
    {
        $NotifikasiModel = new NotifikasiModel();
        $datanotif = $NotifikasiModel->where('id_penerima',session()->get('id_user'))->get()->getResult();
        foreach($datanotif as $data){
            $NotifikasiModel->update($data->id,[
                'status' => 'Read'
            ]);
        }
        return redirect()->to(base_url('/notifikasi'));
    }
}

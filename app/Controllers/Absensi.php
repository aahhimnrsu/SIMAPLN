<?php

namespace App\Controllers;

use App\Models\AbsensiModel;
use App\Models\PesertaModel;
use App\Models\NotifikasiModel;
use App\Models\UserModel;
use App\Controllers\Absensi\Autoabsen;
use BaconQrCode\Renderer\RendererStyle\Fill;
use CodeIgniter\CLI\Console;
use CodeIgniter\Tasks\Config\Tasks as BaseTasks;
use CodeIgniter\Tasks\Scheduler;
use CodeIgniter\Database\Query;

class Absensi extends BaseController
{

    public function __construct() {
        if (session()->isLogin != true) {
            return redirect('/');
        }
    }

    //TAMPILAN MENU ABSENSI
    public function index()
    {
        $tanggal = date('Y-m-d');

        $AbsensiModel = new AbsensiModel();
        if (session()->get('role') == 'Peserta') {
            $datakehadiran = $AbsensiModel->orderBy('id', 'DESC')->where(['idpeserta' => session()->get('id'), 'tanggal' => $tanggal])->get()->getResult();
        } else {
            $datakehadiran = $AbsensiModel->where('tanggal', $tanggal)->get()->getResult();
        };

        $NotifikasiModel = new NotifikasiModel();
        $data = array(
            'countnotif' => $NotifikasiModel->where(['id_penerima'=> session()->get('id_user'), 'status' => 'Unread'])->countAllResults(),
            'notif' => $NotifikasiModel->where(['id_penerima'=> session()->get('id_user'), 'status' => 'Unread'])->orderBy('id', 'DESC')->limit(4)->get()->getResult(),
            'datakehadiran' => $datakehadiran,
            'page' => 'Absensi'
        );
        // print_r($tanggal);
        echo view('partials/header', $data);
        echo view('partials/navbar', $data);
        echo view('partials/sidebar', $data);
        echo view('absensi/vw_dataabsensi', $data);
        echo view('partials/footer', $data);
    }

    //TAMPILAN MENU ABSENSI ALL
    public function all()
    {
        $tanggal = date('Y-m-d');
        $AbsensiModel = new AbsensiModel();
        if (session()->get('role') == 'Peserta') {
            $datakehadiran = $AbsensiModel->orderBy('id', 'DESC')->where(['idpeserta' => session()->get('id')])->get()->getResult();
        } else {
            $datakehadiran = $AbsensiModel->findAll();
        };

        $NotifikasiModel = new NotifikasiModel();
        $data = array(
            'countnotif' => $NotifikasiModel->where(['id_penerima'=> session()->get('id_user'), 'status' => 'Unread'])->countAllResults(),
            'notif' => $NotifikasiModel->where(['id_penerima'=> session()->get('id_user'), 'status' => 'Unread'])->orderBy('id', 'DESC')->limit(4)->get()->getResult(),
            'datakehadiran' => $datakehadiran,
            'page' => 'Absensi All'
        );
        // print_r($tanggal);
        echo view('partials/header', $data);
        echo view('partials/navbar', $data);
        echo view('partials/sidebar', $data);
        echo view('absensi/vw_dataabsensi', $data);
        echo view('partials/footer', $data);
    }

    public function absensikehadiran($id = false)
    {
        $NotifikasiModel = new NotifikasiModel();
        $data = array(
            'countnotif' => $NotifikasiModel->where(['id_penerima'=> session()->get('id_user'), 'status' => 'Unread'])->countAllResults(),
            'notif' => $NotifikasiModel->where(['id_penerima'=> session()->get('id_user'), 'status' => 'Unread'])->orderBy('id', 'DESC')->limit(4)->get()->getResult(),
            'page' => 'Absensi Kehadiran',
            'id' => $id
        );
        echo view('partials/header', $data);
        echo view('partials/navbar', $data);
        echo view('partials/sidebar', $data);
        echo view('absensi/vw_absensikehadiran', $data);
        echo view('partials/footer', $data);
    }

    public function prosesabsensikehadiran()
    {
        $UserModel = new UserModel();
        $AbsensiModel = new AbsensiModel();
        $PesertaModel = new PesertaModel();
        $time = date('H:i:s');
        $date = date('Y-m-d');
        $img = $this->request->getPost('foto');
        $folderPath = "assets/uploads/fotokehadiran/";
        $image_parts = explode(";base64,", $img);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];

        $image_base64 = base64_decode($image_parts[1]);
        $fileName = uniqid() . '.png';

        $file = $folderPath . $fileName;
        file_put_contents($file, $image_base64);
        if ($time >= '06:00:00' && $time <= '07:30:00') {
            $status = 'Hadir';
        } elseif ($time > '07:30:00' && $time <= '16:00:00') {
            $status = 'Terlambat';
        } else {
            $status = 'Error';
        }
        $id = $this->request->getPost('id');

        $AbsensiModel->update($id,[
            'waktukehadiran' => $this->request->getPost('waktu'),
            'lokasikehadiran' => $this->request->getPost('lokasi'),
            'fotokehadiran' => $fileName,
            'statuskehadiran' => $status,
        ]);
        // $filefoto->move('assets/uploads/fotoabsensi/', $fileName);
        $NotifikasiModel = new NotifikasiModel();

        $datapeserta = $PesertaModel->where('id', session()->get('id'))->first();
        $id_pembimbing = $datapeserta->id_pembimbing;
        $NotifikasiModel->insert([
            'id_user' => session()->get('id_user'),
            'id_penerima' => session()->get('id_user'),
            'notifikasi' => 'Kamu Berhasil Melakukan Absensi Kehadiran Pada Tanggal '.$date.' '.$this->request->getPost('waktu'),
            'status' => 'Unread'
        ]);
        $NotifikasiModel->insert([
            'id_user' => session()->get('id_user'),
            'id_penerima' => $id_pembimbing,
            'notifikasi' => session()->get('nama').' Berhasil Melakukan Absensi Kehadiran Pada Tanggal '.$date.' '.$this->request->getPost('waktu'),
            'status' => 'Unread'
        ]);

        $data = array(
            'countnotif' => $NotifikasiModel->where(['id_penerima'=> session()->get('id_user'), 'status' => 'Unread'])->countAllResults(),
            'notif' => $NotifikasiModel->where(['id_penerima'=> session()->get('id_user'), 'status' => 'Unread'])->orderBy('id', 'DESC')->limit(4)->get()->getResult(),
            'nama' => $this->request->getPost('nama'),
            'action' => 'Melakukan Absensi Kehadiran',
            'tanggal' => $date,
            'waktu' => $this->request->getPost('waktu'),
            'page' => 'Absensi'
        );
        echo view('partials/header', $data);
        echo view('partials/navbar', $data);
        echo view('partials/sidebar', $data);
        echo view('absensi/vw_suksesabsen', $data);
        echo view('partials/footer', $data);
    }

    public function absensikepulangan($id = false)
    {
        $NotifikasiModel = new NotifikasiModel();
        $data = array(
            'countnotif' => $NotifikasiModel->where(['id_penerima'=> session()->get('id_user'), 'status' => 'Unread'])->countAllResults(),
            'notif' => $NotifikasiModel->where(['id_penerima'=> session()->get('id_user'), 'status' => 'Unread'])->orderBy('id', 'DESC')->limit(4)->get()->getResult(),
            'page' => 'Absensi Kehadiran',
            'id' => $id
        );
        echo view('partials/header', $data);
        echo view('partials/navbar', $data);
        echo view('partials/sidebar', $data);
        echo view('absensi/vw_absensikepulangan', $data);
        echo view('partials/footer', $data);
    }

    public function prosesabsensikepulangan()
    {
        $AbsensiModel = new AbsensiModel();
        $UserModel = new UserModel();
        $PesertaModel = new PesertaModel();
        $time = date('H:i:s');
        $date = date('Y-m-d');
        $img = $this->request->getPost('foto');
        $folderPath = "assets/uploads/fotokepulangan/";
        $image_parts = explode(";base64,", $img);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];

        $image_base64 = base64_decode($image_parts[1]);
        $fileName = uniqid() . '.png';

        $file = $folderPath . $fileName;
        file_put_contents($file, $image_base64);
        $id = $this->request->getPost('id');

        $AbsensiModel->update($id, [
            'waktukepulangan' => $this->request->getPost('waktu'),
            'lokasikepulangan' => $this->request->getPost('lokasi'),
            'fotokepulangan' => $fileName,
        ]);
        // $filefoto->move('assets/uploads/fotoabsensi/', $fileName);
        $NotifikasiModel = new NotifikasiModel();
        $datapeserta = $PesertaModel->where('id', session()->get('id'))->first();
        $id_pembimbing = $datapeserta->id_pembimbing;
        $NotifikasiModel->insert([
            'id_user' => session()->get('id_user'),
            'id_penerima' => session()->get('id_user'),
            'notifikasi' => 'Kamu Berhasil Melakukan Absensi Kepulangan Pada Tanggal '.$date.' '.$this->request->getPost('waktu'),
            'status' => 'Unread'
        ]);
        $NotifikasiModel->insert([
            'id_user' => session()->get('id_user'),
            'id_penerima' => $id_pembimbing,
            'notifikasi' => session()->get('nama').' Berhasil Melakukan Absensi Kepulangan Pada Tanggal '.$date.' '.$this->request->getPost('waktu'),
            'status' => 'Unread'
        ]);
        $data = array(
            'countnotif' => $NotifikasiModel->where(['id_penerima'=> session()->get('id_user'), 'status' => 'Unread'])->countAllResults(),
            'notif' => $NotifikasiModel->where(['id_penerima'=> session()->get('id_user'), 'status' => 'Unread'])->orderBy('id', 'DESC')->limit(4)->get()->getResult(),
            'nama' => $this->request->getPost('nama'),
            'action' => 'Melakukan Absensi Kepulangan',
            'tanggal' => $date,
            'waktu' => $this->request->getPost('waktu'),
            'page' => 'Absensi'
        );
        echo view('partials/header', $data);
        echo view('partials/navbar', $data);
        echo view('partials/sidebar', $data);
        echo view('absensi/vw_suksesabsen', $data);
        echo view('partials/footer', $data);
    }

    public function eviden($id = false)
    {
        $NotifikasiModel = new NotifikasiModel();
        $data = array(
            'countnotif' => $NotifikasiModel->where(['id_penerima'=> session()->get('id_user'), 'status' => 'Unread'])->countAllResults(),
            'notif' => $NotifikasiModel->where(['id_penerima'=> session()->get('id_user'), 'status' => 'Unread'])->orderBy('id', 'DESC')->limit(4)->get()->getResult(),
            'page' => 'Absensi Kehadiran',
            'id' => $id
        );
        echo view('partials/header', $data);
        echo view('partials/navbar', $data);
        echo view('partials/sidebar', $data);
        echo view('absensi/vw_eviden', $data);
        echo view('partials/footer', $data);
    }

    public function proseseviden()
    {
        $AbsensiModel = new AbsensiModel();
        $time = date('H:i:s');
        $date = date('Y-m-d');

        $img = $this->request->getFile('foto');

        if (!$this->validate([
            'foto' => [
                'rules' => 'uploaded[foto]|mime_in[foto,image/jpg,image/png,image/jpeg]|max_size[foto,2048]',
                'errors' => [
                    'uploaded' => 'Harus Ada File yang diupload',
                    'mime_in' => 'File Extention Harus Berupa jpg/png/jpeg',
                    'max_size' => 'Ukuran File Maksimal 6 MB'
                ]
            ]
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }
        $fileName = $img->getName();

        $id = $this->request->getPost('id');

        $AbsensiModel->update($id, [
            'fotoeviden' => $fileName,
            'keteranganeviden' => $this->request->getPost('keterangan'),
        ]);
        $img->move('assets/uploads/fotoeviden/', $fileName);
        $NotifikasiModel = new NotifikasiModel();
        
        $NotifikasiModel->insert([
            'id_user' => session()->get('id_user'),
            'id_penerima' => session()->get('id_user'),
            'notifikasi' => 'Kamu Berhasil Mengumpulkan Eviden Pada Tanggal '.$date,
            'status' => 'Unread'
        ]);
        $data = array(
            'countnotif' => $NotifikasiModel->where(['id_penerima'=> session()->get('id_user'), 'status' => 'Unread'])->countAllResults(),
            'notif' => $NotifikasiModel->where(['id_penerima'=> session()->get('id_user'), 'status' => 'Unread'])->orderBy('id', 'DESC')->limit(4)->get()->getResult(),
            'nama' => $this->request->getPost('nama'),
            'action' => 'Melakukan Pengumpulan Eviden',
            'tanggal' => $date,
            'waktu' => $this->request->getPost('waktu'),
            'page' => 'Absensi'
        );
        echo view('partials/header', $data);
        echo view('partials/navbar', $data);
        echo view('partials/sidebar', $data);
        echo view('absensi/vw_suksesabsen', $data);
        echo view('partials/footer', $data);
    }

    public function izin($id = false)
    {
        $NotifikasiModel = new NotifikasiModel();
        $data = array(
            'countnotif' => $NotifikasiModel->where(['id_penerima'=> session()->get('id_user'), 'status' => 'Unread'])->countAllResults(),
            'notif' => $NotifikasiModel->where(['id_penerima'=> session()->get('id_user'), 'status' => 'Unread'])->orderBy('id', 'DESC')->limit(4)->get()->getResult(),
            'page' => 'Pengajuan Izin',
            'id' => $id
        );
        echo view('partials/header', $data);
        echo view('partials/navbar', $data);
        echo view('partials/sidebar', $data);
        echo view('absensi/vw_pengajuanizin', $data);
        echo view('partials/footer', $data);
    }

    public function prosesizin()
    {
        $AbsensiModel = new AbsensiModel();
        $UserModel = new UserModel();
        $PesertaModel = new PesertaModel();
        $date = date('Y-m-d');
        $time = date('H:i:s');
        $id = $this->request->getPost('id');
        $AbsensiModel->update($id,[
            'waktukehadiran' => '-',
            'lokasikehadiran' => '-',
            'fotokehadiran' => '-',
            'waktukepulangan' => '-',
            'lokasikepulangan' => '-',
            'fotokepulangan' => '-',
            'fotoeviden' => '-',
            'keteranganeviden' => '-',
            'keteranganizin' => $this->request->getPost('keterangan'),
            'statuskehadiran' => 'Menunggu Validasi',
        ]);
        // $filefoto->move('assets/uploads/fotoabsensi/', $fileName);
        $NotifikasiModel = new NotifikasiModel();
        
        $datapeserta = $PesertaModel->where('id', session()->get('id'))->first();
        $datauser = $UserModel->where('role','Admin')->get()->getResult();
        $id_pembimbing = $datapeserta->id_pembimbing;
        $NotifikasiModel->insert([
            'id_user' => session()->get('id_user'),
            'id_penerima' => session()->get('id_user'),
            'notifikasi' => 'Kamu Berhasil Mengajukan Izin Pada Tanggal '.$date.' '.$this->request->getPost('waktu').' Silahkan Menunggu Validasi Admin',
            'status' => 'Unread'
        ]);
        $NotifikasiModel->insert([
            'id_user' => session()->get('id_user'),
            'id_penerima' => $id_pembimbing,
            'notifikasi' => session()->get('nama').' Mengajukan Izin Pada Tanggal '.$date.' '.$this->request->getPost('waktu'),
            'status' => 'Unread'
        ]);
        foreach($datauser as $datauser){
            $NotifikasiModel->insert([
                'id_user' => session()->get('id_user'),
                'id_penerima' => $datauser->id,
                'notifikasi' => session()->get('nama').' Mengajukan Izin Pada Tanggal '.$date.' '.$this->request->getPost('waktu'),
                'status' => 'Unread'
            ]);
        }
        $data = array(
            'countnotif' => $NotifikasiModel->where(['id_penerima'=> session()->get('id_user'), 'status' => 'Unread'])->countAllResults(),
            'notif' => $NotifikasiModel->where(['id_penerima'=> session()->get('id_user'), 'status' => 'Unread'])->orderBy('id', 'DESC')->limit(4)->get()->getResult(),
            'nama' => $this->request->getPost('nama'),
            'action' => 'Melakukan Pengajuan Izin',
            'tanggal' => $date,
            'waktu' => $time,
            'page' => 'Absensi'
        );
        echo view('partials/header', $data);
        echo view('partials/navbar', $data);
        echo view('partials/sidebar', $data);
        echo view('absensi/vw_suksesabsen', $data);
        echo view('partials/footer', $data);
    }

    public function sakit($id = false)
    {
        $NotifikasiModel = new NotifikasiModel();
        $data = array(
            'countnotif' => $NotifikasiModel->where(['id_penerima'=> session()->get('id_user'), 'status' => 'Unread'])->countAllResults(),
            'notif' => $NotifikasiModel->where(['id_penerima'=> session()->get('id_user'), 'status' => 'Unread'])->orderBy('id', 'DESC')->limit(4)->get()->getResult(),
            'page' => 'Pengajuan sakit',
            'id' => $id
        );
        echo view('partials/header', $data);
        echo view('partials/navbar', $data);
        echo view('partials/sidebar', $data);
        echo view('absensi/vw_pengajuansakit', $data);
        echo view('partials/footer', $data);
    }

    public function prosessakit()
    {
        $AbsensiModel = new AbsensiModel();
        $UserModel = new UserModel();
        $PesertaModel = new PesertaModel();

        $file = $this->request->getFile('foto');
        if (!$this->validate([
            'foto' => [
                'rules' => 'uploaded[foto]|mime_in[foto,application/pdf]|max_size[foto,2048]',
                'errors' => [
                    'uploaded' => 'Harus Ada File yang diupload',
                    'mime_in' => 'File Extention Harus Berupa jpg/png/jpeg',
                    'max_size' => 'Ukuran File Maksimal 6 MB'
                ]
            ]
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }
        $fileName = $file->getName();

        $id = $this->request->getPost('id');
        $date = date('Y-m-d');
        $time = date('H:i:s');
        $AbsensiModel->update($id,[
            'waktukehadiran' => '-',
            'lokasikehadiran' => '-',
            'fotokehadiran' => '-',
            'waktukepulangan' => '-',
            'lokasikepulangan' => '-',
            'fotokepulangan' => '-',
            'fotoeviden' => '-',
            'keteranganeviden' => '-',
            'suratsakit' => $fileName,
            'statuskehadiran' => 'Menunggu Validasi',
        ]);
        $file->move('assets/uploads/suratizin/', $fileName);
        $NotifikasiModel = new NotifikasiModel();
        $datapeserta = $PesertaModel->where('id', session()->get('id'))->first();
        $datauser = $UserModel->where('role','Admin')->get()->getResult();
        $id_pembimbing = $datapeserta->id_pembimbing;
        $NotifikasiModel->insert([
            'id_user' => session()->get('id_user'),
            'id_penerima' => session()->get('id_user'),
            'notifikasi' => 'Kamu Berhasil Mengajukan Surat Sakit Pada Tanggal '.$date.' '.$this->request->getPost('waktu').' Silahkan Menunggu Validasi Admin',
            'status' => 'Unread'
        ]);
        $NotifikasiModel->insert([
            'id_user' => session()->get('id_user'),
            'id_penerima' => $id_pembimbing,
            'notifikasi' => session()->get('nama').' Mengajukan Surat Sakit Pada Tanggal '.$date.' '.$this->request->getPost('waktu'),
            'status' => 'Unread'
        ]);
        foreach($datauser as $datauser){
            $NotifikasiModel->insert([
                'id_user' => session()->get('id_user'),
                'id_penerima' => $datauser->id,
                'notifikasi' => session()->get('nama').' Mengajukan Surat Sakit Pada Tanggal '.$date.' '.$this->request->getPost('waktu'),
                'status' => 'Unread'
            ]);
        }
        $data = array(
            'countnotif' => $NotifikasiModel->where(['id_penerima'=> session()->get('id_user'), 'status' => 'Unread'])->countAllResults(),
            'notif' => $NotifikasiModel->where(['id_penerima'=> session()->get('id_user'), 'status' => 'Unread'])->orderBy('id', 'DESC')->limit(4)->get()->getResult(),
            'nama' => $this->request->getPost('nama'),
            'action' => 'Melakukan Pengajuan sakit',
            'tanggal' => $date,
            'waktu' => $time,
            'page' => 'Absensi'
        );
        echo view('partials/header', $data);
        echo view('partials/navbar', $data);
        echo view('partials/sidebar', $data);
        echo view('absensi/vw_suksesabsen', $data);
        echo view('partials/footer', $data);
    }

    public function validasiizin($id = false)
    {
        $AbsensiModel = new AbsensiModel();
        $PesertaModel = new PesertaModel();
        $id_peserta = $AbsensiModel->where('id', $id)->first();
        $iduser = $PesertaModel->where('id', $id_peserta->idpeserta)->first();
        $AbsensiModel->update($id, [
            'statuskehadiran' => 'Izin',
        ]);
        $date = date('Y-m-d');
        $NotifikasiModel = new NotifikasiModel();
        $NotifikasiModel->insert([
            'id_user' => session()->get('id_user'),
            'id_penerima' => $iduser->id_user,
            'notifikasi' => 'Pengajuan Izin Kamu telah Di Validasi Oleh Admin Pada Tanggal '.$date,
            'status' => 'Unread'
        ]);
        return redirect()->to(base_url('/absensi'));
    }

    public function validasisakit($id = false)
    {
        $AbsensiModel = new AbsensiModel();
        $PesertaModel = new PesertaModel();
        $datapeserta = $AbsensiModel->where('id', $id)->first();
        $datauser = $PesertaModel->where('id', $datapeserta->idpeserta)->first();
        $AbsensiModel->update($id, [
            'statuskehadiran' => 'sakit',
        ]);
        $date = date('Y-m-d');
        $NotifikasiModel = new NotifikasiModel();
        $NotifikasiModel->insert([
            'id_user' => session()->get('id_user'),
            'id_penerima' => $datauser->id_user,
            'notifikasi' => 'Pengajuan Surat Sakit Kamu telah Di Validasi Oleh Admin Pada Tanggal '.$date,
            'status' => 'Unread'
        ]);
        return redirect()->to(base_url('/absensi'));
    }

    //TAMPILAN DETAIL EVIDEN
    public function detail($id = false)
    {
        $AbsensiModel = new AbsensiModel();
        $PesertaModel = new PesertaModel();
        $NotifikasiModel = new NotifikasiModel();
        $data = array(
            'countnotif' => $NotifikasiModel->where(['id_penerima'=> session()->get('id_user'), 'status' => 'Unread'])->countAllResults(),
            'notif' => $NotifikasiModel->where(['id_penerima'=> session()->get('id_user'), 'status' => 'Unread'])->orderBy('id', 'DESC')->limit(4)->get()->getResult(),
            'dataabsensi' => $AbsensiModel->where('id', $id)->get()->getResult(),
            'datapeserta' => $PesertaModel->where('id',)->get()->getResult(),
            'page' => 'Detail Kehadiran'
        );
        echo view('partials/header', $data);
        echo view('partials/navbar', $data);
        echo view('partials/sidebar', $data);
        echo view('absensi/vw_detailabsensi', $data);
        echo view('partials/footer', $data);
    }


    //HAPUS EVIDEN
    function hapus($id = false)
    {
        $AbsensiModel = new AbsensiModel();
        $data = $AbsensiModel->find($id);
        $fotokehadiran = $data->fotokehadiran;
        $fotokepulangan = $data->fotokepulangan;
        $fotoeviden = $data->fotoeviden;
        if (file_exists("assets/uploads/fotoabsensi/" . $fotokehadiran)) {
            unlink("assets/uploads/fotoabsensi/" . $fotokehadiran);
        }
        if (file_exists("assets/uploads/fotoabsensi/" . $fotokepulangan)) {
            unlink("assets/uploads/fotoabsensi/" . $fotokepulangan);
        }
        if (file_exists("assets/uploads/fotoabsensi/" . $fotoeviden)) {
            unlink("assets/uploads/fotoabsensi/" . $fotoeviden);
        }
        $AbsensiModel->delete($id);
        return redirect()->to(base_url('/absensi'));
    }
}

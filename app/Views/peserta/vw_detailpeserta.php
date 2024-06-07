<!-- Main Content -->

<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4><a href="<?= base_url('peserta') ?>" class="text-decoration-none text-dark"><i class="fas fa-chevron-left"></i></a> <?= $page ?></h4>
                    </div>
                    <div class="card-body">
                        <?php foreach ($dataakun as $akun) { ?>
                            <div class="text-center mb-3">
                                <img src="<?= base_url($akun->qrcode) ?>" width="20%"><br>
                                <?php if ($akun->qrcode == '/assets/img/qrcodex.png') { ?>
                                    <a href="<?= base_url('manajemenakun/qrcode/' . $akun->id) ?>" class="btn btn-info mt-3">Generate QRCode</a>
                                <?php } else { ?>
                                    <a href="<?= base_url('manajemenakun/download/' . $akun->id) ?>" class="btn btn-info mt-3">Download QRCode</a>
                                <?php } ?>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input type="text" name="username" class="form-control form-control-sm" required readonly value="<?= $akun->username ?>">
                                    </div>
                                <?php } ?>
                                <?php foreach ($datapeserta as $data) { ?>
                                    <div class="form-group">
                                        <label>Nama Lengkap</label>
                                        <input type="text" name="nama" class="form-control form-control-sm" required readonly value="<?= $data->nama ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Instansi</label>
                                        <input type="text" name="instansi" class="form-control form-control-sm" required readonly value="<?= $data->instansi ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tim</label>
                                        <input type="text" name="tim" class="form-control form-control-sm" required readonly value="<?= $data->tim ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Tanggal Masuk</label>
                                        <input type="date" name="tglmasuk" class="form-control form-control-sm" required readonly value="<?= $data->tglmasuk ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Tanggal Keluar</label>
                                        <input type="date" name="tglkeluar" class="form-control form-control-sm" required readonly value="<?= $data->tglkeluar ?>">
                                    </div>
                                    <div class="d-flex justify-content-between">

                                    </div>
                                <?php } ?>
                                </div>
                            </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4>Data Absensi Peserta</h4>
                    </div>
                    <div class="card-body">
                    <div class="table-responsive">
                            <table class="table table-striped" id="table-1">
                                <thead>
                                    <tr>
                                        <th class="text-center">Tanggal</th>
                                        <th class="text-center">Nama Lengkap</th>
                                        <th class="text-center">Instansi</th>
                                        <th class="text-center">Waktu Kehadiran</th>
                                        <th class="text-center">Waktu Kepulangan</th>
                                        <th class="text-center">Eviden</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($datakehadiran as $data) { ?>
                                        <tr>
                                            <td class="text-center"><?= $data->tanggal ?></td>
                                            <td class="text-center"><?= $data->nama ?></td>
                                            <td class="text-center"><?= $data->instansi ?></td>
                                            <td class="text-center"><?= $data->waktukehadiran ?></td>
                                            <td class="text-center"><?= $data->waktukepulangan ?></td>
                                            <td class="text-center"><?= $data->keteranganeviden ?></td>
                                            <td class="text-center"><?php if ($data->statuskehadiran == 'Hadir') { ?>
                                                    <span class="badge badge-success">Hadir</span>
                                                <?php } else if ($data->statuskehadiran == 'Izin') { ?>
                                                    <span class="badge badge-warning">Izin</span>
                                                <?php } else if ($data->statuskehadiran == 'Sakit') { ?>
                                                    <span class="badge badge-primary">Sakit</span>
                                                <?php } else if ($data->statuskehadiran == 'Terlambat') { ?>
                                                    <span class="badge badge-danger">Terlambat</span>
                                                <?php } else if ($data->statuskehadiran == 'Menunggu Validasi') { ?>
                                                    <span class="badge badge-info">Menunggu Validasi</span>
                                                <?php } else if ($data->statuskehadiran == 'Belum Absen') { ?>
                                                    <span class="badge badge-warning">Belum Absen</span>
                                                <?php } else if ($data->statuskehadiran == 'Alfa') { ?>
                                                    <span class="badge badge-danger">Alfa</span>
                                                <?php } ?>
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group" role="group" aria-label="Small button group">
                                                    <?php if (empty($data->waktukehadiran) && session()->get('role') == 'Peserta' && $time >= '06:00:00' && $time < '16:00:00') { ?>
                                                        <a href="<?= base_url('absensi/absensikehadiran/'.$data->id) ?>" class="btn btn-success btn-sm"><i class="fas fa-sign-in-alt"></i></a>
                                                        <a href="<?= base_url('absensi/izin/'.$data->id) ?>" class="btn btn-warning btn-sm"><i class="fas fa-file-signature"></i></a>
                                                        <a href="<?= base_url('absensi/sakit/'.$data->id) ?>" class="btn btn-danger btn-sm"><i class="fas fa-clinic-medical"></i></a>
                                                    <?php } ?>
                                                    <?php if (empty($data->waktukepulangan) && !empty($data->waktukehadiran) && session()->get('role') == 'Peserta' && $time >= '16:00:00' && $time <= '23:59:59') { ?>
                                                        <a href="<?= base_url('absensi/absensikepulangan/' . $data->id) ?>" class="btn btn-success btn-sm"><i class="fas fa-sign-out-alt"></i></a>
                                                    <?php } ?>
                                                    <?php if (!empty($data->waktukepulangan) && empty($data->keteranganeviden) && session()->get('role') == 'Peserta' && $time >= '16:00:00' && $time <= '23:59:59') { ?>
                                                        <a href="<?= base_url('absensi/eviden/' . $data->id) ?>" class="btn btn-success btn-sm"><i class="fas fa-file-signature"></i></a>
                                                    <?php } ?>
                                                    <?php if (!empty($data->keteranganizin) && $data->statuskehadiran == 'Menunggu Validasi' && session()->get('role') == 'Admin') { ?>
                                                        <a href="<?= base_url('absensi/validasiizin/' . $data->id) ?>" class="btn btn-success btn-sm"><i class="fas fa-check"></i></a>
                                                    <?php } ?>
                                                    <?php if (!empty($data->suratsakit) && $data->statuskehadiran == 'Menunggu Validasi' && session()->get('role') == 'Admin') { ?>
                                                        <a href="<?= base_url('absensi/validasisakit/' . $data->id) ?>" class="btn btn-success btn-sm"><i class="fas fa-check"></i></a>
                                                    <?php } ?>
                                                </div>
                                                <div class="btn-group" role="group" aria-label="Small button group">
                                                    <a href="<?= base_url('absensi/detail/' . $data->id) ?>" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                                    <a href="<?= base_url('absensi/hapus/' . $data->id) ?>" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
</div>
</section>
</div>
</script>
<script src="<?= base_url('assets/bundles/datatables/datatables.min.js') ?>"></script>
<script src="<?= base_url('assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') ?>"></script>
<script>
    $("#table-1").dataTable({
        "columnDefs": [{
            "sortable": false,
            "targets": [2, 3]
        }],
        dom: 'Bfrtip',
        buttons: [
            'excel', 'pdf', 'print'
        ]
    });
    $('#save-stage').DataTable({
        "scrollX": true,
        stateSave: true
    });
    $("#table-2").dataTable({
        "columnDefs": [{
            "sortable": false,
            "targets": [2, 3]
        }],
        dom: 'Bfrtip',
        buttons: [
            'excel', 'pdf', 'print'
        ]
    });
    $('#save-stage').DataTable({
        "scrollX": true,
        stateSave: true
    });
    $("#table-3").dataTable({
        "columnDefs": [{
            "sortable": false,
            "targets": [2, 3]
        }],
        dom: 'Bfrtip',
        buttons: [
            'excel', 'pdf', 'print'
        ]
    });
    $('#save-stage').DataTable({
        "scrollX": true,
        stateSave: true
    });
</script>
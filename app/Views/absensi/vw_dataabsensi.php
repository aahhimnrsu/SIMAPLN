<?php $time = date('H:i:s'); ?>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Data Absensi Peserta</h4>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3">
                            <div class="data">
                                <?php if ($page == 'Absensi') { ?>
                                    <a href="<?= base_url('absensi/all') ?>" class="btn btn-info btn-sm ml-1"><i class="fas fa-file-alt"></i> Tampilkan Semua Data</a>
                                <?php } else { ?>
                                    <a href="<?= base_url('absensi') ?>" class="btn btn-info btn-sm ml-1"><i class="fas fa-file-alt"></i> Tampilkan Data Hari Ini</a>
                                <?php } ?>
                            </div>
                            <?php if (empty($datakehadiran)) { ?>
                                <?php if ($time > '16:00:00' && $time < '06:00:00') { ?>
                                    <div class="opsi">
                                        <a href="<?= base_url('absensi/absensikehadiran') ?>" class="btn btn-success btn-sm mx-1"><i class="fas fa-sign-in-alt"></i> Absen Kehadiran</a>
                                        <a href="<?= base_url('absensi/izin') ?>" class="btn btn-warning btn-sm mx-1"><i class="fas fa-file-signature"></i> Pengajuan Izin</a>
                                        <a href="<?= base_url('absensi/sakit') ?>" class="btn btn-danger btn-sm mx-1"><i class="fas fa-clinic-medical"></i> Pengajuan sakit</a>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                        </div>
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
                                                    <a href="<?= base_url('absensi/detail/' . $data->id) ?>" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
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
</section>
</div>

<!-- JS Libraies -->

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
</script>
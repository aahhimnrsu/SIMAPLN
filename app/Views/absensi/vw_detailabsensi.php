<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <?php foreach ($dataabsensi as $data) { ?>
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="<?= base_url('absensi') ?>" class="text-dark"> <i class="fas fa-chevron-left"></i></a>
                            <h4> Detail Absensi Peserta</h4>
                        </div>
                        <div class="card-body">
                            <div class="text-center mb-2">
                                <?php if ($data->statuskehadiran == 'Hadir') { ?>
                                    <h1 style="font-size: 14px;">Status Kehadiran : </h1>
                                    <h1 style="font-size: 14px;" class="text-white btn btn-success">Hadir</h1>
                                <?php } else if ($data->statuskehadiran == 'Izin') { ?>
                                    <h1 style="font-size: 14px;">Status Kehadiran : </h1>
                                    <h1 style="font-size: 14px;" class="text-white btn btn-warning">Izin</h1>
                                <?php } else if ($data->statuskehadiran == 'Sakit') { ?>
                                    <h1 style="font-size: 14px;">Status Kehadiran : </h1>
                                    <h1 style="font-size: 14px;" class="text-white btn btn-primary">Sakit</h1>
                                <?php } else if ($data->statuskehadiran == 'Terlambat') { ?>
                                    <h1 style="font-size: 14px;">Status Kehadiran : </h1>
                                    <h1 style="font-size: 14px;" class="text-white btn btn-danger">Terlambat</h1>
                                <?php } else if ($data->statuskehadiran == 'Menunggu Validasi') { ?>
                                    <h1 style="font-size: 14px;">Status Kehadiran : </h1>
                                    <h1 style="font-size: 14px;" class="text-white btn btn-info">Menunggu Validasi</h1>
                                <?php } else if ($data->statuskehadiran == 'Belum Absen') { ?>
                                    <h1 style="font-size: 14px;">Status Kehadiran : </h1>
                                    <h1 style="font-size: 14px;" class="text-white btn btn-warning">Belum Absen</h1>
                                <?php } else if ($data->statuskehadiran == 'Alfa') { ?>
                                    <h1 style="font-size: 14px;">Status Kehadiran : </h1>
                                    <h1 style="font-size: 14px;" class="text-white btn btn-danger">Alfa</h1>
                                <?php } ?>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nama</label>
                                        <input type="text" name="waktu" class="form-control form-control-sm" required readonly value="<?= $data->nama ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Instansi</label>
                                        <input type="text" name="waktu" class="form-control form-control-sm" required readonly value="<?= $data->instansi ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tim</label>
                                        <input type="text" name="waktu" class="form-control form-control-sm" required readonly value="<?= $data->tim ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tanggal</label>
                                        <input type="text" name="waktu" class="form-control form-control-sm" required readonly value="<?= $data->tanggal ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Keterangan Izin</label><br>
                                        <p class="text-info font-weight-bold"><?php if ($data->keteranganizin == '') {
                                                                                    echo '-';
                                                                                } else {
                                                                                    echo $data->keteranganizin;
                                                                                } ?></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group text-info font-weight-bold">
                                        <label>Surat Sakit</label><br>
                                        <a <?php if ($data->suratsakit != '') { ?> href="<?= base_url('/assets/uploads/suratsakit/') . $data->suratsakit ?>" download <?php } ?> class="text-info font-weight-bold">
                                            <i class="fas fa-file"></i>
                                            <?php if ($data->suratsakit == '') {
                                                echo ' -';
                                            } else {
                                                echo ' '.$data->suratsakit;
                                            } ?>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php if($data->suratsakit == NULL && $data->keteranganizin == NULL){ ?>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Waktu Absensi Kehadiran <span class="badge badge-info"><?= $data->waktukehadiran ?></span></h4>
                        </div>
                        <div class="card-body text-center">
                            <img src="<?= base_url('/assets/uploads/fotokehadiran/') . $data->fotokehadiran ?>" class="mb-2" width="70%">
                            <div style="width: 100%"><iframe width="100%" height="600" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=en&amp;q=<?= $data->lokasikehadiran ?>+(My%20Business%20Name)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"><a href="https://www.maps.ie/population/">Find Population on Map</a></iframe></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Waktu Absensi Kepulangan <span class="badge badge-info"><?= $data->waktukepulangan ?></span></h4>
                        </div>
                        <div class="card-body text-center">
                            <img src="<?= base_url('/assets/uploads/fotokepulangan/') . $data->fotokepulangan ?>" class="mb-2" width="70%">
                            <div style="width: 100%"><iframe width="100%" height="600" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=en&amp;q=<?= $data->lokasikepulangan ?>+(My%20Business%20Name)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"><a href="https://www.maps.ie/population/">Find Population on Map</a></iframe></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="text-center">Eviden</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 text-center">
                                    <img src="<?= base_url('/assets/uploads/fotoeviden/') . $data->fotoeviden ?>" class="mb-2" width="70%">
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1" class="form-label">Keterangan Eviden</label><br>
                                        <h7><?php if ($data->keteranganeviden == '') { echo '-';} else { echo $data->keteranganeviden; } ?></h7>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        <?php } ?>
    </section>
</div>

<!-- JS Libraies -->

<script src="<?= base_url('assets/bundles/datatables/datatables.min.js') ?>"></script>
<script src="<?= base_url('assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') ?>"></script>
<script>
    "use strict";

    $("[data-checkboxes]").each(function() {
        var me = $(this),
            group = me.data('checkboxes'),
            role = me.data('checkbox-role');

        me.change(function() {
            var all = $('[data-checkboxes="' + group + '"]:not([data-checkbox-role="dad"])'),
                checked = $('[data-checkboxes="' + group + '"]:not([data-checkbox-role="dad"]):checked'),
                dad = $('[data-checkboxes="' + group + '"][data-checkbox-role="dad"]'),
                total = all.length,
                checked_length = checked.length;

            if (role == 'dad') {
                if (me.is(':checked')) {
                    all.prop('checked', true);
                } else {
                    all.prop('checked', false);
                }
            } else {
                if (checked_length >= total) {
                    dad.prop('checked', true);
                } else {
                    dad.prop('checked', false);
                }
            }
        });
    });

    $("#table-1").dataTable({
        "columnDefs": [{
            "sortable": false,
            "targets": [2, 3]
        }]
    });
    $('#save-stage').DataTable({
        "scrollX": true,
        stateSave: true
    });
    $('#tableExport').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
</script>
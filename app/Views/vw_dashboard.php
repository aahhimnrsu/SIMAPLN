<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <h2 class="text-center" style="text-transform: uppercase;">ABSENSI PESERTA MAGANG <br> PT. PLN (Persero) ULP AMPERA</h2>
    <h5 class="mt-3 mb-3">Hai, <span class="text-info"><?= session()->nama ?></span> </h5>
    <?php if (session()->get('role') == 'Peserta') { ?>
      <div class="row ">
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
          <div class="card">
            <div class="card-statistic-4">
              <div class="align-items-center justify-content-between">
                <div class="row ">
                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                    <div class="card-content">
                      <h5 class="font-15">Hadir</h5>
                      <h2 class="mb-3 font-36"><?= $counthadir + $countterlambat ?></h2>
                      <p class="mb-0"><span class="col-green">Jumlah Hadir</span></p>
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                    <div class="banner-img">
                      <img src="<?= base_url('assets/img/banner/1.png') ?>" alt="">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
          <div class="card">
            <div class="card-statistic-4">
              <div class="align-items-center justify-content-between">
                <div class="row ">
                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                    <div class="card-content">
                      <h5 class="font-15">Alfa</h5>
                      <h2 class="mb-3 font-36"><?= $countalfa ?></h2>
                      <p class="mb-0"><span class="col-red">Jumlah Alfa</span></p>
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                    <div class="banner-img">
                      <img src="<?= base_url('assets/img/banner/4.png') ?>" alt="">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
          <div class="card">
            <div class="card-statistic-4">
              <div class="align-items-center justify-content-between">
                <div class="row ">
                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                    <div class="card-content">
                      <h5 class="font-15">Izin</h5>
                      <h2 class="mb-3 font-36"><?= $countizin ?></h2>
                      <p class="mb-0"><span class="col-blue">Jumlah Izin</span></p>
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                    <div class="banner-img">
                      <img src="<?= base_url('assets/img/banner/2.png') ?>" alt="">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
          <div class="card">
            <div class="card-statistic-4">
              <div class="align-items-center justify-content-between">
                <div class="row ">
                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                    <div class="card-content">
                      <h5 class="font-15">Sakit</h5>
                      <h2 class="mb-3 font-36"><?= $countsakit ?></h2>
                      <p class="mb-0"><span class="col-orange">Jumlah Sakit</span></p>
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                    <div class="banner-img">
                      <img src="<?= base_url('assets/img/banner/3.png') ?>" alt="">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
          <div class="card">
            <div class="card-header">
              <h4>Data Kehadiran Peserta Magang</h4>
              <div class="card-header-action">
                <a href="<?= base_url('kehadiran') ?>" class="btn btn-info btn-sm"><i class="fas fa-eye"></i> Detail</a>
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped" id="table-1">
                  <thead>
                    <tr>
                      <th class="text-center">Tanggal</th>
                      <th class="text-center">Waktu Kehadiran</th>
                      <th class="text-center">Waktu Kepulangan</th>
                      <th class="text-center">Eviden</th>
                      <th class="text-center">Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($datakehadiran as $data) { ?>
                      <tr>
                        <td class="text-center"><?= $data->tanggal ?></td>
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
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php } else { ?>
      <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
          <div class="card">
            <div class="card-header">
              <h4>Data Peserta Magang</h4>
              <div class="card-header-action">
                <a href="<?= base_url('peserta') ?>" class="btn btn-info btn-sm"><i class="fas fa-eye"></i> Detail</a>
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <div class="table-responsive">
                  <table class="table table-striped" id="table-1">
                    <thead>
                      <tr>
                        <th class="text-center">No.</th>
                        <th class="text-center">Nama</th>
                        <th class="text-center">Instansi</th>
                        <th class="text-center">Tim</th>
                        <th class="text-center">Tanggal Masuk</th>
                        <th class="text-center">Tanggal Keluar</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $no = 1;
                      foreach ($datapeserta as $peserta) {
                      ?>
                        <tr>
                          <td class="text-center"><?= $no ?></td>
                          <td class="text-center"><?= $peserta->nama ?></td>
                          <td class="text-center"><?= $peserta->instansi ?></td>
                          <td class="text-center"><?= $peserta->tim ?></td>
                          <td class="text-center"><?= $peserta->tglmasuk ?></td>
                          <td class="text-center"><?= $peserta->tglkeluar ?></td>
                        </tr>
                      <?php
                        $no++;
                      };
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php } ?>
  </section>


</div>
<!-- JS Libraies -->
<script src="<?= base_url('assets/bundles/chartjs/chart.min.js') ?>"></script>
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
</script>
<!-- Page Specific JS File -->
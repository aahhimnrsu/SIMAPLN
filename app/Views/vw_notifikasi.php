<?php $time = date('H:i:s'); ?>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header justify-content-between">
                        <h4>Pemberitahuan</h4>
                        <div class="btn-group">
                            <a href="<?= base_url('readall') ?>" class="btn btn-info btn-sm mx-2">Tandai Semua Telah Di Baca</a>
                            <a href="<?= base_url('hapusall') ?>" class="btn btn-danger btn-sm">Hapus Semua Pemberitahuan</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <?php if($countdatanotif > 0){?>
                            <?php foreach($datanotif as $data){ ?>
                                <div class="p-3 border <?php if($data->status == 'Unread'){ echo 'border-info'; }?> rounded shadow mb-2">
                                    <div class="row">
                                        <div class="col-md-1">
                                            <img alt="image" src="<?= base_url('assets/img/user.webp') ?>" class="user-img-radious-style shadow-none" width="100%">
                                        </div>
                                        <div class="col-md-9">
                                            <h5><?= $data->notifikasi ?></h5>
                                            <span><?= $data->timestamp ?></span>
                                        </div>
                                        <?php if($data->status == 'Unread'){ ?>
                                        <div class="col-md-2 d-flex justify-content-center align-items-center">
                                            <div class="badge badge-lg badge-info">Belum Di Baca</div>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            <?php } ?>
                        <?php }else{
                            echo '<p class="text-center"> Tidak Ada Pemberitahuan </p>';
                        }?>
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
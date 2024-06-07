<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Berhasil</h4>
                    </div>
                    <div class="card-body">
                        <div class="p-5 text-center">
                            <img src="<?= base_url('assets/img/check.gif') ?>" alt="" width="50%">
                        </div>
                        <p class="text-center" style="font-size:24px; margin-top: -10px;">
                            Selamat <b><?= $nama ?></b>, <br>Kamu Berhasil <?= $action ?> Pada Tanggal <b><?= $tanggal . ' ' . $waktu ?></b>
                        </p>
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
<?php
$date = date('Y-m-d');
$time = date('H:i:s');
?>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Pengumpulan Eviden Peserta</h4>
                    </div>
                    <div class="card-body">
                        <form action="<?= base_url('absensi/proseseviden') ?>" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <input type="text" name="id" class="form-control form-control-sm" required hidden readonly value="<?= $id ?>">
                            </div>
                            <div class="input-group">
                                <label class="input-group-text" for="inputGroupFile02">Upload</label>
                                <input type="file" name="foto" class="form-control" id="inputGroupFile02">
                            </div>
                            <div class="form-group">
                                <label>Keterangan</label>
                                <textarea name="keterangan" class="form-control form-control-sm" required></textarea>
                            </div>

                            <div class="text-center mt-5" style="width: 100%;">
                                <button class="btn btn-success" type="submit" style="width: 100%;"> <i class="fas fa-plus"></i> Tambah</button>
                            </div>
                        </form>
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
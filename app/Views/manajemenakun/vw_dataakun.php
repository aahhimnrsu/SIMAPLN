<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4><?= $page ?></h4>
                        <div class="card-header-action">
                            <a href="<?= base_url('manajemenakun/tambah') ?>" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Akun</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table-1">
                                <thead>
                                    <tr>
                                        <th class="text-center">QRCode</th>
                                        <th class="text-center">Nama</th>
                                        <th class="text-center">Username</th>
                                        <th class="text-center">Role</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; 
                                    foreach ($datapeserta as $data) {
                                        ?>
                                        <tr>
                                            <td class="text-center"><img src="<?= base_url('').$data->qrcode ?>" width="50px" class="shadow shadow-none"></td>
                                            <td class="text-center"><?= $data->nama ?></td>
                                            <td class="text-center"><?= $data->username ?></td>
                                            <td class="text-center"><?= $data->role ?></td>
                                            <td class="text-center">
                                                <a href="<?= base_url('manajemenakun/detail/' . $data->id) ?>" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                                                <a href="<?= base_url('manajemenakun/edit/' . $data->id) ?>" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                                <a href="<?= base_url('manajemenakun/hapus/' . $data->id) ?>" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    <?php $no++;
                                    } ?>
                                </tbody>
                            </table>
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
        dom: 'Bfrtip',
        buttons: [
            'excel', 'pdf', 'print'
        ],
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
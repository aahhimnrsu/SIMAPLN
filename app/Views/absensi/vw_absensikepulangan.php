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
                        <h4>Absensi Kepulangan Peserta</h4>
                    </div>
                    <div class="card-body">
                        <form action="<?= base_url('absensi/prosesabsensikepulangan') ?>" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <input type="text" name="id" class="form-control form-control-sm" required hidden readonly value="<?= $id ?>">
                            </div>
                            <div class="form-group">
                                <label>Waktu</label>
                                <input type="time" name="waktu" class="form-control form-control-sm" required readonly value="<?= $time ?>">
                            </div>
                            <div class="form-group">
                                <label>Lokasi</label>
                                <div class="row">
                                    <div class="col-md-9">
                                        <div id="divSample" class="hideClass">
                                            <input type="text" id="Latitude" name="Latitude" value="" hidden>
                                            <input type="text" id="Longitude" name="Longitude" value="" hidden>
                                        </div>
                                        <input type="text" name="lokasi" id="Position1" class="form-control form-control-sm" required readonly>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="button" value="Dapatkan Lokasi Anda Saat Ini" class="btn btn-sm btn-info" onclick="getLocationConstant()" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div id="my_camera"></div>
                                    <br />
                                    <input type="hidden" name="foto" class="image-tag">
                                </div>
                                <div class="col-md-6">
                                    <div id="results"></div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center">
                                <input type="button" class="btn btn-sm btn-info" value="Ambil Foto" onClick="take_snapshot()">
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

<script type="text/javascript">
    Webcam.set({
        width: 490,
        height: 370,
        flip_horiz: true,
        image_format: 'jpeg',
        jpeg_quality: 100,
    });
    Webcam.attach('#my_camera');

    function take_snapshot() {
        Webcam.snap(function(data_uri) {
            $(".image-tag").val(data_uri);
            document.getElementById('results').innerHTML = '<img src="' + data_uri + '"/>';
        });
    }

    function getLocationConstant() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(onGeoSuccess, onGeoError);
        } else {
            alert("Your browser or device doesn't support Geolocation");
        }
    }

    // If we have a successful location update
    function onGeoSuccess(event) {
        document.getElementById("Latitude").value = event.coords.latitude;
        document.getElementById("Longitude").value = event.coords.longitude;
        document.getElementById("Position1").value = event.coords.latitude + "," + event.coords.longitude;

    }

    // If something has gone wrong with the geolocation request
    function onGeoError(event) {
        alert("Error code " + event.code + ". " + event.message);
    }
</script>
<script src="<?= base_url('assets/js/app.min.js') ?>"></script>
<script src="<?= base_url('assets/js/scripts.js') ?>"></script>
<script src="<?= base_url('assets/js/custom.js') ?>"></script>
</body>

</html>
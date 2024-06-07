<!-- Main Content -->

<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Detail Akun</h4>
                    </div>
                    <div class="card-body">
                        <?php foreach($dataakun as $data){ ?>
                            <div class="text-center">
                                <img src="<?= base_url($data->qrcode) ?>" width="20%"><br>
                                <?php if($data->qrcode == '/assets/img/qrcodex.png'){ ?>
                                    <a href="<?= base_url('manajemenakun/qrcode/'.$data->id) ?>" class="btn btn-info mt-3">Generate QRCode</a>
                                <?php }else{ ?>
                                    <a href="<?= base_url('manajemenakun/download/'.$data->id) ?>" class="btn btn-info mt-3">Download QRCode</a>
                                <?php } ?>
                            </div>
                            <div class="form-group">
                                <label>Nama Lengkap</label>
                                <input type="text" name="nama" class="form-control form-control-sm" required readonly value="<?= $data->nama ?>">
                            </div>
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="username" class="form-control form-control-sm" required readonly value="<?= $data->username ?>">
                            </div>
                            <div class="form-group">
                                <label>Role</label>
                                <input type="text" name="username" class="form-control form-control-sm" required readonly value="<?= $data->role ?>">
                            </div>
                            <div class="d-flex justify-content-between">
                                <a href="<?= base_url('manajemenakun/admin') ?>" class="btn btn-sm btn-danger"><i class="fas fa-chevron-left"></i> Kembali</a>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
</script>
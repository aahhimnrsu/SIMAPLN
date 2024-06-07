<!-- Main Content -->

<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Akun</h4>
                    </div>
                    <div class="card-body">
                        <?php foreach ($dataakun as $data) { ?>
                            <form action="<?= base_url('manajemenakun/edit/proses') ?>" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label>Nama Lengkap</label>
                                    <input type="text" name="nama" class="form-control form-control-sm" required value="<?= $data->nama ?>">
                                    <input type="text" name="id" class="form-control form-control-sm" required value="<?= $data->id ?>" hidden>
                                </div>
                                <div class="form-group">
                                    <label>Role</label>
                                    <select name="role" class="form-control form-control-sm" required>
                                        <option>---- Pilih Role ----</option>
                                        <option value="Admin">Admin</option>
                                        <option value="Dosen/Guru">Dosen/Guru</option>
                                        <option value="Peserta">Peserta</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" name="username" class="form-control form-control-sm" required value="<?= $data->username ?>">
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" name="password" class="form-control form-control-sm" >
                                </div>
                                <div class="d-flex justify-content-between">
                                    <?php if ($page == 'Profile') { ?>
                                        <a href="<?= base_url('dashboard') ?>" class="btn btn-danger"><i class="fas fa-chevron-left"></i> Kembali</a>
                                    <?php } else if ($page == 'Peserta') { ?>
                                        <a href="<?= base_url('peserta') ?>" class="btn btn-danger"><i class="fas fa-chevron-left"></i> Kembali</a>
                                    <?php } else { ?>
                                        <a href="<?= base_url('manajemenakun/admin') ?>" class="btn btn-danger"><i class="fas fa-chevron-left"></i> Kembali</a>
                                    <?php } ?>
                                    <button class="btn btn-warning" type="submit"> <i class="fas fa-edit"></i> Edit</button>
                                </div>
                            <?php } ?>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
</script>
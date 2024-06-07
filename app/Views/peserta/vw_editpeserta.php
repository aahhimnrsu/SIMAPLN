<!-- Main Content -->

<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Peserta</h4>
                    </div>
                    <div class="card-body">
                        <?php if (session()->get('id') != '' && $page == 'Profile') { ?>
                            <?php foreach ($datapeserta as $data) { ?>
                                <form action="<?= base_url('profile/edit/proses') ?>" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label>Nama Lengkap</label>
                                        <input type="text" name="id" class="form-control form-control-sm" required value="<?= $data->id ?>" hidden>
                                        <input type="text" name="nama" class="form-control form-control-sm" required value="<?= $data->nama ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Instansi</label>
                                        <input type="text" name="instansi" class="form-control form-control-sm" required value="<?= $data->instansi ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Tim</label>
                                        <input type="text" name="tim" class="form-control form-control-sm" required value="<?= $data->tim ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Pembimbing Instansi</label>
                                        <select name="id_pembimbing" class="form-control form-control-sm" required>
                                            <option value="-">---- Pilih Pembimbing ----</option>
                                            <?php foreach ($pembimbing as $pembimbing) { ?>
                                                <option value="<?= $pembimbing->id ?>"><?= $pembimbing->nama ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    <div class="form-group">
                                        <label>Tanggal Masuk</label>
                                        <input type="date" name="tglmasuk" class="form-control form-control-sm" required value="<?= $data->tglmasuk ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Tanggal Keluar</label>
                                        <input type="date" name="tglkeluar" class="form-control form-control-sm" required value="<?= $data->tglkeluar ?>">
                                    </div>
                                    <?php foreach ($dataakun as $akun) { ?>
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input type="text" name="username" class="form-control form-control-sm" required value="<?= $akun->username ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" name="password" class="form-control form-control-sm" required>
                                    </div>
                                    <?php } ?>
                                    <div class="d-flex justify-content-between">
                                        <?php if ($page == 'Profile') { ?>
                                            <a href="<?= base_url('dashboard') ?>" class="btn btn-danger"><i class="fas fa-chevron-left"></i> Kembali</a>
                                        <?php } else { ?>
                                            <a href="<?= base_url('peserta') ?>" class="btn btn-danger"><i class="fas fa-chevron-left"></i> Kembali</a>
                                        <?php } ?>
                                        <button class="btn btn-warning" type="submit"> <i class="fas fa-edit"></i> Edit</button>
                                    </div>
                                </form>
                            <?php } ?>
                        <?php } else if ($page == 'Peserta') { ?>
                            <?php foreach ($datapeserta as $data) { ?>
                                <form action="<?= base_url('peserta/edit/proses') ?>" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label>Nama Lengkap</label>
                                        <input type="text" name="id_user" class="form-control form-control-sm" required value="<?= $data->id_user ?>" hidden>
                                        <input type="text" name="id" class="form-control form-control-sm" required value="<?= $data->id ?>" hidden>
                                        <input type="text" name="nama" class="form-control form-control-sm" required value="<?= $data->nama ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Instansi</label>
                                        <input type="text" name="instansi" class="form-control form-control-sm" required value="<?= $data->instansi ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Tim</label>
                                        <input type="text" name="tim" class="form-control form-control-sm" required value="<?= $data->tim ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Pembimbing Instansi</label>
                                        <select name="id_pembimbing" class="form-control form-control-sm" required>
                                            <option value="-">---- Pilih Pembimbing ----</option>
                                            <?php foreach ($pembimbing as $pembimbing) { ?>
                                                <option value="<?= $pembimbing->id ?>"><?= $pembimbing->nama ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Tanggal Masuk</label>
                                        <input type="date" name="tglmasuk" class="form-control form-control-sm" required value="<?= $data->tglmasuk ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Tanggal Keluar</label>
                                        <input type="date" name="tglkeluar" class="form-control form-control-sm" required value="<?= $data->tglkeluar ?>">
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <?php if ($page == 'Profile') { ?>
                                            <a href="<?= base_url('dashboard') ?>" class="btn btn-danger"><i class="fas fa-chevron-left"></i> Kembali</a>
                                        <?php } else { ?>
                                            <a href="<?= base_url('peserta') ?>" class="btn btn-danger"><i class="fas fa-chevron-left"></i> Kembali</a>
                                        <?php } ?>
                                        <button class="btn btn-warning" type="submit"> <i class="fas fa-edit"></i> Edit</button>
                                    </div>
                                </form>
                            <?php } ?>
                        <?php } else { ?>
                            <form action="<?= base_url('peserta/tambah/proses') ?>" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label>Nama Lengkap</label>
                                    <input type="text" name="id_user" class="form-control form-control-sm" required value="<?= session()->get('id_user') ?>" hidden>
                                    <input type="text" name="nama" class="form-control form-control-sm" required value="<?= session()->get('nama') ?>">
                                </div>
                                <div class="form-group">
                                    <label>Instansi</label>
                                    <input type="text" name="instansi" class="form-control form-control-sm" required>
                                </div>
                                <div class="form-group">
                                    <label>Tim</label>
                                    <input type="text" name="tim" class="form-control form-control-sm" required>
                                </div>
                                <div class="form-group">
                                    <label>Pembimbing Instansi</label>
                                    <select name="id_pembimbing" class="form-control form-control-sm" required>
                                        <option value="-">---- Pilih Pembimbing ----</option>
                                        <?php foreach ($pembimbing as $pembimbing) { ?>
                                            <option value="<?= $pembimbing->id ?>"><?= $pembimbing->nama ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Masuk</label>
                                    <input type="date" name="tglmasuk" class="form-control form-control-sm" required>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Keluar</label>
                                    <input type="date" name="tglkeluar" class="form-control form-control-sm" required>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <a href="<?= base_url('dashboard') ?>" class="btn btn-danger"><i class="fas fa-chevron-left"></i> Kembali</a>
                                    <button class="btn btn-warning" type="submit"> <i class="fas fa-edit"></i> Ubah Data</button>
                                </div>
                            </form>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
</script>
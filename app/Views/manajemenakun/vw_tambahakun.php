<!-- Main Content -->

<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Tambah Akun</h4>
                    </div>
                    <div class="card-body">
                        <form action="<?= base_url('manajemenakun/tambah/proses') ?>" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Nama Lengkap</label>
                                <input type="text" name="nama" class="form-control form-control-sm" required>
                            </div>
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="username" class="form-control form-control-sm" required>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control form-control-sm" required>
                            </div>
                            <div class="form-group">
                                <label>Role</label>
                                <select name="role" class="form-control form-control-sm" required>
                                    <option>---- Pilih Keterangan ----</option>
                                    <option value="Admin">Admin</option>
                                    <option value="Dosen/Guru">Dosen/Guru</option>
                                    <option value="Peserta">Peserta</option>
                                </select>
                            </div>
                            <div class="d-flex justify-content-between">
                                <a href="<?= base_url('manajemenakun/admin') ?>" class="btn btn-sm btn-danger"><i class="fas fa-chevron-left"></i> Kembali</a>
                                <button class="btn btn-sm btn-success" type="submit"> <i class="fas fa-plus"></i>Tambah</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
</script>
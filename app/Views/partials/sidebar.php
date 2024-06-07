<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="<?= base_url('dashboard') ?>"> <img alt="image" src="<?= base_url('assets/img/logo.png')?>" class="header-logo" /> <span class="logo-name">SIMAPLN</span>
            </a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="dropdown <?php if ($page == "Dashboard") {
                                    echo 'active';
                                } ?>">
                <a href="<?= base_url('dashboard') ?>" class="nav-link"><i data-feather="monitor"></i><span>Dashboard</span></a>
            </li>
            <?php if(session()->get('role') != 'Dosen/Guru'){?>
            <li class="menu-header">Data Absensi</li>
            <li class="dropdown <?php if ($page == "Absensi") {
                                    echo 'active';
                                } ?>">
                <a href="<?= base_url('absensi') ?>" class="nav-link"><i data-feather="log-in"></i><span>Data Absensi Peserta</span></a>
            </li>
            <?php } ?>
            <?php if(session()->get('role') == 'Dosen/Guru' || session()->get('role') == 'Admin'){ ?>
                <li class="menu-header">Data Peserta</li>
                <li class="dropdown <?php if ($page == "Peserta") {
                    echo 'active';
                } ?>">
                <a href="<?= base_url('peserta') ?>" class="nav-link"><i data-feather="user"></i><span>Data Peserta Magang</span></a>
            </li>
            <?php } ?>
            <?php if(session()->get('role') == 'Admin'){ ?>
            <li class="menu-header">Data Akun</li>
            <li class="dropdown <?php if ($page == "Manajemen Akun") {
                                    echo 'active';
                                } ?>">
                <a href=" #" class="menu-toggle nav-link has-dropdown"><i data-feather="users"></i><span>Manajemen Akun</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="<?= base_url('manajemenakun/admin') ?>">Akun Admin</a></li>
                    <li><a class="nav-link" href="<?= base_url('manajemenakun/dosenguru') ?>">Akun Dosen/Guru</a></li>
                    <li><a class="nav-link" href="<?= base_url('manajemenakun/peserta') ?>">Akun Peserta</a></li>
                </ul>
            </li>
            <?php } ?>
            
        </ul>
    </aside>
</div>
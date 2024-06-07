<div id="app">
    <div class="main-wrapper main-wrapper-1">
        <div class="navbar-bg"></div>
        <nav class="navbar navbar-expand-lg main-navbar sticky">
            <div class="form-inline mr-auto">
                <ul class="navbar-nav mr-3">
                    <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg collapse-btn"> <i data-feather="align-justify"></i></a></li>
                    <li><a href="#" class="nav-link nav-link-lg fullscreen-btn">
                            <i data-feather="maximize"></i>
                        </a></li>
                    <li>

                    </li>
                </ul>
            </div>
            <ul class="navbar-nav navbar-right">
                <li class="dropdown dropdown-list-toggle">
                    <a href="#" data-toggle="dropdown" class="nav-link nav-link-lg message-toggle">
                        <i data-feather="bell" <?php if($countnotif > 0){ echo 'class="bell"';} ?> ></i>
                        <?php if($countnotif > 0){ ?>
                            <span class="badge headerBadge1"><?= $countnotif ?> </span> 
                        <?php } ?>
                    </a>
                    <div class="dropdown-menu dropdown-list dropdown-menu-right pullDown">
                        <div class="dropdown-header">
                            Pemberitahuan
                        </div>
                        <div class="dropdown-list-content dropdown-list-icons">
                        <?php if($countnotif > 0){ ?>
                            <?php foreach($notif as $notif){ ?>
                                <a href="#" class="dropdown-item dropdown-item-unread"> <span class="dropdown-item-icon bg-primary text-white"> <i class="far
                                                    fa-user"></i>
                                    </span> <span class="dropdown-item-desc"> <?= $notif->notifikasi ?><span class="time"><?= $notif->timestamp ?></span>
                                    </span>
                                </a> 
                            <?php } ?>
                        <?php }else{ ?>
                            <p class="text-center">Tidak Ada Pemberitahuan</p>
                        <?php } ?>
                        </div>
                        <div class="dropdown-footer text-center">
                            <a href="<?= base_url('notifikasi') ?>">Lihat Semua <i class="fas fa-chevron-right"></i></a>
                        </div>
                    </div>
                </li>

                <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                        <img alt="image" src="<?= base_url('assets/img/user.webp') ?>" class="user-img-radious-style"><span class="d-sm-none d-lg-inline-block"></span></a>
                    <div class="dropdown-menu dropdown-menu-right pullDown">
                        <div class="dropdown-title">Hai, <?= session()->get('nama') ?></div>
                        <div class="dropdown-divider"></div>
                        <?php if (session()->get('role') == 'Peserta') { ?>
                            <a href="<?= base_url('profile') ?>" class="dropdown-item has-icon"> <i class="fas fa-user"></i>
                                Profile
                            </a>
                        <?php } ?>
                        <a href="<?= base_url('logout') ?>" class="dropdown-item has-icon text-danger"> <i class="fas fa-sign-out-alt"></i>
                            Keluar
                        </a>
                    </div>
                </li>
            </ul>
        </nav>
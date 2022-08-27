<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile">
            <a href="#" class="nav-link">
                <div class="nav-profile-image">
                    <img src="<?= base_url(); ?>/assets/images/faces/face1.jpg" alt="profile">
                    <span class="login-status online"></span>
                    <!--change to offline or busy as needed-->
                </div>
                <div class="nav-profile-text d-flex flex-column">
                    <span class="font-weight-bold mb-2"><?= session()->get('namauser'); ?></span>
                    <span class="text-secondary text-small"><?= session()->get('iduser'); ?></span>
                </div>
                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_Url(); ?>">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#general-pages" aria-expanded="false" aria-controls="general-pages">
                <span class="menu-title">Data Karyawan</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-contacts menu-icon"></i>
            </a>
            <div class="collapse" id="general-pages">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="<?= base_url(); ?>/daftarkaryawan"> Daftar Karyawan </a></li>
                    <li class="nav-item"> <a class="nav-link" href="<?= base_url(); ?>/daftarkehadiran"> Daftar Kehadiran </a></li>
                    <li class="nav-item"> <a class="nav-link" href="<?= base_url(); ?>/izinkaryawan"> Izin Karyawan </a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#general-pages" aria-expanded="false" aria-controls="general-pages">
                <span class="menu-title">Data Penggajian</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-cash-usd menu-icon"></i>
            </a>
            <div class="collapse" id="general-pages">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="<?= base_url(); ?>/tunjangan"> Tunjangan Jabatan </a></li>
                    <li class="nav-item"> <a class="nav-link" href="<?= base_url(); ?>/potongan"> Potongan Izin </a></li>
                    <li class="nav-item"> <a class="nav-link" href="<?= base_url(); ?>/gaji"> Gaji Karyawan </a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#general-pages" aria-expanded="false" aria-controls="general-pages">
                <span class="menu-title">Management</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-cash-usd menu-icon"></i>
            </a>
            <div class="collapse" id="general-pages">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="<?= site_url('users') ?>"> Management User </a></li>
                </ul>
            </div>
        </li>
    </ul>
</nav>
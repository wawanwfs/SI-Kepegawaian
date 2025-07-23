<?= $this->extend('/templates/index'); ?>
<?= $this->section('content'); ?>

<div class="content-wrapper-light">
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-home"></i>
            </span> Dashboard
        </h3>
        <nav aria-label="breadcrumb">
            <ul class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                </li>
            </ul>
        </nav>
    </div>
    <div class="row">
        <div class="col-md-3 stretch-card grid-margin">
            <div class="card bg-gradient-danger card-img-holder text-white">
                <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Jumlah Karyawan <i class="mdi mdi-account-multiple mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5"><?= $jumlah_karyawan ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-3 stretch-card grid-margin">
            <div class="card bg-gradient-info card-img-holder text-white">
                <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Karyawan Laki-laki <i class="mdi mdi-gender-male mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5"><?= $karyawan_laki ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-3 stretch-card grid-margin">
            <div class="card bg-gradient-success card-img-holder text-white">
                <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Karyawan Perempuan<i class="mdi mdi-gender-female mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5"><?= $karyawan_perem ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-3 stretch-card grid-margin">
            <div class="card bg-gradient-primary card-img-holder text-white">
                <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Karyawan Tetap<i class="mdi mdi-account-check mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5"><?= $karyawan_tetap ?></h2>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Statistik Kehadiran Bulanan</h4>
                    <canvas id="kehadiranChart" data-kehadiran='<?= $kehadiran_bulanan; ?>'></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-4 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Status Karyawan</h4>
                    <canvas id="statusChart" data-tetap="<?= $karyawan_tetap; ?>" data-kontrak="<?= $karyawan_kontrak; ?>"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>
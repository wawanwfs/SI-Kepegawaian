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
        <div class="col-md-4 stretch-card grid-margin">
            <div class="card bg-gradient-danger card-img-holder text-white">
                <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Jumlah Karyawan <i class="mdi mdi-chart-line mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5"><?= $jumlah_karyawan ?> Karyawan</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4 stretch-card grid-margin">
            <div class="card bg-gradient-info card-img-holder text-white">
                <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Karyawan Masuk <i class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5"><?= $karyawan_masuk ?> Karyawan</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4 stretch-card grid-margin">
            <div class="card bg-gradient-success card-img-holder text-white">
                <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Karyawan Tidak Masuk<i class="mdi mdi-diamond mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5"><?= $jumlah_karyawan - $karyawan_masuk; ?> Karyawan </h2>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row py-2">
    <div class="col-md-4 py-1">
        <div class="card">
            <div class="card-body">
                <canvas id="chDonut1"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-4 py-1">
        <div class="card">
            <div class="card-body">
                <canvas id="chDonut2"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-4 py-1">
        <div class="card">
            <div class="card-body">
                <canvas id="chDonut3"></canvas>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>
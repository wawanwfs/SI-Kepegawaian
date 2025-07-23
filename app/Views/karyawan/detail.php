<?= $this->extend('templates/index'); ?>

<?= $this->section('content'); ?>
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-account-card-details"></i>
            </span>
            Detail Karyawan
        </h3>
    </div>
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <img src="<?= base_url('/profile/' . $karyawan['foto']); ?>" class="img-fluid rounded" alt="Foto Karyawan">
                        </div>
                        <div class="col-md-8">
                            <h4 class="card-title"><?= $karyawan['nama']; ?></h4>
                            <p class="card-text"><strong>NIK:</strong> <?= $karyawan['nik']; ?></p>
                            <p class="card-text"><strong>Tempat, Tanggal Lahir:</strong> <?= $karyawan['tempat_lahir']; ?>, <?= $karyawan['tanggal_lahir']; ?></p>
                            <p class="card-text"><strong>Jenis Kelamin:</strong> <?= $karyawan['jenis_kelamin']; ?></p>
                            <p class="card-text"><strong>Agama:</strong> <?= $karyawan['agama']; ?></p>
                            <p class="card-text"><strong>Alamat:</strong> <?= $karyawan['alamat']; ?></p>
                            <p class="card-text"><strong>No. Telepon:</strong> <?= $karyawan['no_telp']; ?></p>
                            <p class="card-text"><strong>Email:</strong> <?= $karyawan['email']; ?></p>
                            <p class="card-text"><strong>Jabatan:</strong> <?= $karyawan['jabatan']; ?></p>
                            <p class="card-text"><strong>Status:</strong> <?= ($karyawan['status'] == '1') ? 'Karyawan Tetap' : 'Karyawan Kontrak'; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

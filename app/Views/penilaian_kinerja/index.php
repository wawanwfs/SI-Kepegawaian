<?= $this->extend('templates/index'); ?>

<?= $this->section('content'); ?>
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-star"></i>
            </span>
            Penilaian Kinerja
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('penilaian_kinerja/create'); ?>" class="btn btn-primary">Tambah Penilaian</a></li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Data Penilaian Kinerja</h4>
                    <?php if (session()->getFlashdata('pesan')) : ?>
                        <div class="alert alert-success" role="alert">
                            <?= session()->getFlashdata('pesan'); ?>
                        </div>
                    <?php endif; ?>
                    <div class="table-responsive">
                        <table class="table" id="penilaianKinerjaTable">
                            <thead>
                                <tr>
                                    <th> # </th>
                                    <th> Nama Karyawan </th>
                                    <th> Tanggal Penilaian </th>
                                    <th> Nilai </th>
                                    <th> Catatan </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($penilaian_kinerja as $pk) : ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= $pk['id_karyawan']; ?></td>
                                        <td><?= $pk['tanggal_penilaian']; ?></td>
                                        <td><?= $pk['nilai']; ?></td>
                                        <td><?= $pk['catatan']; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->extend('templates/index'); ?>

<?= $this->section('content'); ?>
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-calendar-clock"></i>
            </span>
            Pengajuan Cuti
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('cuti/create'); ?>" class="btn btn-primary">Ajukan Cuti</a></li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Data Pengajuan Cuti</h4>
                    <?php if (session()->getFlashdata('pesan')) : ?>
                        <div class="alert alert-success" role="alert">
                            <?= session()->getFlashdata('pesan'); ?>
                        </div>
                    <?php endif; ?>
                    <div class="table-responsive">
                        <table class="table" id="cutiTable">
                            <thead>
                                <tr>
                                    <th> # </th>
                                    <th> Nama Karyawan </th>
                                    <th> Tanggal Mulai </th>
                                    <th> Tanggal Selesai </th>
                                    <th> Alasan </th>
                                    <th> Status </th>
                                    <th> Aksi </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($cuti as $c) : ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= $c['id_karyawan']; ?></td>
                                        <td><?= $c['tanggal_mulai']; ?></td>
                                        <td><?= $c['tanggal_selesai']; ?></td>
                                        <td><?= $c['alasan']; ?></td>
                                        <td>
                                            <?php if ($c['status'] == 'pending') : ?>
                                                <label class="badge badge-gradient-warning">Pending</label>
                                            <?php elseif ($c['status'] == 'disetujui') : ?>
                                                <label class="badge badge-gradient-success">Disetujui</label>
                                            <?php else : ?>
                                                <label class="badge badge-gradient-danger">Ditolak</label>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if ($c['status'] == 'pending') : ?>
                                                <a href="<?= base_url('cuti/approve/' . $c['id']); ?>" class="btn btn-success btn-sm">Setujui</a>
                                                <a href="<?= base_url('cuti/reject/' . $c['id']); ?>" class="btn btn-danger btn-sm">Tolak</a>
                                            <?php endif; ?>
                                        </td>
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

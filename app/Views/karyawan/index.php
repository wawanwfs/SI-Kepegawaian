<?= $this->extend('templates/index'); ?>

<?= $this->section('content'); ?>
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-account-multiple"></i>
            </span>
            Daftar Karyawan
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('karyawan/create'); ?>" class="btn btn-primary">Tambah Karyawan</a></li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Data Karyawan</h4>
                    <?php if (session()->getFlashdata('pesan')) : ?>
                        <div class="alert alert-success" role="alert">
                            <?= session()->getFlashdata('pesan'); ?>
                        </div>
                    <?php endif; ?>
                    <div class="table-responsive">
                        <table class="table" id="karyawanTable">
                            <thead>
                                <tr>
                                    <th> # </th>
                                    <th> Foto </th>
                                    <th> NIK </th>
                                    <th> Nama </th>
                                    <th> Jabatan </th>
                                    <th> Status </th>
                                    <th> Aksi </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($karyawan as $k) : ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><img src="<?= base_url('/profile/' . $k['foto']); ?>" class="mr-2" alt="image"></td>
                                        <td> <?= $k['nik']; ?> </td>
                                        <td> <?= $k['nama']; ?> </td>
                                        <td> <?= $k['jabatan']; ?> </td>
                                        <td>
                                            <?php if ($k['status'] == 'Karyawan Tetap') : ?>
                                                <label class="badge badge-gradient-success">Karyawan Tetap</label>
                                            <?php else : ?>
                                                <label class="badge badge-gradient-warning">Karyawan Kontrak</label>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <a href="<?= base_url('karyawan/detail/' . $k['slug']); ?>" class="btn btn-info btn-sm">Detail</a>
                                            <a href="<?= base_url('karyawan/edit/' . $k['id']); ?>" class="btn btn-warning btn-sm">Edit</a>
                                            <form action="<?= base_url('karyawan/delete/' . $k['id']); ?>" method="post" class="d-inline">
                                                <?= csrf_field(); ?>
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin?');">Hapus</button>
                                            </form>
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

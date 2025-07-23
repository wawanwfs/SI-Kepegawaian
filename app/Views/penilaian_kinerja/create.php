<?= $this->extend('templates/index'); ?>

<?= $this->section('content'); ?>
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-star-circle"></i>
            </span>
            Form Penilaian Kinerja
        </h3>
    </div>
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Form Penilaian Kinerja</h4>
                    <form action="<?= base_url('penilaian_kinerja/store'); ?>" method="post">
                        <?= csrf_field(); ?>
                        <div class="form-group">
                            <label for="id_karyawan">Karyawan</label>
                            <select class="form-control" id="id_karyawan" name="id_karyawan">
                                <?php foreach ($karyawan as $k) : ?>
                                    <option value="<?= $k['id']; ?>"><?= $k['nama']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tanggal_penilaian">Tanggal Penilaian</label>
                            <input type="date" class="form-control" id="tanggal_penilaian" name="tanggal_penilaian">
                        </div>
                        <div class="form-group">
                            <label for="nilai">Nilai (0-100)</label>
                            <input type="number" class="form-control" id="nilai" name="nilai" min="0" max="100">
                        </div>
                        <div class="form-group">
                            <label for="catatan">Catatan</label>
                            <textarea class="form-control" id="catatan" name="catatan" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

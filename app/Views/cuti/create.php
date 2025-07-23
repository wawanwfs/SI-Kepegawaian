<?= $this->extend('templates/index'); ?>

<?= $this->section('content'); ?>
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-calendar-plus"></i>
            </span>
            Form Pengajuan Cuti
        </h3>
    </div>
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Form Pengajuan Cuti</h4>
                    <form action="<?= base_url('cuti/store'); ?>" method="post">
                        <?= csrf_field(); ?>
                        <div class="form-group">
                            <label for="tanggal_mulai">Tanggal Mulai</label>
                            <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai">
                        </div>
                        <div class="form-group">
                            <label for="tanggal_selesai">Tanggal Selesai</label>
                            <input type="date" class="form-control" id="tanggal_selesai" name="tanggal_selesai">
                        </div>
                        <div class="form-group">
                            <label for="alasan">Alasan</label>
                            <textarea class="form-control" id="alasan" name="alasan" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Ajukan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

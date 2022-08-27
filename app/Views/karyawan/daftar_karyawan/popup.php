<button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#karyawan">
    <i class="mdi mdi-plus"> Tambah Karyawan</i>
</button>
<div class="modal fade" id="karyawan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="karyawanLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable " style="width: 73%;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="karyawanLabel">Form Tambah Karyawan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="mdi mdi-close"></i></button>
            </div>
            <div class="modal-body">
                <?= $this->include('karyawan/daftar_karyawan/create'); ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal"> <i class="mdi mdi-close"> Tutup</i></button>
            </div>
        </div>
    </div>
</div>
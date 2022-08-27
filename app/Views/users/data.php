<?= $this->extend('/templates/index'); ?>
<?= $this->section('content') ?>

<div class="section-header">
    <h1>Management User</h1>
    <div class="section-header-button">
        <button type="button" class="btn btn-sm btn-primary btntambah">
            <i class="fa fa-plus"></i> Tambah User Baru
        </button>
    </div>
</div>
<!-- DataTables  & Plugins-->
<div class="section-body">
    <div class="card">
        <div class="card-header">
            <h4>Management User</h4>
        </div>
        <table class="table table-sm table-bordered" id="datauser" style="width: 100%;">
            <thead>
                <tr>
                    <th>No</th>
                    <th>ID User</th>
                    <th>Nama User</th>
                    <th>Level</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
        <div class="viewmodal" style="display: none;"></div>
    </div>
</div>
<?= $this->endSection() ?>
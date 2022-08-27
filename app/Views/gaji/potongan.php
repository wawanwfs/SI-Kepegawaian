<?= $this->extend('/templates/index'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid">
    <div class="card-header text-justify">
        <div class="col-lg-12 stretch-card">
            <h3 class="col-md mt-2">Potongan Izin</h3>
            <?php
            if (session()->getFlashdata('pesan')) : ?>
                <div class="col alert alert-success" style="margin-right: 60px;" role="alert">
                    <?= session()->getFlashdata('pesan'); ?>
                </div>
            <?php endif; ?>
            <form action="" method="post">
                <div class="input-group">
                    <div class="form-outline">
                        <input type="text" id="keyword" name="keyword" class="form-control" placeholder="Masukkan keyword pencarian..." autofocus />
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="mdi mdi-account-search"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-responsive-md" id="printTable">
                <thead>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="float-left">
                            </div>
                            <div class="float-right">
                                <?= csrf_field(); ?>
                                <button class="btn btn-success shadow btn-xs sharp" onclick="printDiv()"><i class="mdi mdi-printer"></i> Cetak</button>
                                <a href="/karyawan/pdf" class="btn btn-danger shadow btn-xs sharp"><i class="mdi mdi-file-pdf"></i> PDF</a>
                                <a href="/karyawan/excel" class="btn btn-primary shadow btn-xs sharp"><i class="mdi mdi-file-excel"></i> Excel</a>
                            </div>
                        </div>
                    </div>
                    <tr>
                        <th><strong>#</strong></th>
                        <th><strong>Jenis Izin</strong></th>
                        <th><strong>Potongan</strong></th>
                        <th><strong>Ket.</strong></th>
                        <th style="text-align: center;"><strong>Action</strong></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1 + (10 * ($currentPage - 1)); ?>
                    <?php foreach ($gaji as $g) : ?>
                        <tr>
                            <th scope="row"><strong><?= $i++; ?></strong></th>
                            <td><?= $g['jenis_izin']; ?></td>
                            <td><?= $hasil = 'Rp ' . number_format($g['potongan'], 0, ",", "."); ?></td>
                            <td><?= $g['ket']; ?></td>
                            <td style="text-align: center;">
                                <div style="display: inline-flex;">
                                    <button type="button" class="btn btn-primary btn-sm" id="tombolUbah" data-bs-toggle="modal" data-bs-target="#ubahModal<?= $g['id']; ?>">
                                        <i class="mdi mdi-pencil-box-outline"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?= $pager->links('potongan', 'pages_pagination'); ?>
        </div>
    </div>
</div>

<?php foreach ($gaji as $g) : ?>
    <div class="modal fade" id="ubahModal<?= $g['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="ubahModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ubahModalLabel">Ubah potongan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/ubah/potongan/<?= $g['id']; ?>" method="post">
                        <input type="hidden" name="id" value="<?= $g['id']; ?>">
                        <div class="form-group">
                            <label for="id_potongan">Jenis Izin</label>
                            <select name="id_potongan" id="id_potongan" class="form-control">
                                <option value="<?= $g['id_izin']; ?>"><?= $g['jenis_izin']; ?></option>
                                <?php foreach ($gaji as $j) : ?>
                                    <option value="<?= $j['id_izin']; ?>"><?= $j['jenis_izin']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="potongan">Potongan</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Rp.</div>
                                </div>
                                <input type="text" name="potongan" id="potongan" class="form-control" value="<?= $g['potongan']; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="ket">Keterangan</label>
                            <input type="text" name="ket" id="ket" class="form-control" value="<?= $g['ket']; ?>">
                        </div>
                        <?= csrf_field(); ?>
                        <button type="submit" class="btn btn-primary">Ubah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<?= $this->endSection(); ?>
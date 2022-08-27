<?= $this->extend('/templates/index'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid">
    <div class="card-header text-justify">
        <div class="col-lg-12 stretch-card">
            <h3 class="col-md mt-2">Tunjangan Jabatan</h3>
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
                        <th><strong>Jabatan</strong></th>
                        <th><strong>Gaji Pokok</strong></th>
                        <th><strong>Tunjangan</strong></th>
                        <th><strong>Uang Makan</strong></th>
                        <th><strong>Hari Kerja</strong></th>
                        <th><strong>Total</strong></th>
                        <th style="text-align: center;"><strong>Action</strong></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1 + (10 * ($currentPage - 1)); ?>
                    <?php foreach ($gaji as $g) : ?>
                        <tr>
                            <th scope="row"><strong><?= $i++; ?></strong></th>
                            <td><?= $g['jabatan']; ?></td>
                            <td><?= $hasil = 'Rp ' . number_format($g['gaji_pokok'], 0, ",", "."); ?></td>
                            <td><?= $hasil = 'Rp ' . number_format($g['tunjangan'], 0, ",", "."); ?></td>
                            <td><?= $hasil = 'Rp ' . number_format($g['uang_makan'], 0, ",", "."); ?></td>
                            <td><?= $g['hari_kerja']; ?></td>
                            <?php $total = $g['gaji_pokok'] + $g['tunjangan'] + $g['uang_makan'] ?>
                            <?php $hasil = 'Rp ' . number_format($total, 2, ",", "."); ?>
                            <td>
                                <div class="d-flex align-items-center"><i class="fa fa-circle text-success me-1"></i><?= $hasil ?></div>
                            </td>
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
            <?= $pager->links('tunjangan', 'pages_pagination'); ?>
        </div>
    </div>
</div>


<?php foreach ($gaji as $g) : ?>
    <div class="modal fade" id="ubahModal<?= $g['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="ubahModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ubahModalLabel">Ubah Tunjangan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/ubah/tunjangan/<?= $g['id']; ?>" method="post">
                        <input type="hidden" name="id" value="<?= $g['id']; ?>">
                        <div class="form-group">
                            <label for="id_jabatan">Jabatan</label>
                            <select name="id_jabatan" id="id_jabatan" class="form-control">
                                <option value="<?= $g['id_jabatan']; ?>"><?= $g['jabatan']; ?></option>
                                <?php foreach ($gaji as $j) : ?>
                                    <option value="<?= $j['id_jabatan']; ?>"><?= $j['jabatan']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="gaji_pokok">Gaji Pokok</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Rp.</div>
                                </div>
                                <input type="text" name="gaji_pokok" id="gaji_pokok" class="form-control" value="<?= $g['gaji_pokok']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="tunjangan">Tunjangan</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">Rp.</div>
                                    </div>
                                    <input type="text" name="tunjangan" id="tunjangan" class="form-control" value="<?= $g['tunjangan']; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="uang_makan">Uang Makan</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">Rp.</div>
                                    </div>
                                    <input type="text" name="uang_makan" id="uang_makan" class="form-control" value="<?= $g['uang_makan']; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="hari_kerja">Hari Kerja</label>
                                <input type="text" name="hari_kerja" id="hari_kerja" class="form-control" value="<?= $g['hari_kerja']; ?>">
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
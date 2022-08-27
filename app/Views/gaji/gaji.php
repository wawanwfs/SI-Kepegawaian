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
                        <th><strong>NIK</strong></th>
                        <th><strong>Nama</strong></th>
                        <th><strong>Jabatan</strong></th>
                        <th><strong>Hari Kerja</strong></th>
                        <th><strong>Izin</strong></th>
                        <th><strong>Gaji</strong></th>
                        <th style="text-align: center;"><strong>Action</strong></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1 + (10 * ($currentPage - 1)); ?>
                    <?php foreach ($gaji as $g) : ?>
                        <tr>
                            <th scope="row"><strong><?= $i++; ?></strong></th>
                            <td><?= $g['nik']; ?></td>
                            <td><?= $g['nama']; ?></td>
                            <td><?= $g['jabatan']; ?></td>
                            <td><?= $g['hari_kerja']; ?> Hari</td>
                            <td>

                                <?php
                                $jumlah_izin = $izin->where('izin_karyawan.id_karyawan', $g['id'])->countAllResults();
                                ?>
                                <?= $jumlah_izin; ?> Hari</td>
                            <?php
                            $potongan_gaji = $g['potongan'] * $jumlah_izin ?>
                            <?php $total = $g['gaji_pokok'] + $g['tunjangan'] + $g['uang_makan'] - $potongan_gaji ?>
                            <?php $hasil = 'Rp ' . number_format($total, 2, ",", "."); ?>
                            <td>
                                <div class="d-flex align-items-center"><i class="fa fa-circle text-success me-1"></i><?= $hasil ?></div>
                            </td>
                            <td style="text-align: center;">
                                <div style="display: inline-flex;">
                                    <button type="button" class="btn btn-success shadow btn-xs sharp" id="tombolDetail" data-bs-toggle="modal" data-bs-target="#detailModal<?= $g['id']; ?>">
                                        <i class="mdi mdi-square-inc-cash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?= $pager->links('gaji', 'pages_pagination'); ?>
        </div>
    </div>
</div>

<?php $no = 0; ?>
<?php foreach ($gaji as $g) : $no++; ?>
    <div class="modal fade" id="detailModal<?= $g['id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="ubahModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="width: 73%;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ubahModalLabel">Slip Gaji Karyawan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="mdi mdi-close"></i></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-14">
                                <div class="float-left ml-5">
                                    <img src="<?= base_url('assets/images/logo-mini.svg'); ?>" alt="logo" max-width="100px" height="100px">
                                </div>
                                <div class="float-right ml-2">
                                    <h3>SI Kepegawainan</h3>
                                    <p>Teknik Informatika</p>
                                    <p>Universitas Dr. Soetomo</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <hr class="mt-0" style="height:2px;border:none;color:#333;background-color:#333;" />
                            </div>
                        </div>
                        <div class="row text-center">
                            <div class="col-md-12">
                                <h3>Slip Gaji Karyawan</h3>
                                <p>Periode : Agustus 2022</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <hr class="mt-0 mb-0" style="height:2px;border:none;color:#333;background-color:#333;" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <hr class="mt-1" style="height:2px;border:none;color:#333;background-color:#333;" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <table>
                                    <tr>
                                        <td>NIK&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                        <td>:</td>
                                        <td><?= $g['nik']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Nama&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                        <td>:</td>
                                        <td><?= $g['nama']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Jabatan&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                        <td>:</td>
                                        <td><?= $g['jabatan']; ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <hr style="height:2px;border:none;color:#333;background-color:#333;" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <table rules="rows">
                                    <tr>
                                        <td>Hari Kerja</td>
                                        <td>:</td>
                                        <td><?= $g['hari_kerja']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Gaji Pokok</td>
                                        <td>:</td>
                                        <td>Rp. <?= number_format($g['gaji_pokok'], 0, ',', '.'); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Tunjangan</td>
                                        <td>:</td>
                                        <td>Rp. <?= number_format($g['tunjangan'], 0, ',', '.'); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Uang Makan</td>
                                        <td>:</td>
                                        <td>Rp. <?= number_format($g['uang_makan'], 0, ',', '.'); ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <hr style="height:2px;border:none;color:#333;background-color:#333;" />
                            </div>
                        </div>
                        <div class="row text-center">
                            <div class="col-md-12">
                                <table>
                                    <?php $total = $g['gaji_pokok'] + $g['tunjangan'] + $g['uang_makan'] ?>
                                    <?php $hasil = 'Rp ' . number_format($total, 2, ",", "."); ?>
                                    <tr>
                                        <td><strong>Total Gaji</strong></td>
                                        <td><strong>: </strong></td>
                                        <td><strong><?= $hasil; ?></strong></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <hr style="height:2px;border:none;color:#333;background-color:#333;" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <p>Terima kasih atas kerja kerasnya</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <hr class="mt-1" style="height:2px;border:none;color:#333;background-color:#333;" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<?= $this->endSection(); ?>
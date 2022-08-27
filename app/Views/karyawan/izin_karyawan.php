<?= $this->extend('/templates/index'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid">
    <div class="card-header ">
        <div class="col-lg stretch-card">
            <h3 class="col-md mt-2">Izin Karyawan</h3>
            <?php if (session()->getFlashdata('pesan')) : ?>
                <div class="col-4 alert alert-success" role="alert">
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
                        <th><strong>Tangal Izin</strong></th>
                        <th><strong>Jenis Izin</strong></th>
                        <th><strong>Ket.</strong></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1 + (10 * ($currentPage - 1)); ?>
                    <?php foreach ($izin as $k) : ?>
                        <tr>
                            <th scope="row"><?= $i++; ?></th>
                            <td><strong><?= $k['nik']; ?></strong></td>
                            <td><?= $k['nama']; ?></td>
                            <td><?= $k['jabatan']; ?></td>
                            <?php if ($k['tanggal_izin'] == null) : ?>
                                <td colspan="3" class="text-center">
                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#izinModal<?= $k['nik']; ?> ">
                                        <i class="mdi mdi-calendar-edit"></i>
                                        Proses Izin
                                    </button>
                                </td>
                            <?php else : ?>
                                <?php
                                $tanggal = $k['tanggal_izin'];
                                switch (date('m', strtotime($tanggal))) {
                                    case '01':
                                        $bulan = 'Januari';
                                        break;
                                    case '02':
                                        $bulan = 'Februari';
                                        break;
                                    case '03':
                                        $bulan = 'Maret';
                                        break;
                                    case '04':
                                        $bulan = 'April';
                                        break;
                                    case '05':
                                        $bulan = 'Mei';
                                        break;
                                    case '06':
                                        $bulan = 'Juni';
                                        break;
                                    case '07':
                                        $bulan = 'Juli';
                                        break;
                                    case '08':
                                        $bulan = 'Agustus';
                                        break;
                                    case '09':
                                        $bulan = 'September';
                                        break;
                                    case '10':
                                        $bulan = 'Oktober';
                                        break;
                                    case '11':
                                        $bulan = 'November';
                                        break;
                                    case '12':
                                        $bulan = 'Desember';
                                        break;

                                    default:
                                        $bulan = 'Tidak diketahui';
                                        break;
                                }

                                $tanggal = date('d', strtotime($tanggal)) . ' ' . $bulan . ' ' . date('Y', strtotime($tanggal));
                                ?>
                                <td><?= $tanggal ?></td>
                                <td><?= $k['jenis_izin']; ?></td>
                                <td><?= $k['ket']; ?></td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?= $pager->links('izin', 'pages_pagination'); ?>
        </div>
    </div>
</div>




<?php $no = 0; ?>
<?php foreach ($izin as $e) : $no++; ?>
    <div class="modal fade" id="izinModal<?= $e['nik']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="izinModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable " style="width: 73%;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="izinModalLabel">Proses Izin Data Karyawan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="mdi mdi-close"></i></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col">
                                <div class="row mb-3">
                                    <label for="nik" class="col-sm-2 col-form-label">NIK<span class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <input type="text" readonly class="form-control" id="nik" name="nik" value="<?= $e['nik']; ?>">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="nama" class="col-sm-2 col-form-label">Nama<span class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <input type="text" readonly class="form-control" id="nama" name="nama" value="<?= $e['nama']; ?>" placeholder="Masukkan Nama.." required="">
                                    </div>
                                </div>
                                <form action="/prosesizin/save" method="post" enctype="multipart/form-data">
                                    <?= csrf_field(); ?>
                                    <?php $id_karyawan = substr($e['nik'], 6);
                                    $id_karyawan = $id_karyawan + 1; ?>
                                    <input type="hidden" name="id_karyawan" value="<?= $id_karyawan ?>">
                                    <div class="row mb-3">
                                        <label for="tanggal_izin" class="col-sm-2 col-form-label">Tanggal Izin<span class="text-danger">*</span></label>
                                        <div class="col-sm-10">
                                            <input type="date" class="form-control" id="tanggal_izin" name="tanggal_izin" value="<?= old('tanggal_izin'); ?>" placeholder="Masukkan Tanggal Izin.." required="" autofocus>
                                            <div class="invalid-feedback">
                                                Harap Masukkan Tanggal Izin.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="jenis_izin" class="col-sm-2 col-form-label">Jenis Izin<span class="text-danger">*</span></label>
                                        <div class="col-sm-10">
                                            <div class="input-group">
                                                <select class="custom-select" id="jenis_izin" name="jenis_izin" required="">
                                                    <option value="">Pilih Jenis Izin</option>
                                                    <option value="1" <?= old('jenis_izin') == '1' ? 'selected' : ''; ?>>Tanpa Keterangan</option>
                                                    <option value="2" <?= old('jenis_izin') == '2' ? 'selected' : ''; ?>>Cuti Resmi</option>
                                                    <option value="3" <?= old('jenis_izin') == '3' ? 'selected' : ''; ?>>Cuti Melahirkan</option>
                                                    <option value="4" <?= old('jenis_izin') == '4' ? 'selected' : ''; ?>>Izin Lain-Lain</option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Harap Masukkan Jenis Izin.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="ket" class="col-sm-2 col-form-label">Keterangan<span class="text-danger"></span></label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="ket" name="ket" value="<?= old('ket'); ?>" placeholder="Masukkan Keterangan..">
                                        </div>
                                    </div>
                                    <div style="text-align: center;">
                                        <button type="submit" class="btn btn-primary btn-sm"><i class="mdi mdi-calendar-edit">Proses Izin</i></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" name="izin" data-bs-dismiss="modal"> <i class="mdi mdi-close"> Tutup</i></button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<?= $this->endSection(); ?>
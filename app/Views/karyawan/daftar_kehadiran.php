<?= $this->extend('/templates/index'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid">
    <div class="card-header ">
        <div class="col-lg stretch-card">
            <h3 class="col-md mt-2">Daftar Kehadiran</h3>
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
                        <th><strong>Tangal Kehadiran</strong></th>
                        <th><strong>Jam Masuk</strong></th>
                        <th><strong>Jam Pulang</strong></th>
                        <th><strong>Ket.</strong></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1 + (10 * ($currentPage - 1)); ?>
                    <?php foreach ($kehadiran as $k) : ?>
                        <tr>
                            <th scope="row"><?= $i++; ?></th>
                            <td><strong><?= $k['nik']; ?></strong></td>
                            <td><?= $k['nama']; ?></td>
                            <td><?= $k['jabatan']; ?></td>
                            <td>
                                <?php
                                $tanggal = $k['tanggal_kehadiran'];
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
                                echo date('d', strtotime($tanggal)) . ' ' . $bulan . ' ' . date('Y', strtotime($tanggal));
                                ?></td>
                            <td><?= $k['jam_masuk']; ?></td>
                            <td><?= $k['jam_pulang']; ?></td>
                            <?php if ($k['jam_masuk'] > '08:00:00') : ?>
                                <td><strong>Telat</strong></td>
                            <?php else : ?>
                                <td><strong>Tepat Waktu</strong></td>
                            <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?= $pager->links('kehadiran', 'pages_pagination'); ?>
        </div>
    </div>
</div>


<?= $this->endSection(); ?>
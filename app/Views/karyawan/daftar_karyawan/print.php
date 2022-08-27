<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= $title; ?></title>
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/css/style.css">
    <link rel="shortcut icon" href="<?= base_url(); ?>/assets/images/favicon.png" />
</head>

<body>
    <div id="divToPrint">
        <div class="card-header">
            <h3 class="card-title text-center">Daftar Karyawan</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Tempat Lahir</th>
                            <th>Tanggal Lahir</th>
                            <th>Jenis Kelamin</th>
                            <th>Agama</th>
                            <th>Alamat</th>
                            <th>No Telp</th>
                            <th>Email</th>
                            <th>Jabatan</th>
                            <th>Status</th>
                            <th>Foto</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($k as $karyawan) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $karyawan['nik']; ?></td>
                                <td><?= $karyawan['nama']; ?></td>
                                <td><?= $karyawan['tempat_lahir']; ?></td>
                                <td><?= $karyawan['tanggal_lahir']; ?></td>
                                <td><?= $karyawan['jenis_kelamin']; ?></td>
                                <td><?= $karyawan['agama']; ?></td>
                                <td><?= $karyawan['alamat']; ?></td>
                                <td><?= $karyawan['no_telp']; ?></td>
                                <td><?= $karyawan['email']; ?></td>
                                <td><?= $karyawan['jabatan']; ?></td>
                                <td><?= $karyawan['status']; ?></td>
                                <td><img src="<?= base_url(); ?>/profile/<?= $karyawan['foto']; ?>" width="100"></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        window.print()
    </script>
    <?= $this->include('templates/script'); ?>
</body>
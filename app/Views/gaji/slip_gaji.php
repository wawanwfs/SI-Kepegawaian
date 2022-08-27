<!DOCTYPE html>
<html>

<head>
    <title>Slip Gaji</title>
    <style type="text/css">
        table {
            border-collapse: collapse;
            width: 100%;
            margin: 0 auto;
        }

        table th {
            border: 1px solid #000;
            padding: 3px;
            font-weight: bold;
            text-align: center;
        }

        table td {
            border: 1px solid #000;
            padding: 3px;
            vertical-align: top;
        }

        table tr td {
            font-size: 12px;
        }

        table tr td.bolder {
            font-size: 12px;
            font-weight: bold;
        }

        table tr.bolder td {
            font-size: 12px;
            font-weight: bold;
        }

        table tr.bolder td.bolder {
            font-size: 12px;
            font-weight: bold;
        }

        table tr.bolder td.bolder {
            font-size: 12px;
            font-weight: bold;
        }

        table tr.bolder td.bolder {
            font-size: 12px;
            font-weight: bold;
        }

        table tr.bolder td.bolder {
            font-size: 12px;
            font-weight: bold;
        }

        table tr.bolder td.bolder {
            font-size: 12px;
            font-weight: bold;
        }

        table tr.bolder td.bolder {
            font-size: 12px;
            font-weight: bold;
        }

        table tr.bolder td.bolder {
            font-size: 12px;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="float-left">
                    <img src="<?= base_url('assets/img/logo.png'); ?>" alt="logo" width="100px" height="100px">
                </div>
                <div class="float-right">
                    <h3>PT. Surya Putra Jaya</h3>
                    <p>Jl. Raya Cikarang No. 1, Cikarang Utara, Cikarang, Bekasi, Jawa Barat</p>
                    <p>Telp. 021-81234567</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h3>Slip Gaji</h3>
                <p>Periode : Agustus 2022</p>
                ?></p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table>
                    <tr>
                        <td>NIK</td>
                        <td>:</td>
                        <td><?= $g['nik']; ?></td>
                    </tr>
                    <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td><?= $g['nama']; ?></td>
                    </tr>
                    <tr>
                        <td>Jabatan</td>
                        <td>:</td>
                        <td><?= $g['jabatan']; ?></td>
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
                    <tr>
                        <td>Hari Kerja</td>
                        <td>:</td>
                        <td><?= $g['hari_kerja']; ?></td>
                    </tr>
                    <?php $total = $g['gaji_pokok'] + $g['tunjangan'] + $g['uang_makan'] ?>
                    <?php $hasil = 'Rp ' . number_format($total, 2, ",", "."); ?>
                    <tr>
                        <td>Total Gaji</td>
                        <td>:</td>
                        <td>Rp. <?= $hasil; ?></td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <p>Terima kasih atas kerja kerasnya</p>
            </div>
        </div>
    </div>
</body>

</html>
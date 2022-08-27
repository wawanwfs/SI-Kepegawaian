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
    <?php if ($title == 'Management User') : ?>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <?php endif; ?>



</head>

<body>
    <div class="container-scroller">
        <?= $this->include('templates/nav-header'); ?>
        <div class="container-fluid page-body-wrapper">
            <?= $this->include('templates/sidebar'); ?>
            <div class="main-panel">
                <?php $this->renderSection('content'); ?>
                <?= $this->include('templates/footer'); ?>
            </div>
        </div>
    </div>
    <?= $this->include('templates/script'); ?>
    <?php if ($title == 'SIK - Dashboard') : ?>
        <script>
            var colors = ['#007bff', '#28a745', '#333333', '#c3e6cb', '#dc3545', '#6c757d'];

            var donutOptions = {
                cutoutPercentage: 50,
                legend: {
                    display: false
                },
                legend: {
                    position: 'bottom',
                    padding: 5,
                    labels: {
                        pointStyle: 'circle',
                        usePointStyle: true
                    }
                }
            };
            var chDonutData1 = {
                labels: [
                    'Laki-Laki',
                    'Perempuan'
                ],
                datasets: [{
                    backgroundColor: colors.slice(0, 2),
                    borderWidth: 0,
                    data: [<?= $karyawan_laki; ?>, <?= $karyawan_perem; ?>],
                }]
            };
            var chDonut1 = document.getElementById("chDonut1");
            if (chDonut1) {
                new Chart(chDonut1, {
                    type: 'pie',
                    data: chDonutData1,
                    options: donutOptions
                });
            }


            var chDonutData2 = {
                labels: [
                    'K. Masuk',
                    'K. Tidak Masuk'
                ],
                datasets: [{
                    backgroundColor: colors.slice(0, 2),
                    borderWidth: 0,
                    data: [<?= $karyawan_masuk; ?>, <?= $jumlah_karyawan - $karyawan_masuk; ?>],
                }]

            };
            var chDonut2 = document.getElementById("chDonut2");
            if (chDonut2) {
                new Chart(chDonut2, {
                    type: 'pie',
                    data: chDonutData2,
                    options: donutOptions
                });
            }

            var chDonutData3 = {
                labels: [
                    'K. Tetap',
                    'K. Kontrak'
                ],
                datasets: [{
                    backgroundColor: colors.slice(0, 2),
                    borderWidth: 0,
                    data: [<?= $karyawan_tetap; ?>, <?= $karyawan_kontrak; ?>],
                }]

            };
            var chDonut3 = document.getElementById("chDonut3");
            if (chDonut3) {
                new Chart(chDonut3, {
                    type: 'pie',
                    data: chDonutData3,
                    options: donutOptions
                });
            }
        </script>
    <?php endif; ?>

</body>

</html>
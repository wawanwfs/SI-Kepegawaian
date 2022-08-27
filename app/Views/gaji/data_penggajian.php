<?= $this->extend('/templates/index'); ?>
<?= $this->section('content'); ?>

<div class="content-wrapper">
    <div class="page-header">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Data Penggajian</a></li>
            </ol>
        </nav>
    </div>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <h3 class="card-title text-left">Daftar Penggajian</h3>
            <div>
                <form action="" method="post">
                    <div class="input-group">
                        <div class="form-outline">
                            <input type="text" id="keyword" name="keyword" class="form-control" placeholder="Masukkan keyword pencarian..." autofocus />
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="mdi mdi-account-search"></i>
                        </button>
                    </div>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th> Foto User </th>
                            <th> ID User </th>
                            <th> Nama </th>
                            <th> Jabatan </th>
                            <th> Status </th>
                            <th> Action </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td class="py-1">
                                <img src="../../assets/images/faces-clipart/pic-1.png" alt="image" />
                            </td>
                            <td><?= $num_str = sprintf("%06d", mt_rand(1, 999999)); ?></td>
                            <td> Herman Beck </td>
                            <td>Operator</td>
                            <td><label class="badge badge-warning">In progress</label></td>
                            <td>
                                <a href="#" class="btn btn-success">Detail</a>
                            </td>
                        </tr>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td class="py-1">
                                <img src="../../assets/images/faces-clipart/pic-1.png" alt="image" />
                            </td>
                            <td><?= $num_str = sprintf("%06d", mt_rand(1, 999999)); ?></td>
                            <td> Herman Beck </td>
                            <td>Operator</td>
                            <td><label class="badge badge-warning">In progress</label></td>
                            <td>
                                <a href="#" class="btn btn-success">Detail</a>
                            </td>
                        </tr>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td class="py-1">
                                <img src="../../assets/images/faces-clipart/pic-1.png" alt="image" />
                            </td>
                            <td><?= $num_str = sprintf("%06d", mt_rand(1, 999999)); ?></td>
                            <td> Herman Beck </td>
                            <td>Operator</td>
                            <td><label class="badge badge-success">Completed</label></td>
                            <td>
                                <a href="#" class="btn btn-success">Detail</a>
                            </td>
                        </tr>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td class="py-1">
                                <img src="../../assets/images/faces-clipart/pic-1.png" alt="image" />
                            </td>
                            <td><?= $num_str = sprintf("%06d", mt_rand(1, 999999)); ?></td>
                            <td> Herman Beck </td>
                            <td>Operator</td>
                            <td><label class="badge badge-warning">In progress</label></td>
                            <td>
                                <a href="#" class="btn btn-success">Detail</a>
                            </td>
                        </tr>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td class="py-1">
                                <img src="../../assets/images/faces-clipart/pic-1.png" alt="image" />
                            </td>
                            <td><?= $num_str = sprintf("%06d", mt_rand(1, 999999)); ?></td>
                            <td> Herman Beck </td>
                            <td>Operator</td>
                            <td><label class="badge badge-success">Completed</label></td>
                            <td>
                                <a href="#" class="btn btn-success">Detail</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>
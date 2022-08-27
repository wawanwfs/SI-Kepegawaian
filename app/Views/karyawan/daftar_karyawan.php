<?= $this->extend('/templates/index'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid">
    <div class="card-header text-justify">
        <div class="col-lg-12 stretch-card">
            <h3 class="col-md mt-2">Daftar Karyawan</h3>
            <?php

            use App\Controllers\Karyawan;

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
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#karyawan">
                                    <i class="mdi mdi-plus"> Tambah Karyawan</i>
                                </button>
                                <div class="modal fade" id="karyawan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="karyawanLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-scrollable " style="width: 73%;">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="karyawanLabel">Form Tambah Karyawan</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="mdi mdi-close"></i></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="container-fluid">
                                                    <div class="row">
                                                        <div class="col">
                                                            <form action="/save" method="post" enctype="multipart/form-data">
                                                                <?= csrf_field(); ?>
                                                                <div class="row mb-3">
                                                                    <label for="nik" class="col-sm-2 col-form-label">NIK<span class="text-danger">*</span></label>
                                                                    <div class="col-sm-10">
                                                                        <?php
                                                                        $today = Date('ymd');
                                                                        $id = $jumlah_karyawan + 1;
                                                                        $char = $today . $id;
                                                                        ?>
                                                                        <input type="text" readonly class="form-control" id="nik" name="nik" value="<?= $char; ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="row mb-3">
                                                                    <label for="nama" class="col-sm-2 col-form-label">Nama<span class="text-danger">*</span></label>
                                                                    <div class="col-sm-10">
                                                                        <input type="text" class="form-control" id="nama" name="nama" value="<?= old('nama'); ?>" placeholder="Masukkan Nama.." required="" autofocus>
                                                                        <div class="invalid-feedback">
                                                                            Harap Masukkan Nama.
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row mb-3">
                                                                    <label for="tempat_lahir" class="col-sm-2 col-form-label">Tempat Lahir<span class="text-danger">*</span></label>
                                                                    <div class="col-sm-10">
                                                                        <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="<?= old('tempat_lahir'); ?>" placeholder="Masukkan Tempat Lahir.." required="">
                                                                        <div class="invalid-feedback">
                                                                            Harap Masukkan Tempat Lahir.
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row mb-3">
                                                                    <label for="tanggal_lahir" class="col-sm-2 col-form-label">Tanggal Lahir<span class="text-danger">*</span></label>
                                                                    <div class="col-sm-10">
                                                                        <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="<?= old('tanggal_lahir'); ?>" placeholder="Masukkan Tanggal Lahir.." required="">
                                                                        <div class="invalid-feedback">
                                                                            Harap Masukkan Tanggal Lahir.
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row mb-3">
                                                                    <label for="jenis_kelamin" class="col-sm-2 col-form-label">Jenis Kelamin<span class="text-danger">*</span></label>
                                                                    <div class="col-sm-10">
                                                                        <div class="input-group">
                                                                            <select class="custom-select" id="jenis_kelamin" name="jenis_kelamin" required="">
                                                                                <option value="">Pilih Jenis Kelamin</option>
                                                                                <option value="Laki-Laki" <?= old('jenis_kelamin') == 'Laki-Laki' ? 'selected' : ''; ?>>Laki-Laki</option>
                                                                                <option value="Perempuan" <?= old('jenis_kelamin') == 'Perempuan' ? 'selected' : ''; ?>>Perempuan</option>
                                                                            </select>
                                                                            <div class="invalid-feedback">
                                                                                Harap Masukkan Jenis Kelamin.
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row mb-3">
                                                                    <label for="agama" class="col-sm-2 col-form-label">Agama<span class="text-danger">*</span></label>
                                                                    <div class="col-sm-10">
                                                                        <div class="input-group">
                                                                            <select class="custom-select" id="agama" name="agama" required="">
                                                                                <option value="">Pilih Agama</option>
                                                                                <option value="Islam" <?= old('agama') == 'Islam' ? 'selected' : ''; ?>>Islam</option>
                                                                                <option value="Kristen" <?= old('agama') == 'Kristen' ? 'selected' : ''; ?>>Kristen</option>
                                                                                <option value="Katholik" <?= old('agama') == 'Katolik' ? 'selected' : ''; ?>>Katholik</option>
                                                                                <option value="Hindu" <?= old('agama') == 'Hindu' ? 'selected' : ''; ?>>Hindu</option>
                                                                                <option value="Budha" <?= old('agama') == 'Budha' ? 'selected' : ''; ?>>Budha</option>
                                                                                <option value="Konghucu" <?= old('agama') == 'Konghucu' ? 'selected' : ''; ?>>Konghucu</option>
                                                                            </select>
                                                                            <div class="invalid-feedback">
                                                                                Harap Masukkan Agama.
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row mb-3">
                                                                    <label for="alamat" class="col-sm-2 col-form-label">Alamat<span class="text-danger">*</span></label>
                                                                    <div class="col-sm-10">
                                                                        <textarea class="form-control" id="alamat" name="alamat" rows="3" required=""><?= old('alamat'); ?></textarea>
                                                                        <div class="invalid-feedback">
                                                                            Harap Masukkan Alamat.
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row mb-3">
                                                                    <label for="no_telp" class="col-sm-2 col-form-label">Kontak<span class="text-danger">*</span></label>
                                                                    <div class="col-sm-10">
                                                                        <input type="number" class="form-control" id="no_telp" name="no_telp" value="<?= old('no_telp'); ?>" placeholder="Masukkan Kontak.." required="">
                                                                    </div>
                                                                </div>
                                                                <div class="row mb-3">
                                                                    <label for="email" class="col-sm-2 col-form-label">Email<span class="text-danger">*</span></label>
                                                                    <div class="col-sm-10">
                                                                        <input type="email" class="form-control" id="email" name="email" value="<?= old('email'); ?>" placeholder="Masukkan Email.." required="">
                                                                        <div class="invalid-feedback">
                                                                            Harap Masukkan Email.
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row mb-3">
                                                                    <label for="jabatan" class="col-sm-2 col-form-label">Jabatan<span class="text-danger">*</span></label>
                                                                    <div class="col-sm-10">
                                                                        <div class="input-group">
                                                                            <select class="custom-select" id="jabatan" name="jabatan" required="">
                                                                                <option value="">Pilih Jabatan</option>
                                                                                <option value="1" <?= old('jabatan') == '1' ? 'selected' : ''; ?>>MNG - Manager</option>
                                                                                <option value="2" <?= old('jabatan') == '2' ? 'selected' : ''; ?>>ADM - Administrasi</option>
                                                                                <option value="3" <?= old('jabatan') == '3' ? 'selected' : ''; ?>>DRV - Driver</option>
                                                                                <option value="4" <?= old('jabatan') == '4' ? 'selected' : ''; ?>>RSP - Resepsionis</option>
                                                                                <option value="5" <?= old('jabatan') == '5' ? 'selected' : ''; ?>>MKT - Marketing</option>
                                                                                <option value="6" <?= old('jabatan') == '6' ? 'selected' : ''; ?>>OPR - Operator</option>
                                                                                <option value="7" <?= old('jabatan') == '7' ? 'selected' : ''; ?>>GDG - Gudang</option>
                                                                                <option value="8" <?= old('jabatan') == '8' ? 'selected' : ''; ?>>SCT - Security</option>
                                                                            </select>
                                                                            <div class="invalid-feedback">
                                                                                Harap Masukkan Jabatan.
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row mb-3">
                                                                    <label for="status" class="col-sm-2 col-form-label">Status<span class="text-danger">*</span></label>
                                                                    <div class="col-sm-10">
                                                                        <div class="input-group">
                                                                            <select class="custom-select" id="status" name="status" required="">
                                                                                <option value="">Pilih Status</option>
                                                                                <option value="1" <?= old('status') == '1' ? 'selected' : ''; ?>>Karyawan Tetap</option>
                                                                                <option value="2" <?= old('status') == '2' ? 'selected' : ''; ?>>Karyawan Kontrak</option>
                                                                                <div class="invalid-feedback">
                                                                                    Harap Masukkan Status.
                                                                                </div>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label for="foto" class="col-sm-2 col-form-label">Foto<span class="text-danger">*</span></label>
                                                                    <div class="col-sm-2">
                                                                        <img src="/profile/default.jpg" class="img-thumbnail img-preview">
                                                                    </div>
                                                                    <div class="col-sm-8">
                                                                        <div class="input-group mb-3">
                                                                            <input type="file" class="form-control <?= ($validation->hasError('foto')) ? 'is-invalid' : ''; ?>" id="foto" name="foto">
                                                                            <div class="invalid-feedback">
                                                                                <?= $validation->getError('foto'); ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div style="text-align: center;">
                                                                    <button type="submit" class="btn btn-primary"><i class="mdi mdi-plus">Tambah Karyawan</i></button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal"> <i class="mdi mdi-close"> Tutup</i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>


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
                        <th><strong>Foto</strong></th>
                        <th><strong>NIK</strong></th>
                        <th><strong>Nama</strong></th>
                        <th><strong>No Telp</strong></th>
                        <th><strong>Jabatan</strong></th>
                        <th><strong>Status</strong></th>
                        <th><strong>Action</strong></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1 + (10 * ($currentPage - 1)); ?>
                    <?php foreach ($karyawan as $k) : ?>
                        <tr>
                            <th scope="row"><?= $i++; ?></th>
                            <td><img src="<?= base_url(); ?>/profile/<?= $k['foto']; ?>" alt="" class="sampul"></td>
                            <td><strong><?= $k['nik']; ?></strong></td>
                            <td><?= $k['nama']; ?></td>
                            <td><?= $k['no_telp']; ?></td>
                            <td><?= $k['jabatan']; ?></td>
                            <td>
                                <div class="d-flex align-items-center"><i class="fa fa-circle text-success me-1"></i><?= $k['status']; ?></div>
                            </td>
                            <td style="text-align: center;">
                                <div style="display: inline-flex;">
                                    <button type="button" class="btn btn-primary btn-sm" id="tombolUbah" data-bs-toggle="modal" data-bs-target="#ubahModal<?= $k['id']; ?>">
                                        <i class="mdi mdi-pencil-box-outline"></i>
                                    </button>
                                    <form action="<?= base_url(); ?>/daftarkaryawan/delete/<?= $k['id']; ?>" method="post" class="d-inline">
                                        <?= csrf_field(); ?>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-danger shadow btn-xs sharp me-1" onclick="return confirm('Apakah Anda yakin?')"><i class="mdi mdi-delete-forever"></i></button>
                                    </form>
                                    <button type="button" class="btn btn-success shadow btn-xs sharp" id="tombolDetail" data-bs-toggle="modal" data-bs-target="#detailModal<?= $k['slug']; ?>">
                                        <i class="mdi mdi-account-box-outline"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?= $pager->links('karyawan', 'pages_pagination'); ?>
        </div>
    </div>
</div>



<!-- modal -->

<?php $no = 0; ?>
<?php foreach ($karyawan as $k) : $no++; ?>
    <div class="modal fade" id="ubahModal<?= $k['id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="ubahModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable " style="width: 73%;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ubahModalLabel">Form Ubah Data Karyawan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="mdi mdi-close"></i></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col">
                                <form action="<?= $k['slug']; ?>" method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="id" value="<?= $k['id']; ?>">
                                    <input type="hidden" name="slug" value="<?= $k['slug']; ?>">
                                    <div class="row mb-3">
                                        <label for="nik" class="col-sm-2 col-form-label">NIK<span class="text-danger">*</span></label>
                                        <div class="col-sm-10">
                                            <input type="text" readonly class="form-control" id="nik" name="nik" value="<?= (old('nik'))  ? old('nik') : $k['nik'] ?>">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="nama" class="col-sm-2 col-form-label">Nama<span class="text-danger">*</span></label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama.." required="" value="<?= (old('nama'))  ? old('nama') : $k['nama'] ?>" autofocus>
                                            <div class="invalid-feedback">
                                                Harap Masukkan Nama.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="tempat_lahir" class="col-sm-2 col-form-label">Tempat Lahir<span class="text-danger">*</span></label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" placeholder="Masukkan Tempat Lahir.." value="<?= (old('tempat_lahir'))  ? old('tempat_lahir') : $k['tempat_lahir'] ?>" required="">
                                            <div class="invalid-feedback">
                                                Harap Masukkan Tempat Lahir.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="tanggal_lahir" class="col-sm-2 col-form-label">Tanggal Lahir<span class="text-danger">*</span></label>
                                        <div class="col-sm-10">
                                            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" placeholder="Masukkan Tanggal Lahir.." value="<?= (old('tanggal_lahir'))  ? old('tanggal_lahir') : $k['tanggal_lahir'] ?>" required="">
                                            <div class="invalid-feedback">
                                                Harap Masukkan Tanggal Lahir.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="jenis_kelamin" class="col-sm-2 col-form-label">Jenis Kelamin<span class="text-danger">*</span></label>
                                        <div class="col-sm-10">
                                            <div class="input-group">
                                                <select class="custom-select" id="jenis_kelamin" name="jenis_kelamin" required="">
                                                    <option hidden id="jenis_kelamin" value="<?= (old('jenis_kelamin'))  ? old('jenis_kelamin') : $k['jenis_kelamin'] ?>"><?= (old('jenis_kelamin'))  ? old('jenis_kelamin') : $k['jenis_kelamin'] ?></option>
                                                    <option value="Laki-Laki" <?= old('jenis_kelamin') == 'Laki-laki' ? 'selected' : ''; ?>>Laki-Laki</option>
                                                    <option value="Perempuan" <?= old('jenis_kelamin') == 'Perempuan' ? 'selected' : ''; ?>>Perempuan</option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Harap Masukkan Jenis Kelamin.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="agama" class="col-sm-2 col-form-label">Agama<span class="text-danger">*</span></label>
                                        <div class="col-sm-10">
                                            <div class="input-group">
                                                <select class="custom-select" id="agama" name="agama" required="">
                                                    <option hidden id="agama" value="<?= (old('agama'))  ? old('agama') : $k['agama'] ?>"><?= (old('agama'))  ? old('agama') : $k['agama'] ?></option>
                                                    <option value="Islam" <?= old('agama') == 'Islam' ? 'selected' : ''; ?>>Islam</option>
                                                    <option value="Kristen" <?= old('agama') == 'Kristen' ? 'selected' : ''; ?>>Kristen</option>
                                                    <option value="Katolik" <?= old('agama') == 'Katolik' ? 'selected' : ''; ?>>Katolik</option>
                                                    <option value="Hindu" <?= old('agama') == 'Hindu' ? 'selected' : ''; ?>>Hindu</option>
                                                    <option value="Budha" <?= old('agama') == 'Budha' ? 'selected' : ''; ?>>Budha</option>
                                                    <option value="Konghucu" <?= old('agama') == 'Konghucu' ? 'selected' : ''; ?>>Konghucu</option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Harap Masukkan Agama.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="alamat" class="col-sm-2 col-form-label">Alamat<span class="text-danger">*</span></label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" id="alamat" name="alamat" placeholder="Masukkan Alamat.." required=""><?= (old('alamat'))  ? old('alamat') : $k['alamat'] ?></textarea>
                                            <div class="invalid-feedback">
                                                Harap Masukkan Alamat.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="no_telp" class="col-sm-2 col-form-label">Kontak<span class="text-danger">*</span></label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="no_telp" name="no_telp" placeholder="Masukkan Kontak.." value="<?= (old('no_telp'))  ? old('no_telp') : $k['no_telp'] ?>" required="">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="email" class="col-sm-2 col-form-label">Email<span class="text-danger">*</span></label>
                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan Email.." value="<?= (old('email'))  ? old('email') : $k['email'] ?>" required="">
                                            <div class="invalid-feedback">
                                                Harap Masukkan Email.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="jabatan" class="col-sm-2 col-form-label">Jabatan<span class="text-danger">*</span></label>
                                        <div class="col-sm-10">
                                            <div class="input-group">
                                                <select class="custom-select" id="jabatan" name="jabatan" required="">
                                                    <option hidden id="jabatan" value="<?= (old('id_jabatan'))  ? old('id_jabatan') : $k['id_jabatan'] ?>"><?= $k['singkatan_jabatan'] . ' - ' . $k['jabatan']; ?></option>
                                                    <option value="1" <?= old('jabatan') == '1' ? 'selected' : ''; ?>>MNG - Manager</option>
                                                    <option value="2" <?= old('jabatan') == '2' ? 'selected' : ''; ?>>ADM - Administrasi</option>
                                                    <option value="3" <?= old('jabatan') == '3' ? 'selected' : ''; ?>>DRV - Driver</option>
                                                    <option value="4" <?= old('jabatan') == '4' ? 'selected' : ''; ?>>RSP - Resepsionis</option>
                                                    <option value="5" <?= old('jabatan') == '5' ? 'selected' : ''; ?>>MKT - Marketing</option>
                                                    <option value="6" <?= old('jabatan') == '6' ? 'selected' : ''; ?>>OPR - Operator</option>
                                                    <option value="7" <?= old('jabatan') == '7' ? 'selected' : ''; ?>>GDG - Gudang</option>
                                                    <option value="8" <?= old('jabatan') == '8' ? 'selected' : ''; ?>>SCT - Security</option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Harap Masukkan Jabatan.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="status" class="col-sm-2 col-form-label">Status<span class="text-danger">*</span></label>
                                        <div class="col-sm-10">
                                            <div class="input-group">
                                                <select class="custom-select" id="status" name="status" required="">
                                                    <option hidden id="status" value="<?= (old('id_status'))  ? old('id_status') : $k['id_status'] ?>"><?= $k['status']; ?></option>
                                                    <option value="1" <?= old('status') == '1' ? 'selected' : ''; ?>>Karyawan Tetap</option>
                                                    <option value="2" <?= old('status') == '2' ? 'selected' : ''; ?>>Karyawan Kontrak</option>
                                                    <div class="invalid-feedback">
                                                        Harap Masukkan Status.
                                                    </div>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="foto" class="col-sm-2 col-form-label">Foto<span class="text-danger">*</span></label>
                                        <div class="col-sm-2">
                                            <img src="/profile/<?= (old('foto'))  ? old('foto') : $k['foto'] ?>" id="imageResult" class="img-fluid rounded shadow-sm mx-auto d-block">
                                        </div>
                                        <div class=" col-sm-8">
                                            <div class="input-group mb-3">
                                                <input id="upload" type="file" onchange="readURL(this);" class="form-control border-0 <?= ($validation->hasError('foto')) ? 'is-invalid' : ''; ?>" id="foto" name="foto">
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('foto'); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div style="text-align: center;">
                                        <button type="submit" class="btn btn-primary"><i class="mdi mdi-pencil">Ubah Data</i></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" name="ubah" data-bs-dismiss="modal"> <i class="mdi mdi-close"> Tutup</i></button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<?php foreach ($karyawan as $k) : $no++; ?>
    <div class="modal fade" id="detailModal<?= $k['slug']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="ubahModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog" style="width: 73%;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ubahModalLabel">Detail Data Karyawan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="mdi mdi-close"></i></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col">
                                <div class="card mb-3" style="max-width: 1000px;">
                                    <div class="row g-0">
                                        <div class="col-md-4">
                                            <img src="<?= base_url(); ?>/profile/<?= $k['foto']; ?>" class="img-fluid rounded-start" alt="..." style="width: 300pt; height: 300pt; border-bottom-left-radius: 20%; border-top-right-radius: 20%;">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body">

                                                <h5 class="card-title"><b>NIK &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </b><?= $k['nik']; ?></h5>
                                                <p class="card-text"><b>Nama &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </b><?= $k['nama']; ?></p>
                                                <p class="card-text"><b>Tempat Lahir &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </b><?= $k['tempat_lahir']; ?>, <?= $k['tanggal_lahir']; ?></p>
                                                <p class="card-text"><b>Jenis Kelamin &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </b><?= $k['jenis_kelamin']; ?></p>
                                                <p class="card-text"><b>Agama &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </b><?= $k['agama']; ?></p>
                                                <p class="card-text"><b>Alamat &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </b><?= $k['alamat']; ?></p>
                                                <p class="card-text"><b>No Telp &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </b><?= $k['no_telp']; ?></p>
                                                <p class="card-text"><b>Email &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </b><?= $k['email']; ?></p>
                                                <p class="card-text"><b>Jabatan &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </b><?= $k['jabatan']; ?></p>
                                                <p class="card-text"><b>Status &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </b><?= $k['status']; ?></p>
                                                <br><br>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>


<?= $this->endSection(); ?>
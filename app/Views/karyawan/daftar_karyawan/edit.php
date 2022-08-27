<?= $this->extend('/templates/index'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid">
    <br><br>
    <div class="row">
        <div class="col">
            <form action="<?= base_url(); ?>/<?= $k['id']; ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
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
                        <input type="text" class="form-control" id="nama" name="nama" value="<?= (old('nama'))  ? old('nama') : $k['nama'] ?>" placeholder="Masukkan Nama.." required="" autofocus>
                        <div class="invalid-feedback">
                            Harap Masukkan Nama.
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="tempat_lahir" class="col-sm-2 col-form-label">Tempat Lahir<span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="<?= (old('tempat_lahir'))  ? old('tempat_lahir') : $k['tempat_lahir'] ?>" placeholder="Masukkan Tempat Lahir.." required="">
                        <div class="invalid-feedback">
                            Harap Masukkan Tempat Lahir.
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="tanggal_lahir" class="col-sm-2 col-form-label">Tanggal Lahir<span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="<?= (old('tanggal_lahir'))  ? old('tanggal_lahir') : $k['tanggal_lahir'] ?>" placeholder="Masukkan Tanggal Lahir.." required="">
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
                                <option hidden value="<?= (old('jenis_kelamin'))  ? old('jenis_kelamin') : $k['jenis_kelamin'] ?>"><?= (old('jenis_kelamin'))  ? old('jenis_kelamin') : $k['jenis_kelamin'] ?></option>
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
                                <option hidden value="<?= (old('agama'))  ? old('agama') : $k['agama'] ?>"><?= (old('agama'))  ? old('agama') : $k['agama'] ?></option>
                                <option value="Islam" <?= old('agama') == 'Islam' ? 'selected' : ''; ?>>Islam</option>
                                <option value="Kristen" <?= old('agama') == 'Kristen' ? 'selected' : ''; ?>>Kristen</option>
                                <option value="Katholik" <?= old('agama') == 'Katholik' ? 'selected' : ''; ?>>Katholik</option>
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
                        <textarea class="form-control" id="alamat" name="alamat" rows="3" required=""><?= (old('alamat'))  ? old('alamat') : $k['alamat'] ?></textarea>
                        <div class="invalid-feedback">
                            Harap Masukkan Alamat.
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="no_telp" class="col-sm-2 col-form-label">Kontak<span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="no_telp" name="no_telp" value="<?= (old('no_telp'))  ? old('no_telp') : $k['no_telp'] ?>" placeholder="Masukkan Kontak.." required="">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="email" class="col-sm-2 col-form-label">Email<span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="email" name="email" value="<?= (old('email'))  ? old('email') : $k['email'] ?>" placeholder="Masukkan Email.." required="">
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
                                <option hidden value="<?= $k['id_jabatan'] ?>"><?= $k['singkatan_jabatan'] . ' - ' . $k['jabatan'] ?></option>
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
                                <option hidden value="<?= (old('id_status'))  ? old('id_status') : $k['id_status'] ?>"><?= (old('status'))  ? old('status') : $k['status'] ?></option>
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
                        <img src="/profile/<?= (old('foto'))  ? old('foto') : $k['foto'] ?>" class="img-thumbnail img-preview">
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
                <button type="submit" class="btn btn-primary float-right"><i class="mdi mdi-pencil">Ubah Data</i></button>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>
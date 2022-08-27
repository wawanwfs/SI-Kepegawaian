<?= $this->extend('/templates/index'); ?>
<?= $this->section('content') ?>
<?= $this->include('templates/script'); ?>
<section class="section">
    <div class="section-header">
        <h1>Reset Password</h1>
    </div>

    <div class="section-body">
        <div class="col-12 mb-4">
        </div>
    </div>
    <script src="<?= base_url() ?>/template/node_modules/jquery/dist/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <?= form_open('user/updatepassword', ['class' => 'frmupdatepassword']) ?>
    <div class="form-group row">
        <label for="" class="col-sm-2 col-form-label">Password Lama</label>
        <div class="col-sm-4">
            <input autocomplete="off" type="password" class="form-control" name="passlama" id="passlama">
            <div id="msg-passlama" class="invalid-feedback">

            </div>
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-2 col-form-label">Password Baru</label>
        <div class="col-sm-4">
            <input autocomplete="off" type="password" class="form-control" name="passbaru" id="passbaru">
            <div id="msg-passbaru" class="invalid-feedback">

            </div>
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-2 col-form-label">Confirm Password Baru</label>
        <div class="col-sm-4">
            <input autocomplete="off" type="password" class="form-control" name="confirmpass" id="confirmpass">
            <div id="msg-confirmpass" class="invalid-feedback">

            </div>
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-2 col-form-label"></label>
        <div class="col-sm-4">
            <button type="submit" class="btn btn-success btnsimpan">
                Ganti Password
            </button>
        </div>
    </div>
    <?= form_close(); ?>
    <script>
        $(document).ready(function() {
            $('.frmupdatepassword').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    type: "post",
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    dataType: "json",
                    cache: false,
                    beforeSend: function() {
                        $('.btnsimpan').prop('disabled', true);
                        $('.btnsimpan').html('<i class="fa fa-spin fa-spinner"></i>');
                    },
                    complete: function() {
                        $('.btnsimpan').prop('disabled', false);
                        $('.btnsimpan').html('Ganti Password');
                    },
                    success: function(response) {
                        if (response.error) {
                            let err = response.error;
                            if (err.passlama) {
                                $('#passlama').addClass('is-invalid');
                                $('#msg-passlama').html(err.passlama);
                            } else {
                                $('#passlama').removeClass('is-invalid');
                                $('#passlama').addClass('is-valid');
                                $('#msg-passlama').html('');
                            }

                            if (err.passbaru) {
                                $('#passbaru').addClass('is-invalid');
                                $('#msg-passbaru').html(err.passbaru);
                            } else {
                                $('#passbaru').removeClass('is-invalid');
                                $('#passbaru').addClass('is-valid');
                                $('#msg-passbaru').html('');
                            }

                            if (err.confirmpass) {
                                $('#confirmpass').addClass('is-invalid');
                                $('#msg-confirmpass').html(err.confirmpass);
                            } else {
                                $('#confirmpass').removeClass('is-invalid');
                                $('#confirmpass').addClass('is-valid');
                                $('#msg-confirmpass').html('');
                            }

                        } else {
                            Swal.fire({
                                icon: 'success',
                                title: 'Ganti Password',
                                text: response.sukses
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location = '/login/logout';
                                }
                            });
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + '\n' + thrownError);
                    }
                });
                return false;
            });
        });
    </script>
</section>
<?= $this->endSection() ?>
<?= $this->extend('main/layout') ?>

<?= $this->section('title') ?>
Manajemen User
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="section">
    <div class="section-header">
        <h1>Riwayat Penempatan Pegawai</h1>
        <div class="section-header-button">
            <button type="button" class="btn btn-sm btn-primary btntambah">
                <i class="fa fa-plus"></i> Tambah User Baru
            </button>
        </div>
    </div>
    <!-- DataTables  & Plugins-->
    <script src="<?= base_url() ?>/template/node_modules/jquery/dist/jquery.min.js"></script>
    <script src="<?= base_url() ?>/template/node_modules/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="<?= base_url() ?>/template/node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?= base_url() ?>/template/node_modules/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?= base_url() ?>/template/node_modules/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
    <div class="section-body">

        <div class="card">
            <div class="card-header">
                <h4>Data Riwayat Penempatan Pegawai</h4>
            </div>
            <table class="table table-sm table-bordered" id="datauser" style="width: 100%;">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID User</th>
                        <th>Nama User</th>
                        <th>Level</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
            <div class="viewmodal" style="display: none;"></div>
            <script>
                $(document).ready(function() {
                    $('.btntambah').click(function(e) {
                        e.preventDefault();
                        $.ajax({
                            dataType: 'application/json',
                            url: 'users/formtambah',
                            success: function(response) {
                                $('.viewmodal').html(response).show();
                                $('#modaltambah').on('shown.bs.modal', function(event) {
                                    $('#iduser').focus();
                                })
                                $('#modaltambah').modal('show');
                            }
                        });
                    });

                    let dataUser = $('#datauser').DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: '/users/listData',
                        order: [],
                        columns: [{
                                data: 'nomor',
                                width: 10
                            },
                            {
                                data: 'userid'
                            },
                            {
                                data: 'username'
                            },
                            {
                                data: 'levelnama'
                            },
                            {
                                data: 'status',
                                orderable: false,
                                width: 25
                            },
                            {
                                data: 'aksi',
                                orderable: false,
                                width: 20
                            },
                        ]
                    });
                });

                function view(userid) {
                    $.ajax({
                        type: "post",
                        url: "/users/formedit",
                        data: {
                            userid: userid
                        },
                        success: function(response) {
                            $('.viewmodal').html(response).show();
                            $('#modaledit').on('shown.bs.modal', function(event) {
                                $('#namalengkap').focus();
                            })
                            $('#modaledit').modal('show');
                        }
                    });
                }
            </script>
        </div>
    </div>
</section>
<?= $this->endSection() ?>
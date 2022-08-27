    <!-- plugins:js -->
    <script src="<?= base_url(); ?>/assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="<?= base_url(); ?>/assets/vendors/chart.js/Chart.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="<?= base_url(); ?>/assets/js/off-canvas.js"></script>
    <script src="<?= base_url(); ?>/assets/js/hoverable-collapse.js"></script>
    <script src="<?= base_url(); ?>/assets/js/misc.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="<?= base_url(); ?>/assets/js/dashboard.js"></script>
    <script src="<?= base_url(); ?>/assets/js/todolist.js"></script>
    <!-- End custom js for this page -->

    <script>
        const sampul = document.querySelector('#foto');
        const imgPreview = document.querySelector('.img-preview');

        sampul.addEventListener('change', function() {
            const file = this.files[0];
            const reader = new FileReader();

            reader.addEventListener('load', function() {
                imgPreview.setAttribute('src', reader.result);
            });

            reader.readAsDataURL(file);
        });
    </script>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>


    <script type="text/javascript">
        function printDiv() {
            var divToPrint = document.getElementById('divToPrint');
            var popupWin = window.open('', '_blank', 'width=300,height=300');
            popupWin.document.open();
            popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
            popupWin.document.close();
        }
    </script>


    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#imageResult')
                        .attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        $(function() {
            $('#upload').on('change', function() {
                readURL(input);
            });
        });
    </script>


    <script type="text/javascript">
        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        }
    </script>


    <!-- cetak tabel ber id printDiv tanpa buttom -->
    <script type="text/javascript">
        function printDiv() {
            var divToPrint = document.getElementById('printTable');
            var popupWin = window.open('', '_blank', 'width=300,height=300');
            popupWin.document.open();
            popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
            popupWin.document.close();
        }
    </script>

    <?php if ($title == 'Management User') : ?>
        <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
        <script>
            $(document).ready(function() {
                $('.btntambah').click(function(e) {
                    e.preventDefault();
                    $.ajax({
                        type: "get",
                        url: "users/formtambah",
                        success: function(response) {
                            $('.viewmodal').html(response).show();
                            $('#modaltambah').on('shown.bs.modal', function(event) {
                                $('#iduser').focus();
                            })
                            $('#modaltambah').modal('show');
                        }
                    });
                });

                dataUser = $('#datauser').DataTable({
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
    <?php endif; ?>
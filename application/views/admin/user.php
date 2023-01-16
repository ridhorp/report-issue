<link rel="stylesheet" href="<?php echo base_url() . 'aset/' ?>vendor/datatables.net-bs4/dataTables.bootstrap4.css">
<link rel="stylesheet" href="<?php echo base_url() . 'aset/' ?>vendor/datatables.net/responsive.bootstrap4.min.css">

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col lg-8">

            <?= form_error('admin/user', '<div class="alert alert-danger" role="alert">', '</div>') ?>

            <?= $this->session->flashdata('message'); ?>

            <a href="<?= base_url('user/add_user'); ?>" class="btn btn-primary mb-3">Add User</a>

            <div class="table-responsive">
                <table class="table table-striped dt -responsive nowrap" width="100%" id="table-error">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Username</th>
                            <th scope="col">Email</th>
                            <th scope="col">Divisi</th>
                            <th scope="col">Role id</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>



</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->


<!-- Modal -->


<!-- Bootstrap core JavaScript-->
<script src="<?= base_url('aset/'); ?>vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url('aset/'); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="<?php echo base_url() . 'aset/' ?>vendor/datatables.net/jquery.dataTables.js"></script>
<script src="<?php echo base_url() . 'aset/' ?>vendor/datatables.net/responsive.bootstrap4.min.js"></script>
<script src="<?php echo base_url() . 'aset/' ?>vendor/datatables.net/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url() . 'aset/' ?>vendor/datatables.net-bs4/dataTables.bootstrap4.js"></script>
<!-- DATATABLES BS 4-->
<!-- <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.7/js/responsive.bootstrap4.min.js"></script> -->
<script>
    var dataTable = $('#table-error').DataTable({
        "serverSide": true,
        "stateSave": false,
        "bAutoWidth": true,
        "aaSorting": [
            [0, "desc"]
        ],
        "columnDefs": [{
            "targets": 'no-sort',
            "orderable": false,
        }],
        "iDisplaylength": 10,
        "aLengthMenu": [
            [10, 15, 20],
            [10, 15, 20]
        ],
        "ajax": {
            url: "<?= site_url('user/list_user'); ?>",
            type: "post",
            data: {
                tanggal_awal: '',
                tanggal_akhir: ''

            },
            error: function() {
                $(".my-table-error").html("");
                $("#table-error").append('<tbody class="my-table-error"><tr><th colspan="3">No data found in the server</th></tr></tbody');
                $("#table-error").css("display", "none");
            }
        }
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $("#error_form").submit(function(event) {

            event.preventDefault();

        });
    });
</script>
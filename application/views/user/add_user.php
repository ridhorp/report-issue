<link rel="stylesheet" href="<?php echo base_url() . 'aset/' ?>vendor/datatables.net-bs4/dataTables.bootstrap4.css">
<link rel="stylesheet" href="<?php echo base_url() . 'aset/' ?>vendor/datatables.net/responsive.bootstrap4.min.css">

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col lg-8">

            <?= form_error('add_user', '<div class="alert alert-danger" role="alert">', '</div>') ?>

            <?= $this->session->flashdata('message'); ?>

            <a href="#" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newUserModal">Add User</a>

            <div class="table-responsive">
                <table class="table table-striped dt -responsive nowrap" width="100%" id="table-error">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Divisi</th>
                            <th scope="col">Role</th>
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
<div class="modal fade" id="newUserModal" tabindex="-1" role="dialog" aria-labelledby="newUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('user/add_user'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Add user name">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="email" name="email" placeholder="Add email">
                    </div>
                    <div class="form-group">
                        <select name="divisi" id="divisi" class="form-control">
                            <option value="">Divisi</option>
                            <option value="Graha">Graha</option>
                            <option value="CG Digital">CG Digital</option>
                            <option value="Marketing Galuh">Marketing Galuh</option>
                            <option value="Purwakarta">Purwakarta</option>
                            <option value="Cianjur">Cianjur</option>
                            <option value="Online">Online</option>
                        </select>
                    </div>
                    <div class=" form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <input type="password" class="form-control form-control-user" id="password1" name="password1" placeholder="Password">
                            <?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="col-sm-6">
                            <input type="password" class="form-control form-control-user" id="password2" name="password2" placeholder="Repeat Password">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

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
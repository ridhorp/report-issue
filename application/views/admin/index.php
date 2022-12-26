<link rel="stylesheet" href="<?php echo base_url() . 'aset/' ?>vendor/datatables.net-bs4/dataTables.bootstrap4.css">

<link rel="stylesheet" href="<?php echo base_url() . 'aset/' ?>vendor/datatables.net/responsive.bootstrap4.min.css">

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-10">
            <?php if (validation_errors()) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php endif; ?>
            <?= form_error('dashboard', '<div class="alert alert-danger" role="alert">', '</div>') ?>

            <?= $this->session->flashdata('message'); ?>

            <a href="#" class="btn btn-primary mb-3" data-toggle="modal" data-target="#ErrorModal">Add Error</a>

            <div class="table-responsive">
                <table class="table table-striped dt-responsive nowrap" width="100%" id="table-error">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Entry Date</th>
                            <th scope="col">Divisi</th>
                            <th scope="col">Costumer name</th>
                            <th scope="col">Code product</th>
                            <th scope="col">Material Quantity</th>
                            <th scope="col">Material Loss</th>
                            <th scope="col">Service Loss</th>
                            <th scope="col">Error category</th>
                            <th scope="col">Error type</th>
                            <th scope="col">Description</th>
                            <th scope="col">Reason</th>
                            <th scope="col">Solution</th>
                            <th scope="col">PIC</th>
                            <th scope="col">problem_solve</th>
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
<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="ErrorModal" tabindex="-1" role="dialog" aria-labelledby="ErrorModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newSubModalLabel"> Log Error</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/index'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <h5><?= date('l, d F Y'); ?></h5>
                    </div>
                    <div class="form-group">
                        <input type="date" class="form-control" id="date" name="date" placeholder="Enter Date">
                    </div>
                    <div class="form-group">
                        <select name="menu_id" id="menu_id" class="form-control">
                            <option value="">Divisi</option>
                            <option value="">Graha</option>
                            <option value="">CG Digital</option>
                            <option value="">Marketing Galuh</option>
                            <option value="">Purwakarta</option>
                            <option value="">Cianjur</option>
                            <option value="">Online</option>

                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="costumer" name="costumer" placeholder="Costumer name">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="product" name="product" placeholder="Code Producut">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="quantity" name="quantity" placeholder="Material Quantity">

                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="material" name="material" placeholder="Material loss">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="service" name="service" placeholder="Service loss">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="category" name="category" placeholder="Error category">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="type" name="type" placeholder="Error type">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="description" name="description" placeholder="Description">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="reason" name="reason" placeholder="Reason">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="solution" name="solution" placeholder="Solution">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="PIC" name="PIC" placeholder="PIC">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="solve" name="solve" placeholder="Problem Solve">
                    </div>
                    <!-- <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" name="is_active" id="is_active" checked>
                            <label class="form-check-label" for="is_active">
                                Active Account
                            </label>
                        </div>
                    </div> -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="<?php echo base_url() . 'aset/' ?>vendor/datatables.net/jquery.dataTables.js"></script>
<script src="<?php echo base_url() . 'aset/' ?>vendor/datatables.net/responsive.bootstrap4.min.js"></script>
<script src="<?php echo base_url() . 'aset/' ?>vendor/datatables.net/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url() . 'aset/' ?>vendor/datatables.net-bs4/dataTables.bootstrap4.js"></script>

<script>
    $('#table-error').DataTable({
        "serverSide": true,
        "stateSave": false,
        "bAutoWidth": true,
        "aaSorting": [
            [0, "desc"]
        ],
        "columnDefs": [{
                "targets": 'no-sort',
                "orderable": false,
            },
            {
                targets: [5],
                class: "wrapok"
            }
        ],
        "iDisplaylength": 10,
        "aLengthMenu": [
            [5, 10, 15, 20],
            [5, 10, 15, 20]
        ],
        "ajax": {
            url: "<?= site_url('admin/list_error'); ?>",
            type: "post",
            data: {
                tanggal_awal: '',
                tanggal_akhir: '',
                // cs: cs,
                divisi: '<?= $divisi; ?>',
                // job_divisi: job_divisi,
                // status_job: status_job,
                // period: period,
            },
            error: function() {
                $(".my-table-error").html("");
                $("#table-error").append('<tbody class="my-table-error"><tr><th colspan="3">No data found in the server</th></tr></tbody');
                $("#table-error").css("display", "none");
            }
        }

    });
</script>
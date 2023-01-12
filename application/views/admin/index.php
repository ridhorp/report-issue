<link rel="stylesheet" href="<?php echo base_url() . 'aset/' ?>vendor/datatables.net-bs4/dataTables.bootstrap4.css">
<link rel="stylesheet" href="<?php echo base_url() . 'aset/' ?>vendor/datatables.net/responsive.bootstrap4.min.css">

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col lg-12">

            <?= form_error('index', '<div class="alert alert-danger" role="alert">', '</div>') ?>

            <?= $this->session->flashdata('message'); ?>

            <a href="<?= base_url("admin/input_error"); ?>" class="btn btn-primary mb-3">Add Error</a>
            <!-- <a href="<?= base_url("Admin/excel"); ?>" class="btn btn-success mb-3 fad fa-download">Download</a> -->

            <div class="table-responsive">
                <table class="table table-striped dt-responsive nowrap" width="100%" id="table-error">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Entry Date</th>
                            <!-- <th scope="col">Divisi</th> -->
                            <th scope="col">Customer name</th>
                            <th scope="col">Code product</th>
                            <!-- <th scope="col">Material Quantity</th> -->
                            <!-- <th scope="col">Material Loss</th> -->
                            <!-- <th scope="col">Service Loss</th> -->
                            <th scope="col">Error category</th>
                            <th scope="col">Error type</th>
                            <!-- <th scope="col">Description</th> -->
                            <!-- <th scope="col">Reason</th> -->
                            <!-- <th scope="col">Solution</th> -->
                            <!-- <th scope="col">PIC</th> -->
                            <!-- <th scope="col">Problem solve</th> -->
                            <th scope="row">Action</th>
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



<!-- Bootstrap core JavaScript-->
<script src="<?= base_url('aset/'); ?>vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url('aset/'); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="<?php echo base_url() . 'aset/' ?>vendor/datatables.net/jquery.dataTables.js"></script>
<script src="<?php echo base_url() . 'aset/' ?>vendor/datatables.net/responsive.bootstrap4.min.js"></script>
<script src="<?php echo base_url() . 'aset/' ?>vendor/datatables.net/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url() . 'aset/' ?>vendor/datatables.net-bs4/dataTables.bootstrap4.js"></script>
<!-- DATATABLES BS 4-->
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.7/js/responsive.bootstrap4.min.js"></script>
<!-- 
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.colVis.min.js"></script> -->


<script>
    $(document).ready(function() {
    var table = $('#table-error').DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax"      :"dashboard.php",
        dom : 'Bfrtip',
        buttons : [
            {
                extend : 'pdf',
                oriented : 'potrait',
                pageSize : 'legal',
                title : 'log error',
                download : 'open'
            },
            'excel', 'print', 'copy'
        ],

        columnDefs : [
            {
                "searchable" : false,
                "orderable" : false,
                "targets" : 5,
                "render" : function(data, type, row) {
                    var btn = "<center><a href>"
                }
            }
        ];
    } );

    table.buttons().container()
        .appendTo( '#example_wrapper .col-md-6:eq(0)' );
} );
</script>
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
            url: "<?= site_url('admin/list_error_admin'); ?>",
            type: "post",
            data: {
                tanggal_awal: '',
                tanggal_akhir: '',
                divisi: '<?= $divisi; ?>'
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

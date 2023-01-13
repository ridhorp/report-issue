<link rel="stylesheet" href="<?php echo base_url() . 'aset/' ?>vendor/datatables.net-bs4/dataTables.bootstrap4.css">
<link rel="stylesheet" href="<?php echo base_url() . 'aset/' ?>vendor/datatables.net/responsive.bootstrap4.min.css">

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col lg-12">

            <a href="<?= base_url("admin/input_error"); ?>" class="btn btn-primary mb-3">Add Error</a>

            <div class="table-responsive">
                <table class="table table-striped dt-responsive nowrap" width="100%" id="table-error">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Entry Date</th>
                            <th scope="col">Customer name</th>
                            <th scope="col">Code product</th>
                            <th scope="col">Error category</th>
                            <th scope="col">Error type</th>
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
<!-- Modal validation -->

<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="deleteModalLabel">Validation</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <input type="hidden" id="errorid" name="id_error">
            Do you want to deleted this data?
        </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger" id="id-error" role="button">Delete</a>
            </div>
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
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.7/js/responsive.bootstrap4.min.js"></script>

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

<script>
    $(document).on("click", "#delete-error", function(){
    console.log('test')

        $('#deleteModal').modal('show'); 
        let idError = $(this).attr("data-id")
        $("#errorid").val(idError);
    });

    function deleteError(id){
        $.ajax ({
            url: "<?= site_url('Admin/deleteerror/'); ?>",
            type: "post",
            data: {
                id : id,
            },
            success : function(json){
                console.log(json);
                location.reload();
            }
        }); 
    }

    $(document).on("click", "#id-error", function(){
        
        let idError = $('#errorid').val();
        console.log(idError);
    deleteError(idError);
    });
</script>

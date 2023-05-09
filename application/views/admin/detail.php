<!-- Custom styles for this page -->
<link rel="stylesheet" href="<?php echo base_url() . 'aset/' ?>vendor/datatables.net-bs4/dataTables.bootstrap4.css">
<link rel="stylesheet" href="<?php echo base_url() . 'aset/' ?>vendor/datatables.net/responsive.bootstrap4.min.css">

<div class="container-fluid">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-4">
                <section class="content">
                    <h4><strong><?= $title; ?></strong></h4>
                    <div class="table-responsive">
                        <table class="table table-striped dt-responsive nowrap" id="table-detail">
                            <tr>
                                <th>entry date </th>
                                <td><?= $detail->entry_date ?></td>
                            </tr>
                            <tr>
                                <th>customer name </th>
                                <td><?= $detail->customer ?></td>
                            </tr>
                            <!-- <tr>
                            <th>divisi    </th>
                            <td><?= $detail->divisi ?></td>
                        </tr> -->
                            <tr>
                                <th>code product </th>
                                <td><?= $detail->product ?></td>
                            </tr>
                            <tr>
                                <th>error category </th>
                                <td><?= $detail->error_category ?></td>
                            </tr>
                            <tr>
                                <th>error type </th>
                                <td><?= $detail->error_type ?></td>
                            </tr>
                            <tr>
                                <th>material qty </th>
                                <td><?= $detail->material_quantity ?></td>
                            </tr>
                            <tr>
                                <th>description </th>
                                <td><?= $detail->description ?></td>
                            </tr>
                            <tr>
                                <th>reason </th>
                                <td><?= $detail->reason ?></td>
                            </tr>
                            <tr>
                                <th>PIC </th>
                                <td><?= $detail->pic ?></td>
                            </tr>
                            <tr>
                                <th>solution </th>
                                <td><?= $detail->solution ?></td>
                            </tr>
                            <tr>
                                <th>porblem solve </th>
                                <td><?= $detail->problem_solve ?></td>
                            </tr>
                        </table>
                    </div>
                </section>
                <div class="modal-footer">
                    <a class="btn btn-secondary" href="<?= base_url('dashboard') ?>" role="button">Close</a>
                </div>
            </div>
        </div>
    </div>
</div>


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
    var dataTable = $('#table-detail').DataTable({
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
            url: "<?= site_url('admin/list_error'); ?>",
            type: "post",
            data: {
                tanggal_awal: '',
                tanggal_akhir: '',
                divisi: '<?= $divisi; ?>'
            },
            error: function() {
                $(".my-table-detail").html("");
                $("#table-detail").append('<tbody class="my-table-detail"><tr><th colspan="3">No data found in the server</th></tr></tbody');
                $("#table-detail").css("display", "none");
            }
        }
    });
</script>
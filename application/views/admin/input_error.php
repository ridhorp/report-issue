<div class="container-fluid">
    <div class="container">
        <form action="<?= base_url('admin/input_error'); ?>" method="post" id="error_form">
            <div class="body">
                <div class="form-group">
                    <h5><?= date('l, d F Y'); ?></h5>
                </div>
                <a href="<?= base_url("admin/input_error")  ?>" class="btn btn-primary mb-3">Add Error</a>
                <?= validation_errors('<div class="alert alert-danger" role="alert">', '</div>'); ?>
                <!-- <?= $this->session->flashdata('message'); ?> -->
                <div class="form-group">
                    <input type="date" class="form-control" id="date" name="entry_date" placeholder="Enter Date" autocomplete="off">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="customer" name="customer" placeholder="Customer name" autocomplete="off">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="product" name="product" placeholder="Code Producut" autocomplete="off">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="quantity" name="material_quantity" placeholder="Material Quantity" autocomplete="off">

                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="material" name="material_loss" placeholder="Material loss" autocomplete="off">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="service" name="service_loss" placeholder="Service loss" autocomplete="off">
                </div>
                <div class="form-group">
                    <select name="error_category" id="error_category" class="form-control">
                        <option value=""> Error Category</option>
                        <option value="Machine error"> Machine error</option>
                        <option value="Human error"> Human error</option>
                    </select>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="type" name="error_type" placeholder="Error type" autocomplete="off">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="description" name="description" placeholder="Description" autocomplete="off">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="reason" name="reason" placeholder="Reason" autocomplete="off">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="solution" name="solution" placeholder="Solution" autocomplete="off">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="PIC" name="pic" placeholder="PIC" autocomplete="off">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="solve" name="problem_solve" placeholder="Problem Solve" autocomplete="off">
                </div>
            </div>
            <form action="<?= base_url('admin'); ?>" method="post">
                <div class="modal-footer">
                    <a class="btn btn-secondary" href="<?= base_url('admin/index') ?>" role="button">Close</a>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
    </div>
</div>
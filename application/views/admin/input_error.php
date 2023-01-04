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
                    <input type="date" class="form-control" id="date" name="entry_date" placeholder="Enter Date">
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
                <div class="form-group">
                    <input type="text" class="form-control" id="customer" name="customer" placeholder="Customer name">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="product" name="product" placeholder="Code Producut">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="quantity" name="material_quantity" placeholder="Material Quantity">

                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="material" name="material_loss" placeholder="Material loss">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="service" name="service_loss" placeholder="Service loss">
                </div>
                <div class="form-group">
                    <select name="error_category" id="error_category" class="form-control">
                        <option value=""> Error Category</option>
                        <option value="Machine error"> Machine error</option>
                        <option value="Human error"> Human error</option>
                    </select>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="type" name="error_type" placeholder="Error type">
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
                    <input type="text" class="form-control" id="PIC" name="pic" placeholder="PIC">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="solve" name="problem_solve" placeholder="Problem Solve">
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
            <form action="<?= base_url('admin'); ?>" method="post">
                <div class="modal-footer">
                    <a class="btn btn-secondary" href="<?= base_url('admin/index') ?>" role="button">Close</a>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
    </div>
</div>
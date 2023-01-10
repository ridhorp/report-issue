<div class="container-fluid">
    <div class="container">
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
        <form action="<?= base_url('Admin/editing_error'); ?>" method="post" id="error_form">
            <div class="body">
            <input type="hidden" name="id" id="id"value="<?= $detailid['id']; ?>">
                <div class="form-group">
                    <input type="date" class="form-control" id="date" value="<?= $detailid['entry_date']; ?>" name="entry_date" placeholder="Enter Date" autocomplete="off">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="customer" value="<?= $detailid['customer']; ?>"name="customer" placeholder="Customer name" autocomplete="off">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="product" value="<?= $detailid['product']; ?>" name="product" placeholder="Code Producut" autocomplete="off">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="quantity" value="<?= $detailid['material_quantity']; ?>" name="material_quantity" placeholder="Material Quantity" autocomplete="off">

                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="material" value="<?= $detailid['material_loss']; ?>" name="material_loss" placeholder="Material loss" autocomplete="off">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="service" value="<?= $detailid['service_loss']; ?>" name="service_loss" placeholder="Service loss" autocomplete="off">
                </div>
                <div class="form-group">
                    <select name="error_category" id="error_category" value="<?= $detailid['error_category']; ?>" class="form-control">
                        <option value=""> Error Category</option>
                        <option value="Machine error"> Machine error</option>
                        <option value="Human error"> Human error</option>
                    </select>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="type" value="<?= $detailid['error_type']; ?>" name="error_type" placeholder="Error type" autocomplete="off">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="description" value="<?= $detailid['description']; ?>" name="description" placeholder="Description" autocomplete="off">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="reason" value="<?= $detailid['reason']; ?>" name="reason" placeholder="Reason" autocomplete="off">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="solution" value="<?= $detailid['solution']; ?>" name="solution" placeholder="Solution" autocomplete="off">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="PIC" value="<?= $detailid['pic']; ?>" name="pic" placeholder="PIC" autocomplete="off">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="solve" value="<?= $detailid['problem_solve']; ?>" name="problem_solve" placeholder="Problem Solve" autocomplete="off">
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
                <a class="btn btn-secondary" href="<?= base_url('admin/index') ?>" role="button">Close</a>
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
            </form>
    </div>
</div>

<div class="container-fluid">
    <div class="container">
        <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
            <form action="<?= base_url('menu/submenu'); ?>" method="post">
            <div class="body">
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <input type="text" class="form-control" id="title" name="title" placeholder="Add new sub menu...">
                    </div>
                    <div class="form-group">
                        <select name="menu_id" id="menu_id" class="form-control">
                            <option value="">Select Menu</option>
                            <?php foreach ($menu as $m) : ?>
                                <option value="<?= $m['id']; ?>"><?= $m['menu']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="url" name="url" placeholder="Add new sub menu Url...">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="icon" name="icon" placeholder="Add new sub menu Icon...">
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" name="is_active" id="is_active" checked>
                            <label class="form-check-label" for="is_active">
                                Active Account
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                <a class="btn btn-secondary" href="<?= base_url('menu/submenu') ?>" role="button">Close</a>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
        </form>
    </div>
</div>
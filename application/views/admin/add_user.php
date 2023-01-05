
<div class="container-fluid">
    <div class="container">
        <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
            <form action="<?= base_url('admin/user'); ?>" method="post" id="form_usser">
                <div class="body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Add user name">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="email" name="email" placeholder="Add email">
                    </div>
                    <div class="form-group">
                        <select name="divisi" id="divisi" class="form-control">
                            <option value="">Divisi</option>
                            <?php foreach ($list_divisi as $row) : ?>
                                <option value="<?= $row->id;?>"><?= $row->name;?></option>
                            <?php endforeach; ?>
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
                    <a class="btn btn-secondary" href="<?= base_url('admin/index') ?>" role="button">Close</a>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
    </div>
</div>
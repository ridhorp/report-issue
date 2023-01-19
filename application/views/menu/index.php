<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-6">

            <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>') ?>

            <!-- <?= $this->session->flashdata('message'); ?> -->

            <a href="#" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newMenuModal">Add New Menu</a>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">Menu</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($menu as $m) : ?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>
                            <td><?= $m['menu']; ?></td>
                            <td>
                                <!-- <a href="#" class="badge badge-success">Edit</a> -->
                                <a href="<?= base_url('Menu/deleteMenu/') . $m['id']; ?>" class="badge badge-danger" data-toggle='modal' data-target='#deleteMenuModal'>Delete</a>
                            </td>
                        </tr>
                        <?php $i++ ?>
                    <?php endforeach ?>
                </tbody>
            </table>

        </div>
    </div>



</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Delete Modal -->
<div class="modal fade" id="deleteMenuModal" tabindex="-1" aria-labelledby="deleteMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="deleteModalLabel">Validation</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <input type="hidden" id="id_menu" name="id_menu">
            Do you want to deleted this menu?
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <a class="btn btn-danger" href="<?= base_url('Menu/deleteMenu/'). $m['id'];?>" role="button">Delete</a>
        </div>
        </div>
    </div>
</div>
<!-- Button trigger modal -->


<!-- Add Modal -->
<div class="modal fade" id="newMenuModal" tabindex="-1" role="dialog" aria-labelledby="newMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> New Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('menu'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="menu" name="menu" placeholder="Add new menu name...">
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
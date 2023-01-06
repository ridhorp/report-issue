<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg">
            <?php if (validation_errors()) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php endif; ?>
            <?= form_error('menu/submenu', '<div class="alert alert-danger" role="alert">', '</div>') ?>

            <?= $this->session->flashdata('message'); ?>

            <a href="<?= base_url('menu/add_submenu'); ?>" class="btn btn-primary mb-3">Add sub menu</a>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Menu id</th>
                        <th scope="col">URL</th>
                        <th scope="col">Icon</th>
                        <th scope="col">Active</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($subMenu as $sm) : ?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>
                            <td><?= $sm['title']; ?></td>
                            <td><?= $sm['menu_id']; ?></td>
                            <td><?= $sm['url']; ?></td>
                            <td><?= $sm['icon']; ?></td>
                            <td><?= $sm['is_active']; ?></td>
                            <td>
                                <a href="<?= base_url('Menu/edit_submenu/') . $sm['id']; ?>" class="badge badge-success" data-id="<?= $sm['id']; ?>">Edit</a>
                                <a href="<?= base_url('Menu/deleteSubMenu/') . $sm['id']; ?>" class="badge badge-danger" onclick="return confirm('do you want to delete this menu?');">Delete</a>
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

<!-- Modal -->
<!-- Button trigger modal -->


<!-- Modal -->

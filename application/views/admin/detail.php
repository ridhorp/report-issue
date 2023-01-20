<div class="container-fluid">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-4">
                <section class="content">
                    <h4><strong><?= $title; ?></strong></h4>
                    <table class="table">
                        <tr>
                            <th>entry date     </th>
                            <td><?= $detail->entry_date ?></td>
                        </tr>
                        <tr>
                            <th>customer name    </th>
                            <td><?= $detail->customer ?></td>
                        </tr>
                        <!-- <tr>
                            <th>divisi    </th>
                            <td><?= $detail->divisi ?></td>
                        </tr> -->
                        <tr>
                            <th>code product     </th>
                            <td><?= $detail->product ?></td>
                        </tr>
                        <tr>
                            <th>error category     </th>
                            <td><?= $detail->error_category ?></td>
                        </tr>
                        <tr>
                            <th>error type    </th>
                            <td><?= $detail->error_type ?></td>
                        </tr>
                        <tr>
                            <th>material qty     </th>
                            <td><?= $detail->material_quantity ?></td>
                        </tr>
                        <tr>
                            <th>material loss    </th>
                            <td><?= $detail->material_loss ?></td>
                        </tr>
                        <tr>
                            <th>service loss     </th>
                            <td><?= $detail->service_loss ?></td>
                        </tr>
                        <tr>
                            <th>description      </th>
                            <td><?= $detail->description ?></td>
                        </tr>
                        <tr>
                            <th>reason           </th>
                            <td><?= $detail->reason ?></td>
                        </tr>
                        <tr>
                            <th>PIC              </th>
                            <td><?= $detail->pic ?></td>
                        </tr>
                        <tr>
                            <th>solution         </th>
                            <td><?= $detail->solution ?></td>
                        </tr>
                        <tr>
                            <th>porblem solve    </th>
                            <td><?= $detail->problem_solve ?></td>
                        </tr>
                    </table>
                </section>
                <div class="modal-footer">
                    <a class="btn btn-secondary" href="<?= base_url('dashboard') ?>" role="button">Close</a>
                </div>
            </div>
        </div>
    </div>
</div>
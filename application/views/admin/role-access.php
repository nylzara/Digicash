<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="bg-white border border-light shadow-sm p-2 rounded m-3">
        <div class="text-center font-weight-bold h3 mb-4 text-gray-800"><?= $title; ?></div>
    </div>


    <div class="bg-white border border-light shadow-sm p-4 rounded m-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">

                    <h5>Role : <?=  $role['role']; ?></h5>


                    <?= $this->session->flashdata('message'); 
                    ?>

                    <table class="table table-hover">
                        <thead style="background-color: gray; color: white;">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Menu</th>
                                <th scope="col">Access</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($menu as $m ) : ?>
                            <tr>
                                <th scope="row"><?= $i; ?></th>
                                <td><?= $m['menu']; ?></td>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox"
                                            <?= check_access($role['id'], $m['id']); ?> data-role="<?= $role['id'];?>"
                                            data-menu=" <?= $m['id'];?>">
                                    </div>
                                </td>
                            </tr>
                            <?php $i++; ?>
                            <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>


<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
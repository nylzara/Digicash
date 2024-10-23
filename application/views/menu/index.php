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

                    <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '
                        </div>'); ?>

                    <?= $this->session->flashdata('message'); 
                    ?>


                    <a href="#" class="btn btn-primary mb-3" data-toggle="modal" data-target="#MenuModal"><i
                            class="fas fa-plus mr-3"></i>Tambahkan Menu baru</a>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Menu</th>
                                <th scope="col">Aksi</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($menu as $m ) : ?>
                            <tr>
                                <th scope="row"><?= $i; ?></th>
                                <td><?= $m['menu']; ?></td>
                                <td>

                                    <a href="#" class="badge badge-success" data-toggle="modal"
                                        data-target="#editMenu<?= $m['id']; ?>">
                                        Edit</a>
                                    <a href="<?= base_url(); ?>menu/deleteMenu/<?= $m['id']; ?>"
                                        class="badge badge-danger"
                                        onclick="return confirm('Yakin data ingin dihapus?');">
                                        Hapus</a>
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


<!-- Modal add data menuuu-->
<div class="modal fade" id="MenuModal" tabindex="-1" role="dialog" aria-labelledby="MenuModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="MenuModalLabel">Add New Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('menu'); ?>" method="post">
                <div class=" modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="menu" name="menu" placeholder="Menu Name">
                    </div>
                </div>
                <div class="modal-footer">
                    <!-- <button type="submit" class="btn btn-primary ms-4">Submit</button> -->
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal edit data menuu-->
<?php $i = 1; ?>
<?php foreach ($menu as $m ) : ?>
<div class="modal fade" id="editMenu<?= $m['id']; ?>" tabindex="-1" role="dialog"
    aria-labelledby="editMenu<?= $m['id']; ?>" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editMenu<?= $m['id']; ?>lLabel">Edit New Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('menu/uptadeMenu/' . $m['id'])?>" method="POST">
                <div class=" modal-body">
                    <input type="hidden" name="id" value="<?= $m['id']; ?>">
                    <div class="form-group">
                        <input type="text" class="form-control" id="menu" name="menu" value="<?= $m['menu']; ?>">

                    </div>
                </div>
                <div class="modal-footer">
                    <!-- <button type="submit" class="btn btn-primary ms-4">Submit</button> -->
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $i++; ?>
<?php endforeach; ?>
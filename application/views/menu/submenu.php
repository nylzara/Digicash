<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="bg-white border border-light shadow-sm p-2 rounded m-3">
        <div class="text-center font-weight-bold h3 mb-4 text-gray-800"><?= $title; ?></div>
    </div>


    <div class="bg-white border border-light shadow-sm p-4 rounded m-3">
        <div class="container">
            <div class="row">
                <div class="col-lg">
                    <?php if (validation_errors()) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?= validation_errors(); ?>
                    </div>
                    <?php endif; ?>

                    <?= $this->session->flashdata('message'); ?>

                    <a href="#" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newSubMenuModal"><i
                            class="fas fa-plus mr-3"></i>Tambahkan Submenu Baru</a>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope=" col">No</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Menu</th>
                                    <th scope="col">Url</th>
                                    <th scope="col">Icon</th>
                                    <th scope="col">Aksi</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($subMenu as $sm ) : ?>
                                <tr>
                                    <th scope="row"><?= $i; ?></th>
                                    <td><?= $sm['title']; ?></td>
                                    <td><?= $sm['menu']; ?></td>
                                    <td><?= $sm['url']; ?></td>
                                    <td><?= $sm['icon']; ?></td>
                                    <td>

                                        <a href="#" class="badge badge-success" data-toggle="modal"
                                            data-target="#editSubMenuModal<?= $sm['id'];?>">
                                            Edit</a>

                                        <a href="<?= base_url('menu/deleteSubmenu/' . $sm['id']);?>"
                                            class="btn btn-danger badge"
                                            onclick="return confirm('Yakin data ingin dihapus?');">Hapus</a>
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
</div>


<!-- /.container-fluid -->

<!-- End of Main Content -->


<!-- Modal tambah sub menu -->
<div class="modal fade" id="newSubMenuModal" tabindex="-1" role="dialog" aria-labelledby="newSubMenuModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newSubMenuModalLabel">Add New Sub Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('menu/submenu'); ?>" method="post">
                <div class=" modal-body">

                    <div class="form-group">
                        <input type="text" class="form-control" id="title" name="title" placeholder="Submenu title">
                    </div>

                    <div class="form-group">
                        <select name="menu_id" id="menu_id" class="form-control">
                            <option value="">Select menu</option>
                            <?php foreach ($menu as $m ) :?>
                            <option value="<?= $m['id']; ?>">
                                <?= $m['menu']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" id="url  " name="url" placeholder="Submenu url">
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" id="icon  " name="icon" placeholder="Submenu icon">
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

<!-- Modal edit sub menu -->
<?php $i = 1; ?>
<?php foreach ($subMenu as $sm ) : ?>
<div class="modal fade" id="editSubMenuModal<?= $sm['id'];?>" tabindex="-1" role="dialog"
    aria-labelledby="editSubMenuModal<?= $sm['id'];?>Label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editSubMenuModal<?= $sm['id'];?>Label">Ubah Sub Menu
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('menu/updateSubmenu/' . $sm['id']); ?>" method="post">
                <div class="modal-body">
                    <input type="hidden" name="id" value="<?= $sm['id']; ?>">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title" value="<?= $sm['title']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="menu_id">Menu</label>
                        <select name="menu_id" id="menu_id" class="form-control">
                            <option value=""><?= $sm['menu']; ?></option>
                            <?php foreach ($menu as $m) : ?>
                            <option value="<?= $m['id']; ?>"><?= $m['menu']; ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="url">Url</label>
                        <input type="text" class="form-control" id="url" name="url" value="<?= $sm['url']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="icon">Icon</label>
                        <input type="text" class="form-control" id="icon" name="icon" value="<?= $sm['icon']; ?>">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $i++; ?>
<?php endforeach; ?>
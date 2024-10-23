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

                    <?= form_error('role', '<div class="alert alert-danger" role="alert">', '
                        </div>'); ?>

                    <?= $this->session->flashdata('message'); 
                    ?>


                    <a href="#" class="btn btn-primary mb-3" data-toggle="modal" data-target="#roleModal"><i
                            class="fas fa-plus mr-3"></i>Tambahkan Role Baru</a>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Role</th>
                                <th scope="col">Aksi</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($role as $r ) : ?>
                            <tr>
                                <th scope="row"><?= $i; ?></th>
                                <td><?= $r['role']; ?></td>
                                <td>

                                    <a href="<?= base_url('admin/roleaccess/') . $r['id'];?>"
                                        class="badge badge-warning">
                                        <!-- roleaccess nama method -->
                                        Access
                                    </a>
                                    <a href="#" class="badge badge-success" data-toggle="modal"
                                        data-target="#edit<?= $r['id']; ?>">
                                        Edit
                                    </a>
                                    <a href="<?= base_url(); ?>admin/deleteRole/<?= $r['id']; ?>"
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


<!-- Modal new role -->
<div class=" modal fade" id="roleModal" tabindex="-1" role="dialog" aria-labelledby="roleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="roleModalLabel">Add New Role</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/tambahRole'); ?>" method="post">
                <div class=" modal-body">

                    <div class="form-group">
                        <input type="text" class="form-control" id="role" name="role" placeholder="Role Name">
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



<!-- Modal edit role -->
<?php $i = 1; ?>
<?php foreach ($role as $r ) : ?>
<div class="modal fade" id="edit<?= $r['id']; ?>" tabindex="-1" role="dialog"
    aria-labelledby="edit<?= $r['id']; ?>Label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit<?= $r['id']; ?>Label">Ubah Role
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/uptadeRole/' . $r['id']); ?>" method="post">
                <div class="modal-body">
                    <input type="hidden" name="id" value="<?= $r['id']; ?>">
                    <div class="form-group">
                        <label for="title">Role</label>
                        <input type="text" class="form-control" id="role" name="role" value="<?= $r['role']; ?>">
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
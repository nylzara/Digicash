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

                    <?= $this->session->flashdata('message'); 
                    ?>

                    <div class="container mt-2">
                        <div class="d-flex justify-content-between flex-wrap">
                            <a href="#" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addkasmasuk"><i
                                    class="fas fa-plus mr-3"></i>Kas Masuk</a>
                            <a href="#" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addkaskeluar"><i
                                    class="fas fa-plus mr-3"></i>Kas Keluar</a>
                        </div>
                    </div>


                    <div class="table-responsive">

                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Id kas</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">No Bukti</th>
                                    <th scope="col">Uraian</th>
                                    <th scope="col">Kas masuk</th>
                                    <th scope="col">Kas keluar</th>
                                    <th scope="col">Saldo</th>
                                    <th scope="col">Aksi</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php $no =  $start + 1; ?>
                                <?php foreach ($dataKas as $kas ) : ?>
                                <tr>
                                    <th scope="row"><?= $no++;?></th>
                                    <td><?= $kas['id_kas']?></td>
                                    <td><?=tgl_indo($kas['tanggal']); ?></td>
                                    <td><?= $kas['no_bukti']?></td>
                                    <td><?= $kas['uraian']?></td>
                                    <td>Rp<?= num($kas['kas_masuk']);?></td>
                                    <td class="text-danger">Rp<?=num($kas['kas_keluar']);?></td>
                                    <td>Rp <?= num($kas['saldo']); ?></td>

                                    <td>
                                        <?php if ($kas['kas_masuk'] != 0): ?>
                                        <!-- Jika nilai kas masuk tidak sama dengan nol -->
                                        <a href="<?= base_url('user/edit/') . $kas['id_kas'];?>"
                                            class="badge badge-success" data-toggle="modal"
                                            data-target="#editMasuk<?= $kas['id_kas']; ?>">
                                            Edit</a>
                                        <?php else: ?>
                                        <!-- Jika nilai kas masuk sama dengan nol -->
                                        <a href="<?= base_url('user/edit/') . $kas['id_kas'];?>"
                                            class="badge badge-success" data-toggle="modal"
                                            data-target="#editKeluar<?= $kas['id_kas']; ?>">
                                            Edit</a>
                                        <?php endif; ?>


                                        <a href="<?= base_url(); ?>user/delete/<?= $kas['id_kas']; ?>"
                                            class="badge badge-danger"
                                            onclick="return confirm('Yakin data ingin dihapus?');">
                                            Hapus</a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <div class="pagination-links">
                            <?= $pagination; ?>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- Modal add kas masuk -->
<div class="modal fade" id="addkasmasuk" tabindex="-1" role="dialog" aria-labelledby="addkasmasukLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addkasmasukLabel">Tambah Data kas Masuk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('User/add_kasmasuk'); ?>" method="post">
                <div class=" modal-body">


                    <div class="form-group">
                        <input class="form-control" id="id_kas" name="id_kas"
                            value="<?= $this->User_model->generateKasCode(); ?>" readonly>
                        <!--text/txt
                        -->
                    </div>

                    <div class=" form-group">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal">
                    </div>
                    <div class="form-group">
                        <label for="no_bukti">No Bukti</label>
                        <input type="text" class="form-control" id="no_bukti" name="no_bukti"
                            value="<?= $this->User_model->generateNoBuktiKasMasuk(); ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="uraian">Uraian</label>
                        <input type="text" class="form-control" id="uraian" name="uraian">
                    </div>
                    <div class="form-group">
                        <label for="kas_masuk">kas Masuk</label>
                        <input type="text" class="form-control" id="kas_masuk" name="kas_masuk">
                    </div>
                </div>
                <div class=" modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal add kas keluar -->
<div class="modal fade" id="addkaskeluar" tabindex="-1" role="dialog" aria-labelledby="addkaskeluarLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addkaskeluarLabel">Tambah Data kas keluar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('user/add_kaskeluar')?>" method="post">
                    <div class="form-group">
                        <input class="form-control" id="id_kas" name="id_kas"
                            value="<?= $this->User_model->generateKasCode(); ?>" readonly>
                    </div>
                    <div class=" form-group">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal">
                    </div>
                    <div class="form-group">
                        <label for="no_bukti">No Bukti</label>
                        <input type="text" class="form-control" id="no_bukti" name="no_bukti"
                            value="<?= $this->User_model->generateNoBuktiKasKeluar(); ?>" readonly>

                    </div>
                    <div class="form-group">
                        <label for="uraian">Uraian</label>
                        <input type="text" class="form-control" id="uraian" name="uraian">
                    </div>
                    <div class="form-group">
                        <label for="kas_keluar">kas Keluar</label>
                        <input type="text" class="form-control" id="kas_keluar" name="kas_keluar">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Tambah</button>
            </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal edit kas masuk -->
<?php $i = 1; ?>
<?php foreach ($dataKas as $kas ) : ?>

<div class="modal fade" id="editMasuk<?= $kas['id_kas']; ?>" tabindex="-1" role="dialog"
    aria-labelledby="editMasuk<?= $kas['id_kas']; ?>Label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editMasukLabel">Ubah Data kas Masuk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('User/update_kasMasuk/' . $kas['id_kas']); ?>" method="post">
                    <div class=" modal-body">
                        <input type="hidden" name="id_kas" value="<?= $kas['id_kas']; ?>">
                        <div class="form-group">
                            <input class="form-control" id="id_kas" name="id_kas" value="<?= $kas['id_kas'];?>"
                                readonly>
                        </div>
                        <div class=" form-group">
                            <label for="tanggal">Tanggal</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal"
                                value="<?=$kas['tanggal']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="no_bukti">No Bukti</label>
                            <input type="text" class="form-control" id="no_bukti" name="no_bukti"
                                value="<?= $kas['no_bukti']?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="uraian">Uraian</label>
                            <input type="text" class="form-control" id="uraian" name="uraian"
                                value="<?= $kas['uraian']?>">
                        </div>
                        <div class="form-group">
                            <label for="kas_masuk">kas Masuk</label>
                            <input type="text" class="form-control" id="kas_masuk" name="kas_masuk"
                                value="<?= $kas['kas_masuk'];?>">
                        </div>
                    </div>
                    <div class=" modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $i++; ?>
<?php endforeach; ?>

<!-- Modal edit kas Keluar -->
<?php $i = 1; ?>
<?php foreach ($dataKas as $kas ) : ?>

<div class="modal fade" id="editKeluar<?= $kas['id_kas']; ?>" tabindex="-1" role="dialog"
    aria-labelledby="editKeluar<?= $kas['id_kas']; ?>Label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editKeluar<?= $kas['id_kas']; ?>Label">Ubah Data kas Keluar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('User/update_kasKeluar/' . $kas['id_kas']); ?>" method="post">
                    <div class=" modal-body">
                        <input type="hidden" name="id_kas" value="<?= $kas['id_kas']; ?>">
                        <div class="form-group">
                            <input class="form-control" id="id_kas" name="id_kas" value="<?= $kas['id_kas'];?>"
                                readonly>
                            <!--text/txt
                        -->
                        </div>

                        <div class=" form-group">
                            <label for="tanggal">Tanggal</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal"
                                value="<?=$kas['tanggal']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="no_bukti">No Bukti</label>
                            <input type="text" class="form-control" id="no_bukti" name="no_bukti"
                                value="<?= $kas['no_bukti']?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="uraian">Uraian</label>
                            <input type="text" class="form-control" id="uraian" name="uraian"
                                value="<?= $kas['uraian']?>">
                        </div>
                        <div class="form-group">
                            <label for="kas_keluar">kas Keluar</label>
                            <input type="text" class="form-control" id="kas_keluar" name="kas_keluar"
                                value="<?= $kas['kas_keluar'];?>">
                        </div>
                    </div>
                    <div class=" modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $i++; ?>
<?php endforeach; ?>
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
                            <a href="<?= base_url('user/report/print'); ?>" target="_blank"
                                class="btn btn-primary mb-3"><i class="fas fa-print mr-3"></i>Print</a>

                            <a href="<?= base_url('user/report/export'); ?>" target="_blank"
                                class="btn btn-success  mb-3"><i class="fas fa-print mr-3"></i>Ekspor ke Excel</a>

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


                                </tr>
                            </thead>
                            <tbody>
                                <?php $no =  $start + 1; ?>
                                <?php foreach ($dataKas as $kas ) : ?>
                                <tr>
                                    <th scope="row"><?= $no++; ?></th>
                                    <td><?= $kas['id_kas']?></td>
                                    <td><?=tgl_indo($kas['tanggal']); ?></td>
                                    <td><?= $kas['no_bukti']?></td>
                                    <td><?= $kas['uraian']?></td>
                                    <td>Rp<?= num($kas['kas_masuk']);?></td>
                                    <td class="text-danger">Rp<?=num($kas['kas_keluar']);?></td>
                                    <td>Rp <?= num($kas['saldo']); ?></td>
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
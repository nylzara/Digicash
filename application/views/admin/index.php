<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->

    <!-- <div class="col-lg-4 p-4">
        <div class="card" style="width: 18rem;" style="max-width: 540px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1)">
            <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                    card's
                    content.</p>
            </div>
        </div>

    </div> -->

    <div class="container-fluid p-4">
        <div class="row mb-4">
            <div class="col-12 col-md-6 col-lg-3 mb-4">
                <div class="bg-white rounded border border-light p-4 shadow-sm">
                    <div class="d-flex justify-content-between mb-4">
                        <div>
                            <div class="small text-muted mb-1 text-uppercase">Jumlah Transaksi</div>
                            <div class="h2 font-weight-bold mt-4"><?= $jumlah_transaksi; ?> Transaksi</div>
                        </div>
                        <i class="ri-calendar-check-fill text-primary display-4 mt-2"></i>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3 mb-4">
                <div class="bg-white rounded border border-light p-4 shadow-sm">
                    <div class="d-flex justify-content-between mb-4">
                        <div>
                            <div class="small text-muted mb-1 text-uppercase">Kas Masuk</div>
                            <div class="h2 font-weight-bold mt-4">Rp.<?= num($kas_masuk); ?> </div>

                        </div>
                        <i class="ri-arrow-down-line text-primary display-4 mt-2"></i>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3 mb-4">
                <div class="bg-white rounded border border-light p-4 shadow-sm">
                    <div class="d-flex justify-content-between mb-4">
                        <div>
                            <div class="small text-muted mb-1 text-uppercase">Kas Keluar</div>
                            <div class="h2 font-weight-bold mt-4">Rp.<?= num($kas_keluar); ?></div>
                        </div>
                        <i class="ri-arrow-up-line text-primary display-4 mt-2"></i>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3 mb-4">
                <div class="bg-white rounded border border-light p-4 shadow-sm">
                    <div class="d-flex justify-content-between mb-4">
                        <div>
                            <div class="small text-muted mb-1 text-uppercase">Saldo</div>
                            <div class="h2 font-weight-bold mt-4">Rp.<?= num($saldo); ?></div>
                        </div>
                        <i class="ri-money-dollar-circle-line text-primary display-4 mt-2"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>










</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
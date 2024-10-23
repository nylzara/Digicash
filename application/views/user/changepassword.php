<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <!-- <h1 class="h3 mb-4 text-gray-800">
        
    </h1> -->
    <div class="bg-white border border-light shadow-sm p-2 rounded m-3">
        <div class="text-center font-weight-bold h3 mb-4 text-gray-800"><?= $title; ?></div>
    </div>

    <div class="bg-white border border-light shadow-sm p-4 rounded m-3">
        <div class="container">


            <div class="row">
                <div class="col-lg-6">
                    <?= $this->session->flashdata('message');?>

                    <form action="<?= base_url('user/changepassword'); ?>" method="post">
                        <div class="form-group">
                            <label for="current_password">Kata Sandi Saat Ini</label>
                            <input type="password" class="form-control" id="current_password" name="current_password">
                            <?= form_error('current_password',' <small class="text-danger pl-3">' ,'</small>'); ?>
                            <!-- sesuaikn dgn name -->
                        </div>
                        <div class="form-group">
                            <label for="new_password1">Kata Sandi Baru</label>
                            <input type="password" class="form-control" id="new_password1" name="new_password1">
                            <?= form_error('new_password1',' <small class="text-danger pl-3">' ,'</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="new_password2">Ulangi Kata Sandi </label>
                            <input type="password" class="form-control" id="new_password2" name="new_password2">
                            <?= form_error('new_password2',' <small class="text-danger pl-3">' ,'</small>'); ?>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Ubah kata Sandi</button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
</div>
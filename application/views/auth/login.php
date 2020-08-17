<div class="container">
    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('pesan'); ?>"></div>
    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-lg-5">
            <!-- ukuran login putih -->

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Login</h1>
                                </div>
                                <!-- Form Login -->
                                <form class="user" method="POST" action="<?= base_url('auth'); ?>">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" id="username" name="username" placeholder="Username" value="<?= set_value('username') ?>">
                                        <?= form_error('username', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password">
                                        <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <div class="form-group text-center">
                                        <div class="row">
                                            <div class="col-md-10 col-sm image">
                                                <?= $img ?>
                                            </div>
                                            <div class="col-md-2 mt-1 col-sm ">
                                                <a class="refresh" href="javascript:;"><img width="40px" src="<?php base_url(); ?>assets/img/refresh.png"> </a>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" id="captcha" name="captcha" placeholder="Masukan Captcha">
                                        <?= form_error('captcha', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <button type="submit" class="btn btn-secondary btn-user btn-block">Masuk</button>
                                </form>
                                <hr>
                                <div class="text-center">
                                    <!-- <a href="<?= base_url('Publik/index'); ?>" class="small">Masuk Sebagai Tamu</a><br> -->
                                    <!-- <a class="small" href="<?= base_url('auth/registration'); ?>">Buat Akun Baru</a> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>
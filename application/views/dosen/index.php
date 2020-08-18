<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('pesan'); ?>"></div>
    <?= $this->session->flashdata('mt'); ?>
    <!-- Page Heading -->
    <h1 style="text-align: center;" class="h3 mb-4 text-gray-800"><?= $judul; ?></h1>
    <hr>
    <!-- <div class="card mb-3" style="max-width: 540px;">
        <div class="row no-gutters">
            <div class="col-md-4">
                <img src="<?= base_url('assets/img/profile/') . $profil['gambar']; ?>" class="card-img" alt="gambar">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title"><?= $profil['nama']; ?></h5>
                    <p class="card-text"><?= $user['username']; ?></p>
                    <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#FotoBaru"><i class="fa fa-fw fa-user"></i> Ubah Foto</a> <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#PassBaru"><i class="fa fa-fw fa-key"></i> Ubah Password</a>
                </div>
            </div>
        </div>
    </div> -->
    <section class="hero-section spad">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-10 offset-xl-1">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="hero-text">
                                <h2><?= $profil['nama']; ?></h2>
                                <p><?= $user['username']; ?></p>
                            </div>
                            <hr>
                            <div class="hero-info">
                                <h2>Profil</h2>
                                <div class="row">
                                    <div class="col-lg-1">
                                        <ul>
                                            <li></li>
                                        </ul>
                                    </div>
                                    <div class="col-lg-4">
                                        <span>Tanggal Lahir</span>
                                    </div>
                                    <div class="col-lg-7">
                                        <span><?= $profil['tanggal_lahir']; ?></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-1">
                                        <ul>
                                            <li></li>
                                        </ul>
                                    </div>
                                    <div class="col-lg-4">
                                        <span>Jenis Kelamin</span>
                                    </div>
                                    <div class="col-lg-7">
                                        <span><?= $profil['Jenis_Kelamin']; ?></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-1">
                                        <ul>
                                            <li></li>
                                        </ul>
                                    </div>
                                    <div class="col-lg-4">
                                        <span>Alamat</span>
                                    </div>
                                    <div class="col-lg-7">
                                        <span><?= $profil['Alamat']; ?></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-1">
                                        <ul>
                                            <li></li>
                                        </ul>
                                    </div>
                                    <div class="col-lg-4">
                                        <span>Email</span>
                                    </div>
                                    <div class="col-lg-7">
                                        <span><?= $profil['email']; ?></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-1">
                                        <ul>
                                            <li></li>
                                        </ul>
                                    </div>
                                    <div class="col-lg-4">
                                        <span>No.Hp</span>
                                    </div>
                                    <div class="col-lg-7">
                                        <span><?= $profil['No_HP']; ?></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg">
                                        <span><a href="" data-target="#FotoBaru"> >Klik untuk ubah profil</a></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 text-md-center">
                            <figure class="hero-image">
                                <img src="<?= base_url('assets/img/profile/') . $profil['gambar']; ?>" alt="5">
                            </figure>
                            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#FotoBaru"><i class="fa fa-fw fa-user"></i> Ubah Foto</a>
                            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#PassBaru"><i class="fa fa-fw fa-key"></i> Ubah Password</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- Modal -->
<div class="modal fade" id="FotoBaru" tabindex=" -1" role="dialog" aria-labelledby="FotoBaru" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="FotoBaru">Upload Foto Profil Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="<?= base_url('dosen/UbahFoto/') . $user['id']; ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="ktp" aria-describedby="inputGroupFileAddon01" name="UbahFoto" required>
                            <label class="custom-file-label" for="ktp">Choose file</label>
                        </div>
                    </div>
                    <div class="txtprof">
                        <p>*Ekstensi yang diperbolehkan .jpeg / .jpg / .png</p>
                        <!-- <p>*Maksimal ukuran gambar 500 x 500</p> -->
                        <p>*Maksimal 2 MB</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Upload Foto</button>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- Modal Password-->
<div class="modal fade" id="PassBaru" tabindex=" -1" role="dialog" aria-labelledby="PassBaru" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="PassBaru">Ubah Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="<?= base_url('dosen/changePassword/') . $user['id']; ?>" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <div class="form-group">
                            <label for="curpass">Masukkan Password Lama</label>
                            <div class="inputWithIcon">
                                <input type="password" class="form-control" id="curpass" name="curpass" placeholder="Masukan Password Lama" autocomplete="off">
                                <i class=" fas fa-fw fa-unlock-alt" aria-hidden="true"></i> </div>
                            <?= form_error('curpass', '<div class="alert-danger" role="alert">', '</div>'); ?>
                            <?= $this->session->flashdata('ms'); ?>
                        </div>
                        <div class="form-group">
                            <label for="newpass">Masukkan Password Baru</label>
                            <div class="inputWithIcon">
                                <input type="password" class="form-control" id="newpass" name="newpass" placeholder="Masukan Password Baru" autocomplete="off">
                                <i class=" fas fa-fw fa-lock" aria-hidden="true"></i> </div>
                            <?= form_error('newpass', '<div class="alert-danger" role="alert">', '</div>'); ?>
                            <?= $this->session->flashdata('msg'); ?>
                        </div>
                        <div class="form-group">
                            <label for="conpass1">Ulangi Password Baru</label>
                            <div class="inputWithIcon">
                                <input type="password" class="form-control" id="conass" name="conpass" placeholder="Masukan Lagi" autocomplete="off">
                                <i class=" fas fa-fw fa-lock" aria-hidden="true"></i> </div>
                            <?= form_error('conpass', '<div class="alert-danger" role="alert">', '</div>'); ?>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Ubah Password</button>
                    </div>
            </form>

        </div>
    </div>
</div>

<!-- /.container-fluid -->

</div>
</div>
<!-- End of Main Content -->
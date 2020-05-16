<!-- Begin Page Content -->

<div class="container-fluid">
    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('pesan'); ?>"></div>
    <!-- Page Heading -->
    <div>
        <div class="row">

            <div class="col-md">
                <h1 class="h3 mb-4 text-gray-800"><?= $judul; ?></h1>
            </div>
            <div class="col-md-2">
                <nav aria-label="breadcrumb">
                    <p>
                        <span class="posisi"><i class="fa fa-dashboard fa-md"></i> &nbsp<b>Dashboard</b>
                        </span>
                    </p>
                </nav>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md">
            <table class="table table-hover" id="perus">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Judul</th>
                        <th scope="col">Dosbing1</th>
                        <th scope="col">Dosbing2</th>
                        <th scope="col">Detail</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $count = 0;
                    $start = 0;
                    foreach ($skripsi as $u) :
                        if ($u['nim'] == $this->session->userdata('username')) { ?>
                            <tr>
                                <th scope="row"><?= ++$start; ?></th>
                                <td><?= $u['judul']; ?></td>
                                <td><?= $u['dosbing_1']; ?></td>
                                <td><?= $u['dosbing_2']; ?></td>
                                <!-- <?php if ($u['nilai'] != 0) : ?>
                                <td><?= $u['nilai']; ?></td>
                            <?php else : ?>
                                <td>N/A</td>
                            <?php endif; ?> -->
                                <td>
                                    <a data-toggle="modal" data-target="#detail<?= $u['id'] ?>" class="btn btn-warning btn-sm detail"><i class="fa fa-fw fa-eye"></i>Lihat Detail</a>
                                </td>
                                <td>
                                    <?php $last=count($bimbingan);
                                     if ($u['status'] == '1') { ?>
                                            <a href="<?= base_url() . 'mahasiswa/DaftarSempro/' . $u['id'] ?>" class=" btn btn-success btn-sm sempro"><i class="fa fa-fw fa-check"></i> Daftar Sempro</a>
                                    <?php }
                                    else if ($u['status'] == '3' && $last==6){?>
                                        <a href="<?= base_url() . 'mahasiswa/DaftarSidang/' . $u['id'] ?>" class=" btn btn-success btn-sm sidang"><i class="fa fa-fw fa-check"></i> Daftar Sidang</a>
                                    <?php }
                                    else if ($u['status'] == '3' && $bimbingan[$last-1]['pembahasan']!=NULL){?>
                                        <a href="" data-toggle="modal" data-target="#mhsBimbingan<?= $u['id']; ?>" class="btn btn-success btn-sm"><i class="fa fa-fw fa-edit"></i> Ajukan Bimbingan</a>
                                    <?php }
                                    else if ($u['status'] == '3' && $bimbingan[$last-1]['pembahasan']==NULL){?>
                                        menunggu...
                                    <?php } else{echo "N/A"; }
                                    ?>
                                </td>
                            </tr>
                    <?php $count += 1;
                        }
                    endforeach; ?>
                    <?php if (empty($skripsi) || $count == 0) : ?>
                        <tr>
                            <td colspan="12">
                                <div class="alert alert-danger" role="alert">
                                    Data not found!
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>


            </table>
            
            <!-- <div class="col-xs-4 paging">
				<span>Halaman <?php echo $page; ?> dari <?php echo $jumlah_page; ?></span>
			</div> -->
            <?= $this->pagination->create_links(); ?>

        </div>

    </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<?php foreach ($skripsi as $u) :
    if ($u['nim'] == $this->session->userdata('username')) { ?>
        <!-- modal detail -->
        <div class="modal fade displaycontent" id="detail<?= $u['id'] ?>">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Detail Skripsi</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <td>Judul</td>
                                    <td><?php echo $u['judul']; ?></td>
                                </tr>
                                <tr>
                                    <td>Abstrak</td>
                                    <td><?php echo $u['abstract']; ?></td>
                                </tr>
                                <tr>
                                    <td>Dosen Pembimbing 1</td>
                                    <td><?php echo $u['dosbing_1']; ?></td>
                                </tr>
                                <tr>
                                    <td>Dosen Pembimbing2</td>
                                    <td><?php echo $u['dosbing_2']; ?></td>
                                </tr>
                                <tr>
                                    <td>Prodi</td>
                                    <td><?php echo $u['prodi']; ?></td>
                                </tr>
                                <tr>
                                    <td>status</td>
                                    <td><?php echo $this->db->get_where('status', ['id' => $u['status']])->row_array()['ket']; ?></td>
                                </tr>
                                <tr>
                                    <td>Nilai</td>
                                    <?php if ($u['nilai'] != 0) : ?>
                                        <td><?= $u['nilai']; ?></td>
                                    <?php else : ?>
                                        <td>N/A</td>
                                    <?php endif; ?>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- end modal detail -->
<?php }
endforeach; ?>

<!-- Modal Ajukan Bimbingan -->
<?php foreach ($skripsi as $u) : ?>
    <div class="modal fade" id="mhsBimbingan<?= $u['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="mahasiswaEditLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mahasiswaEditLabel">Ajukan Bimbingan Skripi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('mahasiswa/MhsBimbingan/' . $u['id']); ?>" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="judul">Judul Skripsi</label>
                            <input type="text" disabled class="form-control" id="judul" name="judul" value="<?= $u['judul']; ?>">
                            <?= form_error('judul', '<div class="alert-danger" role="alert">', '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="tanggal">Tanggal</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?= date("Y-m-d"); ?>">
                            <?= form_error('tanggal', '<div class="alert-danger" role="alert">', '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="tempat">Tempat</label>
                            <input type="text" class="form-control" id="tempat" name="tempat">
                            <?= form_error('tempat', '<div class="alert-danger" role="alert">', '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="dosbing">Pembimbing</label>
                            <select name="dosbing" id="dosbing" class="form-control mt-2">
                                <?php $first='selected';
                                foreach ($dosen as $b) : 
                                    if ($b['nip']==$u['dosbing_1'] || $b['nip']==$u['dosbing_2']){ 
                                        ?>
                                        <option value="<?= $b['nip']; ?>" <?= $first; ?>><?= $b['nama']; ?> </option>
                                    <?php $first='';
                                } endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Ajukan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


<?php endforeach; ?>
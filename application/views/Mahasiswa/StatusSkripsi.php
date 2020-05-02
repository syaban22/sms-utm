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
    <!-- <div class="row">
        <div class="col-md">
            <nav class="navbar navbar-light bg-light">
                <?php
                if ($keyword == null) {
                    echo '<a class="navbar-brand">Total : ' . $total_rows . '</a>';
                } else {
                    echo '<a class="navbar-brand">Hasil Pencarian : ' . $total_rows . '</a>';
                }
                ?>

                <form class="form-inline" action="<?= base_url('mahasiswa/StatusSkripsi'); ?>" method="post">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search Name" name="keyword" autocomplete="off" autofocus>
                    <input type="submit" class="btn btn-primary" name="submit" value="Search">

                </form>
            </nav>
        </div>
    </div> -->
    <!-- <div class="col-md-2">
		<select class="form-control" name="" id="perusahaan">
			<option value="5">5</option>
			<option value="10">10</option>
			<option value="15">15</option>
			<option value="20">20</option>
		</select>
	</div>
	<br> -->
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
                        <!-- <th scope="col">Prodi</th>
                        <th scope="col">Nilai</th> -->
                        <!-- <th scope="col">Action</th> -->
                    </tr>
                </thead>
                <tbody>
                    <?php $count=0;$start=0; foreach ($skripsi as $u) :
                        if ($u['nim'] == $this->session->userdata('username')){?>
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
                                <a data-toggle="modal" data-target="#detail<?= $u['id'] ?>"  class="btn btn-warning btn-sm detail"><i class="fa fa-fw fa-eye"></i>Lihat Detail</a>
                                <?php if ($u['status']='1'){?>
                                <!-- tombol daftar skripsi + pop up "apakah anda yakin akan mendaftarkan skripsi anda untuk seminar proposal" -->
                                <?php }
                                // if untuk sempro kondisinya ketika catatan bimbingan sudah 6x bimbingan?>

                                <!-- <a href="" data-toggle="modal" data-target="#pelamarEdit<?= $u['id'] ?>" class="btn btn-success btn-sm"><i class="fa fa-fw fa-edit"></i>Edit</a>
                                <a href="<?= base_url() . 'administrator/deleteU/' . $u['id'] ?>" data-nama="<?= $u['nama']; ?>" class="btn btn-danger btn-sm deleteP"><i class="fa fa-fw fa-trash"></i>Delete</a> -->
                                <!-- <button class="btn btn-primary detail" relid="<?= $u['nim']; ?>">View</button> -->
                                <!-- <a href="" relid="<?= $u['nim'] ?>" class="btn btn-warning btn-sm detail"><i class="fa fa-fw fa-eye"></i> Detail</a> -->
                            </td>
                        </tr>
                        
                    <?php $count+=1;} endforeach;?>
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

<?php  foreach ($skripsi as $u) :
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
                                    <td><?php echo $this->db->get_where('status',['id'=>$u['status']])->row_array()['ket'];?></td>
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
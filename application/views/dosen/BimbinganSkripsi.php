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
			<a href="" class="btn btn-sm btn-primary mb-3" data-toggle="modal" data-target="#JadwalSemproBaru"><i class="fas fa-fw fa-plus-square"></i> Tambah Jadwal Sempro</a>
			<nav class="navbar navbar-light bg-light">
				<?php
                if ($keyword == null) {
                    echo '<a class="navbar-brand">Total : ' . $total_rows . '</a>';
                } else {
                    echo '<a class="navbar-brand">Hasil Pencarian : ' . $total_rows . '</a>';
                }
                ?>

				<form class="form-inline" action="<?= base_url('mahasiswa/JadwalSempro'); ?>" method="post">
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
                        <th scope="col">Judul Skripsi</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Tempat</th>
                        <th scope="col">Pembahasan</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($bimbingan)) : ?>
                        <tr>
                            <td colspan="12">
                                <div class="alert alert-danger" role="alert">
                                    Data not found!
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                    <?php foreach ($bimbingan as $u) : ?>
                        <tr>
                            <th scope="row"><?= ++$start; ?></th>
                            <td><?= $u['judul']; ?></td>
                            <td><?= $u['tanggal']; ?></td>
                            <td><?= $u['tempat']; ?></td>
                            <td><?= $u['pembahasan']; ?></td>
                            <?php if ($u['pembahasan'] == null) : ?>
                                <td><a href="" data-toggle="modal" data-target="#EditCatatan<?=$u['id'];?>" class="btn btn-success btn-sm"><i class="fa fa-fw fa-edit"></i> Tambahkan Catatan</a>
                            <?php elseif ($u['pembahasan'] != null) : ?>
                                <td><a href="" data-toggle="modal" data-target="#EditCatatan<?=$u['id'];?>" class="btn btn-info btn-sm"><i class="fa fa-fw fa-edit"></i> Ubah Catatan</a>
                            <?php endif; ?>
                            <a href="<?= base_url() . 'dosen/deletecatatan/' . $u['id'] ?>" data-nama="<?= $u['judul']; ?>" class="btn btn-danger btn-sm deletebimbingan"><i class="fa fa-fw fa-trash"></i>Hapus</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>


            </table>
        </div>

    </div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->

<?php foreach ($bimbingan as $u) : ?>

    <!-- Modal Edit -->
    <div class="modal fade" id="EditCatatan<?=$u['id'];?>" tabindex="-1" role="dialog" aria-labelledby="EditCatatanLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="EditCatatanLabel">Edit Catatan Bimbingan Skripsi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('dosen/updateCatatan/' . $u['id']); ?>" method="POST" class="needs-validation" novalidate>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="catatan">Catatan Bimbingan Skripsi</label>
                            <input type="text" class="form-control" id="catatan" name="catatan" value="<?= $u['pembahasan']; ?>" required>
                            <?= form_error('catatan', '<div class="alert-danger" role="alert">', '</div>'); ?>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Ubah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php endforeach; ?>
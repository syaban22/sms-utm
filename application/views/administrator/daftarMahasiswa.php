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
			<a href="" class="btn btn-sm btn-primary mb-3" data-toggle="modal" data-target="#mahasiswaBaru"><i class="fas fa-fw fa-plus-square"></i> Tambah Mahasiswa</a>
			<nav class="navbar navbar-light bg-light">
				<?php
				if ($keyword == null) {
					echo '<a class="navbar-brand">Total : ' . $total_rows . '</a>';
				} else {
					echo '<a class="navbar-brand">Hasil Pencarian : ' . $total_rows . '</a>';
				}
				?>

				<form class="form-inline" action="<?= base_url('administrator/daftarMahasiswa'); ?>" method="post">
					<input class="form-control mr-sm-2" type="search" placeholder="Search Name" name="keyword" autocomplete="off" autofocus>
					<input type="submit" class="btn btn-primary" name="submit" value="Search">

				</form>
			</nav>
		</div>
	</div>
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
						<th scope="col">NIM</th>
						<th scope="col">Nama</th>
						<th scope="col">Program Studi</th>
						<th scope="col">Username</th>
						<th scope="col">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php if (empty($mahasiswa)) : ?>
						<tr>
							<td colspan="12">
								<div class="alert alert-danger" role="alert">
									Data not found!
								</div>
							</td>
						</tr>
					<?php endif; ?>
					<?php foreach ($mahasiswa as $u) : ?>
						<tr>
							<th scope="row"><?= ++$start; ?></th>
							<td><?= $u['nim']; ?></td>
							<td><?= $u['nama']; ?></td>
							<td><?= $u['prodi']; ?></td>
							<td><?= $u['username']; ?></td>
							<td>
								<a href="" data-toggle="modal" data-target="#mahasiswaEdit<?= $u['nim'] ?>" class="btn btn-success btn-sm"><i class="fa fa-fw fa-edit"></i>Edit</a>
								<a href="<?= base_url() . 'administrator/deleteMahasiswa/' . $u['nim'] ?>" data-nama="<?= $u['nama']; ?>" class="btn btn-danger btn-sm deleteP"><i class="fa fa-fw fa-trash"></i>Delete</a>
							</td>
						</tr>
					<?php endforeach; ?>
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

<?php foreach ($mahasiswa as $u) : ?>

	<!-- Modal Edit -->
	<div class="modal fade" id="mahasiswaEdit<?= $u['nim'] ?>" tabindex="-1" role="dialog" aria-labelledby="mahasiswaEditLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="mahasiswaEditLabel">Edit Data Mahasiswa</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form action="<?= base_url('administrator/updateMahasiswa/' . $u['nim']); ?>" method="POST">
					<div class="modal-body">
						<div class="form-group">
							<label for="nip">NIM</label>
							<input type="number" class="form-control" id="nim" name="nim" value="<?= $u['nim']; ?>">
							<?= form_error('nim', '<div class="alert-danger" role="alert">', '</div>'); ?>
						</div>
						<div class="form-group">
							<label for="nama">Nama</label>
							<input type="text" class="form-control" id="nama" name="nama" value="<?= $u['nama']; ?>">
							<?= form_error('nama', '<div class="alert-danger" role="alert">', '</div>'); ?>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">Edit</button>
					</div>
				</form>
			</div>
		</div>
	</div>


<?php endforeach; ?>
<!-- Modal Tambah Mahasiswa -->
<div class="modal fade" id="mahasiswaBaru" tabindex="-1" role="dialog" aria-labelledby="mahasiswaBaruLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="mahasiswaBaruLabel">Tambah Mahasiswa</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<form action="<?= base_url('administrator/daftarMahasiswa'); ?>" method="POST">
				<div class="modal-body">
					<div class="form-group">
						<input type="number" class="form-control" name="nim" id="nim" placeholder="NIM Mahasiswa">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Mahasiswa">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" name="email" id="email" placeholder="Email Mahasiswa">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Tambah</button>
				</div>
			</form>

		</div>
	</div>
</div>
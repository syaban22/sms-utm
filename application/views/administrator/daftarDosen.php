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
			<a href="" class="btn btn-sm btn-primary mb-3" data-toggle="modal" data-target="#dosenBaru"><i class="fas fa-fw fa-plus-square"></i> Tambah Dosen</a>
			<nav class="navbar navbar-light bg-light">
				<?php
													if ($keyword == null) {
														echo '<a class="navbar-brand">Total : ' . $total_rows . '</a>';
													} else {
														echo '<a class="navbar-brand">Hasil Pencarian : ' . $total_rows . '</a>';
													}
				?>

				<form class="form-inline" action="<?= base_url('administrator/daftarDosen'); ?>" method="post">
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
						<th scope="col">NIP</th>
						<th scope="col">Nama</th>
						<th scope="col">Program Studi</th>
						<th scope="col">Username</th>
						<th scope="col">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php if (empty($dosen)) : ?>
						<tr>
							<td colspan="12">
								<div class="alert alert-danger" role="alert">
									Data not found!
								</div>
							</td>
						</tr>
					<?php endif; ?>
					<?php foreach ($dosen as $u) : ?>
						<tr>
							<th scope="row"><?= ++$start; ?></th>
							<td><?= $u['nip']; ?></td>
							<td><?= $u['nama']; ?></td>
							<td><?= $u['prodi']; ?></td>
							<td><?= $u['username']; ?></td>
							<td>
								<a href="" data-toggle="modal" data-target="#pelamarEdit<?= $u['nip'] ?>" class="btn btn-success btn-sm"><i class="fa fa-fw fa-edit"></i>Edit</a>
								<a href="<?= base_url() . 'administrator/deleteDosen/' . $u['nip'] ?>" data-nama="<?= $u['nama']; ?>" class="btn btn-danger btn-sm deleteP"><i class="fa fa-fw fa-trash"></i>Delete</a>
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

<?php foreach ($dosen as $u) : ?>

	<!-- Modal Edit -->
	<div class="modal fade" id="pelamarEdit<?= $u['nip'] ?>" tabindex="-1" role="dialog" aria-labelledby="pelamarEditLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="pelamarEditLabel">Edit Data Pelamar</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form action="<?= base_url('administrator/updateDosen/' . $u['nip']); ?>" method="POST">
					<div class="modal-body">
						<div class="form-group">
							<label for="nip">NIP</label>
							<input type="text" class="form-control" id="nip" name="nip" value="<?= $u['nip']; ?>">
							<?= form_error('nip', '<div class="alert-danger" role="alert">', '</div>'); ?>
						</div>
						<div class="form-group">
							<label for="nama">Nama</label>
							<input type="text" class="form-control" id="nama" name="nama" value="<?= $u['nama']; ?>">
							<?= form_error('nama', '<div class="alert-danger" role="alert">', '</div>'); ?>
						</div>
						<div class="form-group">
							<label for="username">Username</label>
							<select name="username" id="username" class="form-control">
								<option>- Pilih Username -</option>
								<?php foreach ($username as $us) {
																														if ($u['username'] == $us['username']) {
																															echo "<option value='$us[id]' selected>$u[username]</option>";
																														} else {
																															echo "<option value='$us[id]'>$us[username]</option>";
																														}
																													}
								?>
							</select>
							<?= form_error('username', '<div class="alert-danger" role="alert">', '</div>'); ?>
						</div>

						<div class="form-group">
							<label for="prodi">Program Studi</label>
							<select name="prodi" id="prodi" class="form-control">
								<option>- Pilih Program Studi -</option>
								<?php foreach ($prodi as $p) {
																														if ($p['prodi'] == $u['prodi']) {
																															echo "<option value='$p[kode_prodi]' selected>$u[prodi]</option>";
																														} else {
																															echo "<option value='$p[kode_prodi]'>$p[prodi]</option>";
																														}
																													}
								?>

							</select>
							<?= form_error('prodi', '<div class="alert-danger" role="alert">', '</div>'); ?>
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
<!-- Modal Tambah Prodi -->
<div class="modal fade" id="dosenBaru" tabindex="-1" role="dialog" aria-labelledby="dosenBaruLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="dosenBaruLabel">Tambah Dosen</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<form action="<?= base_url('administrator/daftarDosen'); ?>" method="POST">
				<div class="modal-body">
					<div class="form-group">
						<input type="text" class="form-control" name="nip" id="nip" placeholder="NIP Dosen">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Dosen">
					</div>
					<div class="form-group">
						<select name="prodi" id="prodi" class="form-control">
							<option value="">- Pilih Prodi -</option>
							<?php foreach ($prodi as $f) : ?>
								<option value="<?= $f['kode_prodi']; ?>"><?= $f['prodi']; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="form-group">
						<select name="username" id="username" class="form-control">
							<option value="">- Pilih Username -</option>
							<?php foreach ($username as $f) : ?>
								<option value="<?= $f['id']; ?>"><?= $f['username']; ?> <?= '=> ' ?><?= $f['nama']; ?> </option>
							<?php endforeach; ?>
						</select>
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
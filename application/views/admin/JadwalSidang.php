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
			<a href="" class="btn btn-sm btn-primary mb-3" data-toggle="modal" data-target="#JadwalSidangBaru"><i class="fas fa-fw fa-plus-square"></i> Tambah Jadwal Sidang</a>
			<nav class="navbar navbar-light bg-light">
				<?php
				if ($keyword == null) {
					echo '<a class="navbar-brand">Total : ' . $total_rows . '</a>';
				} else {
					echo '<a class="navbar-brand">Hasil Pencarian : ' . $total_rows . '</a>';
				}
				?>

				<form class="form-inline" action="<?= base_url('admin/JadwalSidang'); ?>" method="post">
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
						<th scope="col">Judul Skripsi</th>
						<th scope="col">Tanggal Sidang</th>
						<th scope="col">Waktu</th>
						<th scope="col">Periode</th>
						<th scope="col">Penguji 1</th>
						<th scope="col">Penguji 2</th>
						<th scope="col">Penguji 3</th>
						<th scope="col">Ruangan</th>
						<th scope="col">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php if (empty($JSid)) : ?>
						<tr>
							<td colspan="12">
								<div class="alert alert-danger" role="alert">
									Data not found!
								</div>
							</td>
						</tr>
					<?php endif; ?>
					<?php foreach ($JSid as $u) : ?>
						<tr>
							<th scope="row"><?= ++$start; ?></th>
							<td><?= $u['judul']; ?></td>
							<td><?= $u['tanggal']; ?></td>
							<td><?= $u['waktu']; ?></td>
							<td><?= $u['periode']; ?></td>
							<td><?= $u['penguji1']; ?></td>
							<td><?= $u['penguji2']; ?></td>
							<td><?= $u['penguji3']; ?></td>
							<td><?= $u['ruangan']; ?></td>
							<td>
								<a href="" data-toggle="modal" data-target="#JadwalSidangEdit<?= $u['id'] ?>" class="btn btn-success btn-sm"><i class="fa fa-fw fa-edit"></i>Edit</a>
								<a href="<?= base_url() . 'admin/deleteJadwalSidang/' . $u['id'] ?>" data-nama="<?= $u['judul']; ?>" class="btn btn-danger btn-sm deleteJS"><i class="fa fa-fw fa-trash"></i>Delete</a>
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

<?php foreach ($JSid as $u) : ?>
	<!-- Modal Edit -->
	<div class="modal fade" id="JadwalSidangEdit<?= $u['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="JadwalSidangEditLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="JadwalSidangEditLabel">Edit Jadwal Sidang</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form action="<?= base_url('admin/EditJadwalSidang/' . $u['id']); ?>" method="POST">
					<div class="modal-body">
						<div class="form-group">
							<div class="name mb-3">Judul Skripsi</div>
							<select class="form-control value" name="judul" id="judul" onchange="">
								<?php foreach ($skripsi as $s) {
									if ($u['judul'] == $s['judul']) {
										echo "<option value='$s[id]' selected>$s[judul]</option>";
									} else {
										echo "<option value='$s[id]'>$s[judul]</option>";
									}
								}
								?>
							</select>
							<!-- <?= form_error('judul', '<div class="alert-danger" role="alert">', '</div>'); ?> -->
						</div>
						<div class="form-group">
							<label for="Tgl">Tanggal Sidang</label>
							<input type="text" class="form-control" id="tanggal" name="tanggal" value="<?= $u['tanggal']; ?>">
							<!-- <?= form_error('tanggal', '<div class="alert-danger" role="alert">', '</div>'); ?> -->
						</div>
						<div class="form-group">
							<label for="waktu">Waktu Sidang</label>
							<input type="text" class="form-control" id="waktu" name="waktu" value="<?= $u['waktu']; ?>">
							<!-- <?= form_error('waktu', '<div class="alert-danger" role="alert">', '</div>'); ?> -->
						</div>
						<div class="form-group">
							<label for="periode">Periode</label>
							<input type="text" class="form-control" id="periode" name="periode" value="<?= $u['periode']; ?>">
							<!-- <?= form_error('periode', '<div class="alert-danger" role="alert">', '</div>'); ?> -->
						</div>
						<div class="form-group">
							<div class="name mb-3">Dosen Penguji 1</div>
							<select class="form-control value" name="penguji1" id="penguji1" onchange="">
								<?php foreach ($dosen as $p) {
									if ($u['penguji_1'] == $p['nip']) {
										echo "<option value='$p[nip]' selected>$p[nama]</option>";
									} else {
										echo "<option value='$p[nip]'>$p[nama]</option>";
									}
								}
								?>
							</select>
							<!-- <?= form_error('penguji1', '<div class="alert-danger" role="alert">', '</div>'); ?> -->
						</div>
						<div class="form-group">
							<div class="name mb-3">Dosen Penguji 2</div>
							<select class="form-control value" name="penguji2" id="penguji2" onchange="">
								<?php foreach ($dosen as $p) {
									if ($u['penguji_2'] == $p['nip']) {
										echo "<option value='$p[nip]' selected>$p[nama]</option>";
									} else {
										echo "<option value='$p[nip]'>$p[nama]</option>";
									}
								}
								?>
							</select>
							<!-- <?= form_error('penguji2', '<div class="alert-danger" role="alert">', '</div>'); ?> -->
						</div>
						<div class="form-group">
							<div class="name mb-3">Dosen Penguji 3</div>
							<select class="form-control value" name="penguji3" id="penguji3" onchange="">
								<?php foreach ($dosen as $p) {
									if ($u['penguji_3'] == $p['nip']) {
										echo "<option value='$p[nip]' selected>$p[nama]</option>";
									} else {
										echo "<option value='$p[nip]'>$p[nama]</option>";
									}
								}
								?>
							</select>
							<?= form_error('penguji3', '<div class="alert-danger" role="alert">', '</div>'); ?>
						</div>
						<div class="form-group">
							<label for="ruangan">Ruangan Sidang</label>
							<input type="text" class="form-control" id="ruangan" name="ruangan" value="<?= $u['ruangan']; ?>">
							<!-- <?= form_error('ruangan', '<div class="alert-danger" role="alert">', '</div>'); ?> -->
						</div>
					</div>
					<!-- Dosbing 1-2 -->
					<!-- penguji 1-3 -->

					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">Edit</button>
					</div>
				</form>
			</div>
		</div>
	</div>


<?php endforeach; ?>

<!-- Modal Tambah Jadwal -->
<div class="modal fade" id="JadwalSidangBaru" tabindex="-1" role="dialog" aria-labelledby="JadwalSidangBaruLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="JadwalSidangBaruLabel">Tambah JadwalSidang</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<form action="<?= base_url('admin/JadwalSidang'); ?>" method="POST" class="needs-validation" novalidate>
				<div class="modal-body">
					<div class="form-group">
						<div class="name mb-3">Judul Skripsi</div>
						<select class="form-control value" name="judul" id="judul" onchange="" required>
							<option value="">- Pilih Judul -</option>
							<?php foreach ($skripsi as $j) : ?>
								<option value="<?= $j['id']; ?>"><?= $j['judul']; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="form-group">
						<input type="text" class="form-control" name="tanggal" id="tanggal" placeholder="Tanggal Sidang Sidang" required>
						<div class="invalid-feedback">
							Masukan Tanggal Sidang
						</div>
					</div>
					<div class="form-group">
						<input type="text" class="form-control" name="waktu" id="waktu" placeholder="Waktu Sidang Sidang" required>
						<div class="invalid-feedback">
							Masukan Waktu Sidang
						</div>
					</div>
					<div class="form-group">
						<input type="text" class="form-control" name="periode" id="periode" placeholder="Periode" required>
						<div class="invalid-feedback">
							Masukan Periode Sidang
						</div>
					</div>
					<div class="form-group">
						<select name="penguji1" id="penguji1" class="form-control" required>
							<option value="">- Pilih Dosen Penguji 1 -</option>
							<?php foreach ($dosen as $f) : ?>
								<option value="<?= $f['nip']; ?>"><?= $f['nama']; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="form-group">
						<select name="penguji2" id="penguji2" class="form-control" required>
							<option value="">- Pilih Dosen Penguji 2 -</option>
							<?php foreach ($dosen as $f) : ?>
								<option value="<?= $f['nip']; ?>"><?= $f['nama']; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="form-group">
						<select name="penguji3" id="penguji3" class="form-control" required>
							<option value="">- Pilih Dosen Penguji 3 -</option>
							<?php foreach ($dosen as $f) : ?>
								<option value="<?= $f['nip']; ?>"><?= $f['nama']; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="form-group">
						<input type="text" class="form-control" name="ruangan" id="ruangan" placeholder="Ruangan Sidang Sidang" required>
						<div class="invalid-feedback">
							Masukan Ruangan Sidang
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
<!-- Modal tambah penguji -->
<?php foreach ($JSid as $u) : ?>
	<!-- Modal Tambah Penguji1 -->
	<div class="modal fade" id="penguji1<?= $u['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="pengujiLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="pengujiLabel">Tentukan Penguji</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>

				<form action="<?= base_url('admin/updatePenguji/') . $u['id']; ?>" method="POST">
					<div class="modal-body">
						<div class="form-group">
							<select name="penguji1" id="penguji1" class="form-control">
								<option value="">- Pilih Penguji 1 -</option>
								<?php foreach ($penguji as $p) : ?>
									<option value="<?= $p['nip']; ?>"><?= $p['nama']; ?> </option>
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
	<!-- Modal Tambah Penguji2 -->
	<div class="modal fade" id="penguji2<?= $u['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="pengujiLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="pengujiLabel">Tentukan Penguji</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>

				<form action="<?= base_url('admin/updatePenguji/') . $u['id']; ?>" method="POST">
					<div class="modal-body">
						<div class="form-group">
							<select name="penguji2" id="penguji2" class="form-control">
								<option value="">- Pilih Penguji 2 -</option>
								<?php foreach ($penguji as $p) : ?>
									<option value="<?= $p['nip']; ?>"><?= $p['nama']; ?> </option>
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
	<!-- Modal Tambah Penguji3 -->
	<div class="modal fade" id="penguji3<?= $u['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="pengujiLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="pengujiLabel">Tentukan Penguji</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>

				<form action="<?= base_url('admin/updatePenguji/') . $u['id']; ?>" method="POST">
					<div class="modal-body">
						<div class="form-group">
							<select name="penguji3" id="penguji3" class="form-control">
								<option value="">- Pilih Penguji 3 -</option>
								<?php foreach ($penguji as $p) : ?>
									<option value="<?= $p['nip']; ?>"><?= $p['nama']; ?> </option>
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
<?php endforeach; ?>
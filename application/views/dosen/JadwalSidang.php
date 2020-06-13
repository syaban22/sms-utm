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
			<!-- <a href="" class="btn btn-sm btn-primary mb-3" data-toggle="modal" data-target="#JadwalSidangBaru"><i class="fas fa-fw fa-plus-square"></i> Tambah Jadwal Sidang</a> -->
			<nav class="navbar navbar-light bg-light">
				<!-- <?php
				if ($keyword == null) {
					echo '<a class="navbar-brand">Total : ' . $total_rows . '</a>';
				} else {
					echo '<a class="navbar-brand">Hasil Pencarian : ' . $total_rows . '</a>';
				}
				?> -->
				<a class="navbar-brand"></a>

				<form class="form-inline" action="<?= base_url('dosen/JadwalSidang'); ?>" method="post">
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
						<th scope="col">Nilai</th>
					</tr>
				</thead>
				<tbody>
					<?php $count=0;
					foreach ($JSid as $u) : 
						if($u['status']=='5'){ 
							$count+=1;
							?>
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
							<?php if ($u['nilai']==NULL){ ?>
							<td><a href="" data-toggle="modal" data-target="#nilai<?= $u['id'] ?>" class="btn btn-success btn-sm"><i class="fa fa-fw fa-edit"></i>Berikan nilai</a>
							<a href="<?= base_url() . 'dosen/UlangSidang/' . $u['id'] ?>" class="btn btn-warning btn-sm ulangsempro"><i class="fa fa-fw fa-exclamation-triangle"></i>Ulang</a></td>

							<?php } else { ?>
								<td><?= $u['nilai']; ?></td>
							<?php } ?>
						</tr>
					<?php } endforeach;
					if ($count==0) : ?>
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
<?php foreach ($JSid as $u) : ?>
<!-- Modal Masukkan Nilai -->
<div class="modal fade" id="nilai<?= $u['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="JadwalSidangBaruLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="JadwalSidangBaruLabel">Tambah JadwalSidang</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<form action="<?= base_url('dosen/JadwalSidang'); ?>" method="POST" class="needs-validation" novalidate>
				<div class="modal-body">
					
					<div class="form-group">
						<input type="hidden" class="form-control" name="id" value="<?= $u['id']?>" required>
						<input type="number" class="form-control" name="nilai" placeholder="nilai" required>
						<div class="invalid-feedback">
							Masukan Nilai
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">kirim</button>
					</div>
				</div>
			</form>

		</div>
	</div>
</div>
<?php endforeach; ?>
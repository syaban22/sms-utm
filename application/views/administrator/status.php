<!-- Begin Page Content -->
<div class="container-fluid">
	<div class="flash-data" data-flashdata="<?= $this->session->flashdata('pesan'); ?>"></div>
	<!-- Page Heading -->
	<div>
		<div class="row">
			<div class="col-md">
				<h1 class="h3 mb-4 text-gray-800"><?= $judul; ?></h1>
			</div>
			<div class="col-md-3">
				<nav aria-label="breadcrumb">
					<p>
						<span class="posisi"><i class="fa fa-dashboard fa-md"></i> &nbsp<b><a href="<?= base_url('administrator');  ?>">Dashboard</a></b>
							&nbsp<i class="fa fa-angle-right fa-md"></i>&nbsp<span><b><?= $judul; ?></b></span>
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

				<form class="form-inline" action="<?= base_url('administrator/getStatus'); ?>" method="post">
					<input class="form-control mr-sm-2" type="search" placeholder="Search Name" name="keyword" autocomplete="off" autofocus>
					<input type="submit" class="btn btn-primary" name="submit" value="Search">

				</form>
			</nav>
		</div>
	</div> -->
	<a href="" class="btn btn-sm btn-primary mb-3" data-toggle="modal" data-target="#StatusBaru"><i class="fas fa-fw fa-plus-square"></i> Tambah Status Baru</a>

	<div class="row">
		<div class="col-6">
			<!-- <?php if (validation_errors()) : ?>
				<div class="alert alert-danger" role="alert">
					<?= validation_errors(); ?>
				</div>
			<?php endif; ?> -->


			<table class="table table-hover">
				<thead>
					<tr>
						<th scope="col">No</th>
						<th scope="col">Kode Status</th>
						<th scope="col">Keterangan Status</th>
						<th scope="col">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php if (empty($status)) : ?>
						<tr>
							<td colspan="12">
								<div class="alert alert-danger" role="alert">
									Data not found!
								</div>
							</td>
						</tr>
					<?php endif; ?>

					<?php foreach ($status as $p) : ?>
						<tr>
							<th scope="row"><?= ++$start; ?></th>
							<td><?= $p['id']; ?></td>
							<td><?= $p['ket']; ?></td>
							<td>
								<a href="" class="btn btn-success btn-sm" data-toggle="modal" data-target="#StatusEdit<?= $p['id'] ?>"><i class="fa fa-fw fa-edit"></i>Edit</a>
								<a href="<?= base_url('administrator/deleteStatus/' . $p['id']) ?>" data-nama="<?= $p['ket']; ?>" class="btn btn-danger btn-sm deleteStatus"><i class="fa fa-fw fa-trash"></i>Delete</a>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
			<?= $this->pagination->create_links(); ?>
		</div>
	</div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->


<!-- Modal tambah -->
<div class="modal fade" id="StatusBaru" tabindex="-1" role="dialog" aria-labelledby="StatusBaruLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="StatusBaruLabel">Tambah Status Baru</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<form action="<?= base_url('administrator/getStatus'); ?>" method="POST" class="needs-validation" novalidate>
				<div class="modal-body">
					<div class="form-group">
						<input type="text" class="form-control" name="Kode" id="Kode" placeholder="Kode Status" required>
						<div class="invalid-feedback">
							Masukan Kode Status
						</div>
					</div>
					<div class="form-group">
						<input type="text" class="form-control" name="Status" id="Status" placeholder="Nama Status" required>
						<div class="invalid-feedback">
							Masukan Nama Status
						</div>
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

<?php foreach ($status as $p) : ?>

	<!-- Modal Edit -->
	<div class="modal fade" id="StatusEdit<?= $p['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="StatusEditLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="StatusEditLabel">Edit Menu</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>

				<form action="<?= base_url('administrator/updateStatus/' . $p['id']); ?>" method="POST">
					<div class="modal-body">
						<div class="form-group">
							<input type="text" class="form-control" name="StatusU" id="StatusU" value="<?= $p['ket'] ?>">
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
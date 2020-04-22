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

				<form class="form-inline" action="<?= base_url('administrator/getJenkel'); ?>" method="post">
					<input class="form-control mr-sm-2" type="search" placeholder="Search Name" name="keyword" autocomplete="off" autofocus>
					<input type="submit" class="btn btn-primary" name="submit" value="Search">

				</form>
			</nav>
		</div>
	</div> -->
	<a href="" class="btn btn-sm btn-primary mb-3" data-toggle="modal" data-target="#JenkelBaru"><i class="fas fa-fw fa-plus-square"></i> Tambah Jenkel Baru</a>

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
						<th scope="col">Jenis Kelamin</th>
						<th scope="col">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php if (empty($jenkel)) : ?>
						<tr>
							<td colspan="12">
								<div class="alert alert-danger" role="alert">
									Data not found!
								</div>
							</td>
						</tr>
					<?php endif; ?>

					<?php foreach ($jenkel as $p) : ?>
						<tr>
							<th scope="row"><?= ++$start; ?></th>
							<td><?= $p['jenis']; ?></td>
							<td>
								<a href="" class="btn btn-success btn-sm" data-toggle="modal" data-target="#JenkelEdit<?= $p['id'] ?>"><i class="fa fa-fw fa-edit"></i>Edit</a>
								<a href="<?= base_url('administrator/deleteJenkel/' . $p['id']) ?>" data-nama="<?= $p['jenis']; ?>" class="btn btn-danger btn-sm deleteJenkel"><i class="fa fa-fw fa-trash"></i>Delete</a>
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
<div class="modal fade" id="JenkelBaru" tabindex="-1" role="dialog" aria-labelledby="JenkelBaruLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="JenkelBaruLabel">Tambah Jenkel Baru</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<form action="<?= base_url('administrator/getJenkel'); ?>" method="POST" class="needs-validation" novalidate>
				<div class="modal-body">
					<div class="form-group">
						<input type="text" class="form-control" name="Jenkel" id="Jenkel" placeholder="Nama Jenkel" required>
						<div class="invalid-feedback">
							Masukan Nama Jenkel
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

<?php foreach ($jenkel as $p) : ?>

	<!-- Modal Edit -->
	<div class="modal fade" id="JenkelEdit<?= $p['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="JenkelEditLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="JenkelEditLabel">Edit Menu</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>

				<form action="<?= base_url('administrator/updateJenkel/' . $p['id']); ?>" method="POST">
					<div class="modal-body">
						<div class="form-group">
							<input type="text" class="form-control" name="JenkelU" id="JenkelU" value="<?= $p['jenis'] ?>">
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
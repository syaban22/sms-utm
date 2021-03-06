<!-- Begin Page Content -->
<script type="text/javascript" src="<?= base_url('assets/'); ?>js/mhs.js"></script>
<div class="page-wrapper bg-darkl p-t-100 p-b-50">
	<div class="wrapper wrapper--w900">
		<div class="card card-6">
			<div class="card-heading">
				<h2 class='title'>Daftarkan Skripsi</h2>
				<!-- 
					nampilkan kode fak dan kode prodi dari nim
				<?= "kode fakultas : ", $kodefakultas; ?>
				<?= "kode prodi : ", $kodeprodi; ?> 
				-->
			</div>
			<div class="card-body">
				<form method="POST" action="<?= base_url('Mahasiswa/DaftarkanSkripsi'); ?>" enctype="multipart/form-data">
					<div class="form-row">
						<div class="name">Judul Skripsi</div>
						<div class="value">
							<input class="input--style-6" type="text" name="judul" placeholder="Judul">
							<?= form_error('judul', '<div class="alert-danger mt-2" role="alert">', '</div>'); ?>
						</div>
					</div>
					<div class=" form-row">
						<div class="name">Abstract</div>
						<div class="value">
							<textarea rows="4" cols="50" class="input--style-6" name="abstract" placeholder="Abstract"></textarea>
							<?= form_error('abstract', '<div class="alert-danger mt-2" role="alert">', '</div>'); ?>
						</div>
					</div>
					<div class="form-row">
						<div class="name">Dosen Pembimbing 1</div>
						<div class="value">
							<div class="input-group">
								<select class="input--style-6" name="dosbing1" id="dosbing1" onchange="dosbingX()">
									<option value="">- Pilih Dosen Pembimbing 1 -</option>
									<?php foreach ($dosen as $d) : ?>
										<option value="<?= $d['nip']; ?>"><?= $d['nama']; ?></option>
									<?php endforeach; ?>
								</select>
								<?= form_error('dosbing1', '<div class="alert-danger mt-2" role="alert">', '</div>'); ?>
							</div>
						</div>
					</div>
					<div class="form-row">
						<div class="name">Dosen Pembimbing 2</div>
						<div class="value">
							<div class="input-group">
								<select class="input--style-6" name="dosbing2" id="dosbing2" onchange="dosbingX()">
									<option value="">- Pilih Dosen Pembimbing 2 -</option>
									<?php $i = 0;
									foreach ($dosen as $d) : ?>
										<option class="<?= $i; ?>" value="<?= $d['nip']; ?>"><?= $d['nama']; ?></option>
									<?php $i += 1;
									endforeach; ?>
								</select>
								<?= form_error('dosbing2', '<div class="alert-danger mt-2" role="alert">', '</div>'); ?>
							</div>
						</div>
					</div>
					<!-- patokan untuk js -->
					<span style="display : none">
						<select type="hidden" class="input--style-6" name="dosbing" id="dosbing" onchange="">
							<?php foreach ($dosen as $d) : ?>
								<option value="<?= $d['nip']; ?>"><?= $d['nama']; ?></option>
							<?php endforeach; ?>
						</select>
					</span>
					<!-- end of patokan -->
					<div class="form-row">
						<div class="name">Upload Berkas Persyaratan Skripsi</div>
						<div class="value">
							<div class="input-group js-input-file">
								<input class="input-file" type="file" name="file" id="file">
								<label class="label--file" for="file">Choose file</label>
								<span class="input-file__info">No file chosen</span>
							</div>
							<div class="label--desc">Upload Berkas Persyaratan Skripsi (.doc/.docx/.pdf). Max file size
								2 MB</div>
							<div class="alert-danger mt-2" role="alert"> <?= $error; ?></div>
						</div>
					</div>
			</div>
			<div class="card-footer">
				<button class="btn btn--radius-2 btn--blue-2" type="submit">Daftarkan</button>
				<a class="btn btn--radius-2 btn--red-2" type="submit" href="<?= base_url('Mahasiswa'); ?>">Cancel</a>
				</form>
			</div>
		</div>
	</div>
</div>

<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
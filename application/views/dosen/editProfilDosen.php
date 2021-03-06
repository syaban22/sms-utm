        <!-- Begin Page Content -->
        <div class="container-fluid">
          <div class="flash-data" data-flashdata="<?= $this->session->flashdata('pesan'); ?>"></div>
          <!-- Page Heading -->
          <div class="card-header border-bottom-warning">
          </div>
          <h1 class="h3 mb-4 text-gray-800"><?= $judul; ?></h1>
          <p class="mb-4">Halaman untuk mengubah Profil</a>.</p>
          <?php if (validation_errors()) : ?>
            <div class="alert alert-danger" role="alert">
              <?= validation_errors(); ?>
            </div>
          <?php endif; ?>
          <?php $e = $profil ?>
          <form action="<?= base_url('dosen/updateProfil/') . $e['username']; ?>" method="post">
            <h3>A. Data Pribadi</h3>
            <table class="table table-striped table-middle">
              <tr>
                <th width="20%">Nama Dosen</th>
                <td width="1%">:</td>
                <td><input type="text" class="form-control" name="namaD" value="<?php echo $e['nama'] ?>"></td>
              </tr>
              <tr>
                <th>Tanggal Lahir</th>
                <td>:</td>
                <td><input type="date" name="tglD" value="<?php echo $e['tanggal_lahir'] ?>"></td>
              </tr>
              <tr>
                <th>Jenis Kelamin</th>
                <td>:</td>
                <td><input type="text" class="form-control" name="jenkelD" value="<?php echo $e['Jenis_Kelamin'] ?>"></td>
              </tr>
              <tr>
                <th>Alamat</th>
                <td>:</td>
                <td><input type="text" class="form-control" name="alamatD" value="<?php echo $e['Alamat'] ?>"></td>
              </tr>
              <tr>
                <th>Email</th>
                <td>:</td>
                <td><input type="text" class="form-control datepicker" name="emailD" value="<?php echo $e['email'] ?>"></td>
              </tr>
              <tr>
                <th>No HP</th>
                <td>:</td>
                <td><input type="text" class="form-control datepicker" name="nohpD" value="<?php echo $e['No_HP'] ?>"></td>
              </tr>
            </table>

            <button type="submit" class="btn btn-primary btn-lg">
              <i class="fa fa-fw fa-save"></i> Simpan
            </button>
            <input type="hidden" name="id_mahasiswa" value="<?php echo $e['username'] ?>">
          </form>
        </div>
        <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->
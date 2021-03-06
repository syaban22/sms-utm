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

                <form class="form-inline" action="<?= base_url('dosen/getMahasiswa'); ?>" method="post">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search Name" name="keyword" autocomplete="off" autofocus>
                    <input type="submit" class="btn btn-primary" name="submit" value="Search">

                </form>
            </nav>
        </div>
    </div> -->
    <div class="row">
        <div class="col-md">
            <table class="table table-hover" id="perus">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">NIM</th>
                        <th scope="col">Dosbing1</th>
                        <th scope="col">Dosbing2</th>
                        <th scope="col">Prodi</th>
                        <th scope="col">Nilai</th>
                        <!-- <th scope="col">Action</th> -->
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($skripsi)) { ?>
                        <tr>
                            <td colspan="12">
                                <div class="alert alert-danger" role="alert">
                                    Data not found!
                                </div>
                            </td>
                        </tr>
                    <?php } else{ ?>
                    <?php $start=0; foreach ($skripsi as $u) : ?>
                        <tr>
                            <th scope="row"><?= ++$start; ?></th>
                            <td><?= $u['nama']; ?></td>
                            <td><?= $u['nim']; ?></td>
                            <td><?= $u['dosbing1']; ?></td>
                            <td><?= $u['dosbing2']; ?></td>
                            <td><?= $u['prodi']; ?></td>
                            <?php if ($u['nilai'] != 0) : ?>
                                <td><?= $u['nilai']; ?></td>
                            <?php else : ?>
                                <td>N/A</td>
                            <?php endif; ?>
                            <!-- <td>
                                <a href="" data-toggle="modal" data-target="#pelamarEdit<?= $u['id'] ?>" class="btn btn-success btn-sm"><i class="fa fa-fw fa-edit"></i>Edit</a>
                                <a href="<?= base_url() . 'administrator/deleteU/' . $u['id'] ?>" data-nama="<?= $u['nama']; ?>" class="btn btn-danger btn-sm deleteP"><i class="fa fa-fw fa-trash"></i>Delete</a>
                            </td> -->
                        </tr>
                    <?php endforeach; }?>
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

<!-- sepertinya tidak perlu modal edit -->
<!-- <?php if (!empty($skripsi)) { foreach ($users as $u) : ?>

    <!-- Modal Edit -->
<div class="modal fade" id="pelamarEdit<?= $u['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="pelamarEditLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pelamarEditLabel">Edit Data Pelamar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('administrator/updateU/' . $u['id']); ?>" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="<?= $u['nama']; ?>">
                        <?= form_error('nama', '<div class="alert-danger" role="alert">', '</div>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" value="<?= $u['username']; ?>">
                        <?= form_error('alamat', '<div class="alert-danger" role="alert">', '</div>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="level">Level</label>
                        <select name="level" id="level" class="form-control">

                            <?php foreach ($level as $l) {
                                if ($p['level_id'] == $l['id']) {
                                    echo "<option value='$l[id]' selected>$l[level]</option>";
                                } else {
                                    echo "<option value='$l[id]'>$l[level]</option>";
                                }
                            }
                            ?>

                        </select>
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

<?php endforeach; }?> 
-->
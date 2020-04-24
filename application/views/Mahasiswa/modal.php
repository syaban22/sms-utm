<?php foreach ($skripsi as $u) :
    if ($u['nim'] == $this->session->userdata('username')) { ?>
        <!-- modal detail -->
        <div class="modal fade displaycontent" id="detail<?= $u['id'] ?>">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Detail Skripsi <?php echo $u['nama']; ?></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <td>Judul</td>
                                    <td><?php echo $u['judul']; ?></td>
                                </tr>
                                <tr>
                                    <td>Abstrak</td>
                                    <td><?php echo $u['abstract']; ?></td>
                                </tr>
                                <tr>
                                    <td>Dosen Pembimbing 1</td>
                                    <td><?php echo $u['dosbing1']; ?></td>
                                </tr>
                                <tr>
                                    <td>Dosen Pembimbing2</td>
                                    <td><?php echo $u['dosbing2']; ?></td>
                                </tr>
                                <tr>
                                    <td>Prodi</td>
                                    <td><?php echo $u['prodi']; ?></td>
                                </tr>
                                <tr>
                                    <td>status</td>
                                    <td><?php echo $u['status']; ?></td>
                                </tr>
                                <tr>
                                    <td>Nilai</td>
                                    <?php if ($u['nilai'] != 0) : ?>
                                        <td><?= $u['nilai']; ?></td>
                                    <?php else : ?>
                                        <td>N/A</td>
                                    <?php endif; ?>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- end modal detail -->
<?php }
endforeach; ?>
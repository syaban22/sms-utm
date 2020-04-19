<!-- <div class="modal fade" tabindex="-1" id="myModal" role="dialog"> -->
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title">Detail Skripsi <?php echo $detail[0]['nama']; ?></h4>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    </div>
    <div class="modal-body">
      <table class="table table-striped">
        <tbody>
          <?php
          if (isset($detail) && is_array($detail) && count($detail)) : $i = 1;
            foreach ($detail as $key => $data) {
          ?>
              <tr>
                <td>Judul</td>
                <td><?php echo $data['judul']; ?></td>
              </tr>
              <tr>
                <td>Abstrak</td>
                <td><?php echo $data['abstract']; ?></td>
              </tr>
              <tr>
                <td>Dosen Pembimbing 1</td>
                <td><?php echo $data['dosbing1']; ?></td>
              </tr>
              <tr>
                <td>Dosen Pembimbing2</td>
                <td><?php echo $data['dosbing2']; ?></td>
              </tr>
              <tr>
                <td>Prodi</td>
                <td><?php echo $data['prodi']; ?></td>
              </tr>
              <tr>
                <td>Nilai</td>
                <td><?php echo $data['nilai']; ?></td>
              </tr>

          <?php
            }
          endif;
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

</div>
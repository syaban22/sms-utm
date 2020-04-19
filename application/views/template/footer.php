<!-- Footer -->
<footer class="sticky-footer bg-white">
  <div class="container my-auto">
    <div class="copyright text-center my-auto">
      <span>
        <font color="blue">Copyright &copy; Portal Sistem Manajemen Skripsi (SMS) Universitas Trunojoyo Madura <?= date('Y'); ?></font>
      </span>
    </div>
  </div>
</footer>
<!-- End of Footer -->
</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
  <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<!-- <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Keluar ?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">Pilih "Keluar" untuk melanjutkan</div>
      <div class="modal-footer">
        <button class="btn" type="button" data-dismiss="modal">Cancel</button>
        <a class="btn btn-secondary" href="<?= base_url('auth/logout'); ?>">Keluar</a>
      </div>
    </div>
  </div>
</div> -->

<!-- Bootstrap core JavaScript-->


<script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url('assets/'); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url('assets/'); ?>vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="<?= base_url('assets/'); ?>js/sweet/sweetalert2.all.min.js"></script>
<script src="<?= base_url('assets/'); ?>js/jsscript.js"></script>

<script type="text/javascript" src="<?= base_url('assets/'); ?>js/public_js/aos.js"></script>
<script type="text/javascript" src="<?= base_url('assets/'); ?>js/public_js/main.js"></script>

<script type="text/javascript" src="<?= base_url('assets/'); ?>js/global.js"></script>
<script type="text/javascript" src="<?= base_url('assets/'); ?>js/bootstrap-validate.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url('assets/'); ?>js/sb-admin-2.min.js"></script>
<script type="text/javascript" src="<?= base_url('assets/'); ?>js/mhs.js"></script>
<script>
  $('.form-check-input').on('click', function() {
    const menuId = $(this).data('menu');
    const levelId = $(this).data('level');

    $.ajax({
      url: "<?= base_url('administrator/rubahakses'); ?>",
      type: 'post',
      data: {
        menuId: menuId,
        levelId: levelId
      },
      success: function() {
        document.location.href = "<?= base_url('administrator/levelAkses/'); ?>" + levelId;
      }
    });
  });
</script>

<script>
  $('#ktp').on('change', function() {
    //get the file name
    var fileName = $(this).val();
    //replace the "Choose a file" label
    $(this).next('.custom-file-label').html(fileName);
  })
</script>

<script type="text/javascript" src="<?= base_url('assets/'); ?>js/validasi.js"></script>

<script src="<?= base_url('assets/'); ?>js/pop/js3.js"></script>
<script src="<?= base_url('assets/'); ?>js/pop/minjs3.js"></script>

<script type="text/javascript">
  $(document).ready(function() {

    $('.detail').click(function() {

      var id = $(this).attr('relid'); //get the attribute value

      $.ajax({
        url: "<?php echo base_url(); ?>Mahasiswa/getData",
        data: {
          id: id
        },
        method: 'GET',
        dataType: 'json',
        success: function(response) {
          $('#student_name').html(response.name); //hold the response in id and show on popup
          $('#student_email').html(response.email);
          $('#student_phone').html(response.phone);
          $('#show_modal').modal({
            backdrop: 'static',
            keyboard: true,
            show: true
          });
        }
      });
    });
  });
</script>



</body>

</html>
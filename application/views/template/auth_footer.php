<script src="<?= base_url('assets/') ?>js/public_js/jquery-3.3.1.min.js"></script>
<!-- Bootstrap core JavaScript-->
<script src="<?= base_url('assets/') ?>vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url('assets/') ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url('assets/') ?>vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="<?= base_url('assets/'); ?>js/sweet/sweetalert2.all.min.js"></script>
<script src="<?= base_url('assets/'); ?>js/jsscript.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url('assets/') ?>js/sb-admin-2.min.js"></script>


<script>
  $(function() {
    $('.refresh').click(function() {
      //alert('clicked');
      $.ajax({
        type: 'POST',
        url: '<?php echo base_url() ?>auth/refresh_captcha',
        success: function(res) {
          if (res) {
            $('.image').html(res);
          }
        }
      })
    });
  });
</script>
</body>

</html>
  <!-- Select2 -->
  <script src="<?php echo base_url(); ?>../style/plugins/select2/select2.full.min.js"></script>
  <!-- InputMask -->
  <script src="<?php echo base_url(); ?>../style/plugins/input-mask/jquery.inputmask.js"></script>
  <script src="<?php echo base_url(); ?>../style/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
  <script src="<?php echo base_url(); ?>../style/plugins/input-mask/jquery.inputmask.extensions.js"></script>
  <!-- date-range-picker -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
  <script src="<?php echo base_url(); ?>../style/plugins/daterangepicker/daterangepicker.js"></script>
  <!-- bootstrap datepicker -->
  <script src="<?php echo base_url(); ?>../style/plugins/datepicker/bootstrap-datepicker.js"></script>
  <!-- bootstrap color picker -->
  <script src="<?php echo base_url(); ?>../style/plugins/colorpicker/bootstrap-colorpicker.min.js"></script>
  <!-- bootstrap time picker -->
  <script src="<?php echo base_url(); ?>../style/plugins/timepicker/bootstrap-timepicker.min.js"></script>
  <!-- SlimScroll 1.3.0 -->
  <script src="<?php echo base_url(); ?>../style/plugins/slimScroll/jquery.slimscroll.min.js"></script>
  <!-- iCheck 1.0.1 -->
  <script src="<?php echo base_url(); ?>../style/plugins/iCheck/icheck.min.js"></script>
  <!-- Advanced Form -->
  <script>
    $(function () {
      //Initialize Select2 Elements
      $(".select2").select2();

      //Datemask dd/mm/yyyy
      $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
      //Datemask2 mm/dd/yyyy
      $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
      //Money Euro
      $("[data-mask]").inputmask();

      //Date range picker
      $('#reservation').daterangepicker();
      //Date range picker with time picker
      $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
      //Date range as a button
      $('#daterange-btn').daterangepicker(
          {
            ranges: {
              'Today': [moment(), moment()],
              'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
              'Last 7 Days': [moment().subtract(6, 'days'), moment()],
              'Last 30 Days': [moment().subtract(29, 'days'), moment()],
              'This Month': [moment().startOf('month'), moment().endOf('month')],
              'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            },
            startDate: moment().subtract(29, 'days'),
            endDate: moment()
          },
          function (start, end) {
            $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
          }
      );

      //Date picker
      $('#datepicker').datepicker({
        autoclose: true
      });

      //iCheck for checkbox and radio inputs
      $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
        checkboxClass: 'icheckbox_minimal-blue',
        radioClass: 'iradio_minimal-blue'
      });
      //Red color scheme for iCheck
      $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
        checkboxClass: 'icheckbox_minimal-red',
        radioClass: 'iradio_minimal-red'
      });
      //Flat red color scheme for iCheck
      $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
        checkboxClass: 'icheckbox_flat-green',
        radioClass: 'iradio_flat-green'
      });

      //Colorpicker
      $(".my-colorpicker1").colorpicker();
      //color picker with addon
      $(".my-colorpicker2").colorpicker();

      //Timepicker
      $(".timepicker").timepicker({
        showInputs: false
      });
    });
  </script>
  <!-- My Script -->
  <script src="<?php echo base_url(); ?>../style/myjs/add-family.js"></script>
  <script src="<?php echo base_url(); ?>../style/myjs/add-spouse.js"></script>
  <script src="<?php echo base_url(); ?>../style/myjs/add-sumber-air.js"></script>
  <script src="<?php echo base_url(); ?>../style/myjs/add-riw-1-bulan.js"></script>
  <script src="<?php echo base_url(); ?>../style/myjs/add-riw-3-bulan.js"></script>
  <script src="<?php echo base_url(); ?>../style/myjs/add-riw-1-tahun.js"></script>
  <script src="<?php echo base_url(); ?>../style/myjs/add-batuk.js"></script>
  <script src="<?php echo base_url(); ?>../style/myjs/add-asma.js"></script>
  <script src="<?php echo base_url(); ?>../style/myjs/add-maskes.js"></script>
  <script src="<?php echo base_url(); ?>../style/myjs/add-masket.js"></script>
  <script src="<?php echo base_url(); ?>../style/myjs/add-sakit-keras.js"></script>
  <script src="<?php echo base_url(); ?>../style/myjs/add-kecelakaan-kerja.js"></script>
  <script src="<?php echo base_url(); ?>../style/myjs/add-merokok.js"></script>
  <script src="<?php echo base_url(); ?>../style/myjs/add-jamu.js"></script>
  <script src="<?php echo base_url(); ?>../style/myjs/add-alkohol.js"></script>
  <script src="<?php echo base_url(); ?>../style/myjs/add-kopi.js"></script>
  <script src="<?php echo base_url(); ?>../style/myjs/add-obat.js"></script>
  <script src="<?php echo base_url(); ?>../style/myjs/add-olahraga.js"></script>
  <script src="<?php echo base_url(); ?>../style/myjs/add-anamnesis.js"></script>
  <script src="<?php echo base_url(); ?>../style/myjs/read-modul-penyakit.js"></script>
  <script src="<?php echo base_url(); ?>../style/myjs/add-faktor.js"></script>
  <script src="<?php echo base_url(); ?>../style/myjs/add-rujukan.js"></script>

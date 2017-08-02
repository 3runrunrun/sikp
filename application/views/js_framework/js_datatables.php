<!-- DataTables -->
<script src="<?php echo base_url(); ?>../style/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>../style/plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="<?php echo base_url(); ?>../style/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- Datatables -->
<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
</script>
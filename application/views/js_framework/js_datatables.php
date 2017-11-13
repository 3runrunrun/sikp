<!-- My Javascript -->
<script src="<?php echo base_url(); ?>../style/myjs/destroy-anamnesis-harian.js"></script>
<!-- DataTables -->
<script src="<?php echo base_url(); ?>../style/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>../style/plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="<?php echo base_url(); ?>../style/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- Datatables -->
<script>
  $(function () {
    $("#example1, #dd-anggota-keluarga, #dd-perkawinan, #dd-riwayat-maskes, #dd-riwayat-masket, #dd-riwayat-kecelakaan-kerja, #dd-riwayat-sakit-keras, #tbl-riwayat-gejala-stres, #tbl-riwayat-data-dasar, #obat-keluar-bulan").DataTable();
    $('#example2, #tabel-penyakit-kecelakaan, #tabel-kecelakaan-kerja, #dd-riwayat-1-bulan, #dd-riwayat-3-bulan, #dd-riwayat-1-tahun').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
    $('#example3').DataTable({
      "paging": false,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": true
    });
  });
</script>

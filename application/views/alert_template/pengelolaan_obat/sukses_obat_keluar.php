<div class="alert alert-success alert-dismissible">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
  <h4>Catatan Obat Keluar Berhasil Disimpan</h4>
  <p>Petugas Kefarmasian diwajibkan memeriksa kelengkapan obat yang akan diberikan kepada pasien.</p>
  <p><strong>Klik tombol di bawah untuk mencetak resep.</strong></p>
  <p>
    <button class="btn bg-yellow" onclick="window.location='<?php echo base_url(); ?>cetak-resep-obat-keluar/<?php echo $id_resep_obat; ?>'"><i class="fa fa-print"></i>&nbsp;Cetak resep obat</button>
  </p>
</div>
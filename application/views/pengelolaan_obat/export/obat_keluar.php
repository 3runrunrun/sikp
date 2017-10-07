<?php 
  $satuan = array(
    '1' => 'Butir',
    '2' => 'Botol',
    );
 ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Laporan Obat Keluar</title>
  <link rel="stylesheet" href="<?php echo base_url(); ?>../style/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>../style/dist/css/AdminLTE.min.css">
</head>
<body>
  <div class="wrapper">
    <div class="content">
      <section class="content-header">
        <h1 align="center">Poliklinik Pabrik Gula Kebon Agung</h1>
      </section>
      <section class="content">
        <div class="box box-primary">
          <div class="box-header">
            <h3 class="box-title">Laporan Obat Keluar</h3>
            <div class="box-tools pull-right">Tanggal: <?php echo $from; ?> - <?php echo $to; ?></div>
          </div>
          <div class="box-body">
            <table class="table" style="font-size: 10px;">
              <tr>
                <th colspan="7">&nbsp;</th>
              </tr>
              <tr>
                <th>ID Obat Keluar</th>
                <th>Nama Pasien</th>
                <th>ID Obat</th>
                <th>Nama Obat</th>
                <th>Jumlah Keluar</th>
                <th>Satuan</th>
                <th>Tanggal Keluar</th>
              </tr>
              <?php foreach ($laporan as $value): ?>
              <tr>
                <td><?php echo $value['id_obat_keluar']; ?></td>
                <td><?php echo ucwords($value['nama_pasien']); ?></td>
                <td><?php echo $value['id_obat']; ?></td>
                <td><?php echo ucwords($value['nama']); ?></td>
                <td><?php echo $value['jumlah_keluar']; ?></td>
                <td><?php $value['satuan'] = str_replace(array_keys($satuan), $satuan, $value['satuan']); echo $value['satuan']; ?></td>
                <td><?php echo $value['tgl_keluar']; ?></td>
              </tr>
              <?php endforeach; ?>
            </table>
          </div>
        </div>
      </section>
    </div>
  </div>
  <!-- ./wrapper -->
</body>
</html>
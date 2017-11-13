<?php 
  // export to excel
  header("Content-type:application/vnd.ms-excel");
  header("Content-Disposition: attachment; filename=$filename.xls");
  header("Pragma: no-cache");
  header("Expires: 0"); 

  // array for replacement
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
            <h3 class="box-title" style="font-size: 12PX;">Laporan Obat Keluar Bulanan</h3>
            <div class="box-tools pull-right" style="font-size: 12px;">Tanggal: <?php echo $from; ?> - <?php echo $to; ?></div>
          </div>
          <div class="box-body">
            <table class="table" style="font-size: 12px;" border="1">
              <tr>
                <th width="100">Bulan-Tahun</th>
                <th width="200">Nama Obat</th>
                <th width="100">Jumlah Masuk</th>
                <th width="100">Jumlah Keluar</th>
                <th width="100">Sisa</th>
                <th width="100">Satuan</th>
              </tr>
              <?php foreach ($laporan as $value): ?>
              <tr>
                <td style="text-align: left;"><?php $date_object = date_create($value['bulan']); echo date_format($date_object, 'M-Y'); ?></td>
                <td><?php echo ucwords($value['nama']); ?></td>
                <td><?php echo $value['jml_masuk']; ?></td>
                <td><?php echo $value['jml_keluar']; ?></td>
                <td><?php echo $value['sisa']; ?></td>
                <td><?php $value['satuan'] = str_replace(array_keys($satuan), $satuan, $value['satuan']); echo $value['satuan']; ?></td>
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
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
          <?php $result = array_unique($resep_obat); ?>
          <?php foreach ($result as $value): ?>
          <?php 
            $date_object = date_create($value['tgl_keluar']);
            $formatted_date = date_format($date_object, 'd-M-Y');
           ?>
          <div class="box-header">
            <h3 class="box-title">Resep Obat</h3>
            <div class="box-tools pull-right">Tanggal: <?php echo $formatted_date; ?></div>
          </div>
          <div class="box-body">
            <table class="table" style="font-size: 10px;">
              <tr>
                <td colspan="2">&nbsp;</th>
              </tr>
              <tr>
                <th width="80">Nama Pasien</th>
                <td><?php echo ucwords($value['nama']); ?></td>
              </tr>
              <tr>
                <th width="80">Nama Dokter (Poli)</th>
                <td><?php echo ucwords($value['nama_dokter']); ?> (<?php echo ucwords($value['poli']); ?>)</td>
              </tr>
            </table>
            <?php endforeach; ?>
            <table class="table" style="font-size: 10px;">
              <tr>
                <th colspan="3">&nbsp;</th>
              </tr>
              <tr>
                <th>Nama Obat</th>
                <th>Signa</th>
                <th>Total Jumlah Obat</th>
              </tr>
              <?php foreach ($resep_obat as $value): ?>
              <tr>
                <td><?php echo ucwords($value['nama_obat']); ?></td>
                <td><?php echo $value['a_signa'] . ' &times; ' . $value['b_signa']; ?></td>
                <td style="text-align: left"><?php echo $value['jumlah_keluar']; $value['satuan'] = str_replace(array_keys($satuan), $satuan, $value['satuan']); echo  '&nbsp;'. $value['satuan']; ?></td>
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
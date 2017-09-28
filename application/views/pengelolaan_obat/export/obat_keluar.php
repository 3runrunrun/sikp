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
  <title>SI Kesehatan Primer</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>../style/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>../style/plugins/datatables/dataTables.bootstrap.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>../style/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>../style/dist/css/skins/_all-skins.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body>
  <h3 class="box-title">Laporan Obat Keluar</h3>
  <table class="table" style="font-size: 10px;">
    <tr>
      <th>ID Obat Keluar</th>
      <th>ID Resep</th>
      <th>ID Obat</th>
      <th>Nama Obat</th>
      <th>Jumlah Keluar</th>
      <th>Satuan</th>
      <th>Tanggal Keluar</th>
    </tr>
    <?php foreach ($laporan as $value): ?>
    <tr>
      <td><?php echo $value['id_obat_keluar']; ?></td>
      <td><?php echo $value['id_resep_obat']; ?></td>
      <td><?php echo $value['id_obat']; ?></td>
      <td><?php echo $value['nama']; ?></td>
      <td><?php echo $value['jumlah_keluar']; ?></td>
      <td><?php $value['satuan'] = str_replace(array_keys($satuan), $satuan, $value['satuan']); echo $value['satuan']; ?></td>
      <td><?php echo $value['tgl_keluar']; ?></td>
    </tr>
    <?php endforeach; ?>
  </table>
  <!-- ./wrapper -->
  <!-- jQuery 2.2.3 -->
  <script src="<?php echo base_url(); ?>../style/plugins/jQuery/jquery-2.2.3.min.js"></script>
  <!-- Bootstrap 3.3.6 -->
  <script src="<?php echo base_url(); ?>../style/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
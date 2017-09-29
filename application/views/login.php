<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SIKP - Login</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>../style/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>../style/plugins/iCheck/all.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>../style/plugins/select2/select2.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>../style/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>../style/dist/css/skins/_all-skins.min.css">
  <script src="<?php echo base_url(); ?>../style/plugins/jQuery/jquery-2.2.3.min.js"></script>
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <a href="<?php echo base_url(); ?>"><b>SI</b>&nbsp;Kesehatan Primer</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
      {err_vars}
      {alert_vars}
      <form action="<?php echo base_url(); ?>auth" method="post">
        <div class="form-group has-feedback">
          <select name="uname" class="form-control select2">
            <option value="" selected disabled>Nama Pegawai</option>
            {pengguna}
            <option value="{uname}">{nama}</option>
            {/pengguna}
          </select>
        </div>
        <div class="form-group has-feedback">
          <input type="password" name="pwd" class="form-control" placeholder="Kata Sandi">
        </div>
        <div class="row">
          <div class="col-xs-4">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Masuk</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <!-- /login-form -->
    </div>
    <!-- /.login-box-body -->
  </div>
  <!-- /.login-box -->
  <!-- jQuery 2.2.3 -->
  <script src="<?php echo base_url(); ?>../style/plugins/jQuery/jquery-2.2.3.min.js"></script>
  <!-- Bootstrap 3.3.6 -->
  <script src="<?php echo base_url(); ?>../style/bootstrap/js/bootstrap.min.js"></script>
  <!-- Select2 -->
  <script src="<?php echo base_url(); ?>../style/plugins/select2/select2.full.min.js"></script>
  <!-- Advanced Form -->
  <script>
    $(function () {
      //Initialize Select2 Elements
      $(".select2").select2();
    });
  </script>
  <!-- Page script -->
  <!-- iCheck 1.0.1 -->
  <script src="<?php echo base_url(); ?>../style/plugins/iCheck/icheck.min.js"></script>
  <script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Document</title>
</head>
<body>
  <form method="POST" action="<?php echo base_url('C_login/login'); ?>">
    <h5>Tipe Pengguna:</h5>
    <select name="tipe_pengguna">
      <option value="tm">Tenaga Medis</option>
      <option value="tp">Tenaga Paramedis</option>
      <option value="tk">Tenaga Kefarmasian</option>
      <option value="sa">Staf Administrasi</option>
    </select>
    <h5>Username:</h5>
    <input type="text" name="uname" />
    <h5>Password:</h5>
    <input type="password" name="pwd" id="">
    <input type="submit" name="login" value="Login">
  </form>
</body>
</html>
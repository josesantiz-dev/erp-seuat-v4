<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="TI SEUAT">
  <link rel="shortcut icon" href="<?= media();?>/images/icons/icon-48x48.png" />
  <title><?php echo $data['page_tag']; ?></title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo media(); ?>/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?php echo media(); ?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo media(); ?>/css/adminlte.min.css">
  <link rel="stylesheet" href="<?php echo media(); ?>/css/styles.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="<?= media(); ?>/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <link rel="stylesheet" href="<?= media(); ?>/plugins/sweetalert2/sweetalert2.min.css" type="text/css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="#"><b>SIE </b>Universiad SEUAT</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Iniciar Sesión</p>

      <form action="" name="formLogin" id="formLogin">
        <div class="input-group mb-3">
          <input type="text" id="txtNickname" name="txtNickname" class="form-control" placeholder="Nombre de usuario">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" id="txtPassword" name="txtPassword" class="form-control" placeholder="Contraseña">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-7">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Recordarme
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div id="alertLogin" class="text-center"></div>
          <div class="col-5">
            <button type="submit" class="btn btn-primary btn-block">Iniciar sesión</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <p class="mt-4 mb-1">
        <a href="forgot-password.html">Olvidaste tu contraseña</a>
      </p>
      <p class="mb-0">
        <a href="index.php" class="text-center">Registrarse</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
  <div class="text-muted text-center" style="padding-top:4px;"><small>Dirección de Medios Virtuales y Sistemas © </small></div>
</div>
<!-- /.login-box -->


<script>
    const base_url = "<?= base_url(); ?>";
</script>
<!-- jQuery -->
<script src="<?php echo media(); ?>/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo media(); ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo media(); ?>/js/adminlte.min.js"></script>
<!-- SweetAlert2 -->
<script type="text/javascript" src="<?= media(); ?>/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Funciones -->
<script src="<?= media(); ?>/js/<?= $data['page_functions_js']; ?>"></script>
</body>
</html>
 

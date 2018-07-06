<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Halaman Konfirmasi</title>
  <link rel="icon" href="<?php echo media_url('ico/favicon.ico'); ?>" type="image/x-icon">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link href="<?php echo media_url() ?>css/bootstrap.min.css" rel="stylesheet" />
  <!-- Font Awesome -->
  <link href="<?php echo media_url() ?>css/font-awesome.min.css" rel="stylesheet" />
  <!-- Theme style -->
  <link href="<?php echo media_url() ?>css/AdminLTE.min.css" rel="stylesheet" />

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
  <div class="col-md-12 col-xs-12">
    <div class="login-box">
      <div class="login-logo">
        <b>User</b> Konfirmasi
      </div>
      <!-- /.login-logo -->
      <div class="login-box-body"> 
        <p class="login-box-msg">Konfirmasi Akun</p>

        <?php echo form_open('manage/auth/confirmation'); ?>

        <?php if ($this->session->flashdata('success')) { ?>
          <div class="alert alert-success alert-dismissible">
            <h5><i class="fa fa-check"></i> <?php echo $this->session->flashdata('success') ?></h5>
          </div>
        <?php } elseif ($this->session->flashdata('failed')) { ?>
          <div class="alert alert-danger alert-dismissible">
            <h5><i class="fa fa-ban"></i> <?php echo $this->session->flashdata('failed') ?></h5>
          </div>
        <?php } ?>

        <div class="form-group has-feedback">
          <input type="email" name="email" autofocus="" class="form-control" placeholder="Email">
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="password" name="password" class="form-control" placeholder="Password">
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="text" name="token" class="form-control" placeholder="Kode Aktifasi">
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>

        <div class="form-group">
          <?php echo $recaptcha_html;?>
          <?php echo form_error('g-recaptcha-response'); ?>
        </div>

        <div class="row">
          <div class="col-xs-8">

          </div>
          <!-- /.col -->
          <div class="col-md-4 col-xs-12">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Konfirmasi</button>
          </div>
          <!-- /.col -->
        </div>
        <?php echo form_close(); ?>

      </div>
      <!-- /.login-box-body -->
    </div>
  </div>
  <!-- /.login-box -->

  <!-- jQuery 3 --> 
  <script src="<?php echo media_url() ?>js/jquery.min.js" type="text/javascript"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="<?php echo media_url() ?>js/bootstrap.min.js" type="text/javascript"></script>
</body>
</html>

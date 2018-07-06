<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Register</title>
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
        <b>Register</b> User
      </div>
      <!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Register User</p>

        <?php echo form_open('manage/auth/register'); ?>
        <?php echo validation_errors(); ?>
        <div class="form-group">
          <label>Email</label>
          <input type="email" class="form-control" name="user_email" placeholder="Email Anda">
        </div>
        <div class="form-group">
          <label>Password</label>
          <input type="password" class="form-control" name="user_password" placeholder="Password Anda">
        </div>
        <div class="form-group">
          <label>Nama Lengkap</label>
          <input type="text" class="form-control" name="user_full_name" placeholder="Nama Anda">
        </div>
        <div class="form-group">
          <label>Jenis Kelamin</label>
          <div class="radio">
            <label>
              <input type="radio" name="user_gender" value="L"> Laki-laki
            </label>&nbsp;&nbsp;
            <label>
              <input type="radio" name="user_gender" value="P"> Perempuan
            </label>
          </div>
        </div>
        <div class="form-group">
          <label>No. Handphone</label>
          <input type="text" class="form-control" name="user_phone" placeholder="Nomor Handphone Anda">
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
            <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
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

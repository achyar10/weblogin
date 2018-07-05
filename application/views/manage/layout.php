<!DOCTYPE html>
<html lang="en" ng-app>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Achyar <?php echo isset($title) ? ' | ' . $title : null; ?></title>
  <link rel="icon" href="<?php echo media_url('ico/favicon.ico'); ?>" type="image/x-icon">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo media_url() ?>/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo media_url() ?>/css/font-awesome.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo media_url() ?>/css/AdminLTE.min.css">
  <link rel="stylesheet" href="<?php echo media_url() ?>/css/style.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
   folder instead of downloading all of them to reduce the load. -->
   <!-- Notyfy JS - Notification -->
   <link rel="stylesheet" href="<?php echo media_url() ?>css/jquery.notyfy.css">
   <link rel="stylesheet" href="<?php echo media_url() ?>/css/skin-purple-light.css">
   <!-- Date Picker -->
   <link rel="stylesheet" href="<?php echo media_url() ?>/css/bootstrap-datepicker.min.css">
   <!-- Daterange picker -->
   <link rel="stylesheet" href="<?php echo media_url() ?>/css/daterangepicker.css">

   <!-- Google Font -->
   <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
 </head>
 <body class="hold-transition skin-purple-light fixed sidebar-mini">
  <div class="wrapper">

    <header class="main-header">
      <!-- Logo -->
      <a href="index2.html" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini">CMS</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Administrator</b></span>
      </a>
      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- Messages: style can be found in dropdown.less-->

            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <?php if ($this->session->userdata('user_image') != null) { ?>
                <img src="<?php echo upload_url().'/users/'.$this->session->userdata('user_image'); ?>" class="user-image">
                <?php } else { ?>
                <img src="<?php echo media_url() ?>img/user.png" class="user-image">
                <?php } ?>
                <span class="hidden-xs"><?php echo ucfirst($this->session->userdata('ufullname')); ?></span>
              </a>
              <ul class="dropdown-menu">
                <!-- User image -->
                <li class="user-header">
                  <?php if ($this->session->userdata('user_image') != null) { ?>
                  <img src="<?php echo upload_url().'/users/'.$this->session->userdata('user_image'); ?>" class="img-circle">
                  <?php } else { ?>
                  <img src="<?php echo media_url() ?>img/user.png" class="img-circle">
                  <?php } ?>

                  <p>
                    <?php echo ucfirst($this->session->userdata('ufullname')); ?>
                    <small><?php echo ucfirst($this->session->userdata('urolename')); ?></small>
                    <small><?php echo $this->session->userdata('uemail'); ?></small>
                  </p>
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-left">
                    <a href="<?php echo site_url('manage/profile') ?>" class="btn btn-default btn-flat">Profile</a>
                  </div>
                  <div class="pull-right">
                    <a href="<?php echo site_url('manage/auth/logout?location=' . htmlspecialchars($_SERVER['REQUEST_URI'])) ?>" class="btn btn-default btn-flat">Sign out</a>
                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </nav>
    </header> 

    <?php $this->load->view('manage/sidebar'); ?>
    <!-- Content Wrapper. Contains page content -->
    <?php isset($main) ? $this->load->view($main) : null; ?>
    <!-- Content Wrapper. Contains page content -->

    
    <!-- /.content-wrapper -->
    <footer class="main-footer">
      <div class="pull-right hidden-xs">
        Content Management System
      </div>
      <strong>Copyright &copy; <script>document.write(new Date().getFullYear())</script> <a href="https://achyaricha.com">Achyar Anshorie&trade;</a>.</strong> All rights
      reserved.
    </footer>

    <!-- jQuery 3 -->

    <script src="<?php echo media_url() ?>/js/jquery.min.js"></script>
    <script src="<?php echo media_url() ?>/js/angular.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="<?php echo media_url() ?>/js/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.7 -->
    <script src="<?php echo media_url() ?>/js/bootstrap.min.js"></script>
    
    <!-- daterangepicker -->
    <script src="<?php echo media_url() ?>/js/daterangepicker.js"></script>
    <!-- datepicker -->
    <script src="<?php echo media_url() ?>/js/bootstrap-datepicker.min.js"></script>
    <!-- SlimScroll -->
    <script src="<?php echo media_url() ?>/js/jquery.slimscroll.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo media_url() ?>/js/adminlte.min.js"></script>
    <!-- Notyfy JS -->
    <script src="<?php echo media_url() ?>/js/jquery.notyfy.js"></script>
    <script>
    $(".input-group.date").datepicker({autoclose: true, todayHighlight: true});
    </script>

<?php if ($this->session->flashdata('success')) { ?>
<script>
  $(function () {
    notyfy({
      layout: 'top',
      type: 'success',
      showEffect: function (bar) {
        bar.animate({height: 'toggle'}, 500, 'swing');
      },
      hideEffect: function (bar) {
        bar.animate({height: 'toggle'}, 500, 'swing');
      },
      timeout: 3000,
      text: '<?php echo $this->session->flashdata('success') ?>'
    });
  });
</script>
<?php } ?>

<script>
  $(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
  });
</script>

</body>
</html>

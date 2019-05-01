<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo $title = isset($title) ?  $title : ''; ?></title>
	<!-- Tell the browser to be responsive to screen width -->
  	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <?php
  /** -- Copy from here -- */
  if(!empty($meta))
    foreach($meta as $name=>$content){
      echo "\n";
      ?><meta name="<?php echo $name; ?>" content="<?php echo $content; ?>" /><?php
         }
    echo "\n";

    if(!empty($canonical))
    {
      echo "\n";
      ?><link rel="canonical" href="<?php echo $canonical?>" /><?php

    }
    echo "\n";
    /** -- to here -- */
  ?>
  <!-- Bootstrap 3.3.7 -->
	<link rel="stylesheet" href="<?php echo base_url().'assets/themes/adminlte'; ?>/bower_components/bootstrap/dist/css/bootstrap.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?php echo base_url().'assets/themes/adminlte'; ?>/bower_components/font-awesome/css/font-awesome.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="<?php echo base_url().'assets/themes/adminlte'; ?>/bower_components/Ionicons/css/ionicons.min.css">
	<!-- Pace style -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/themes/adminlte/plugins/pace/pace.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?php echo base_url().'assets/themes/adminlte'; ?>/dist/css/AdminLTE.min.css">
	<!-- AdminLTE Skins. Choose a skin from the css/skins
	   folder instead of downloading all of them to reduce the load. -->
	<link rel="stylesheet" href="<?php echo base_url().'assets/themes/adminlte'; ?>/dist/css/skins/_all-skins.min.css">
  <!-- custom style -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/themes/adminlte'; ?>/dist/css/custom.css">
  <!-- notityjs -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/themes/adminlte'; ?>/bower_components/notifyjs/dist/styles/metro/notify-metro.css">
<?php foreach($css as $file){
    echo "\n"; ?>
    <link rel="stylesheet" href="<?php echo base_url().$file; ?>" type="text/css" /><?php
  }
 ?>
 	<!-- Google Font -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<!-- jQuery 3 -->
<script src="<?php echo base_url().'assets/themes/adminlte'; ?>/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url().'assets/themes/adminlte'; ?>/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- jQuery Form -->
<script src="<?php echo base_url().'assets/themes/adminlte'; ?>/bower_components/form_/dist/jquery.form.min.js"></script>
</head>
<body class="hold-transition skin-purple sidebar-mini" style="height: auto; min-height: 100%;">
<!-- Site wrapper -->
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="<?php echo base_url(); ?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>S</b>TE</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Simple</b> Template</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success">4</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 4 messages</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li><!-- start message -->
                    <a href="#">
                      <div class="pull-left">
                        <img src="<?php echo base_url().'assets/themes/adminlte'; ?>/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Support Team
                        <small><i class="fa fa-clock-o"></i> 5 mins</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <!-- end message -->
                </ul>
              </li>
              <li class="footer"><a href="#">See All Messages</a></li>
            </ul>
          </li>
          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">10</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 10 notifications</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-aqua"></i> 5 new members joined today
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">View all</a></li>
            </ul>
          </li>
          <!-- Tasks: style can be found in dropdown.less -->
          <li class="dropdown tasks-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-flag-o"></i>
              <span class="label label-danger">9</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 9 tasks</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Design some buttons
                        <small class="pull-right">20%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar"
                             aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">20% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                </ul>
              </li>
              <li class="footer">
                <a href="#">View all tasks</a>
              </li>
            </ul>
          </li>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo $photo; ?>" class="user-image" alt="User Image" id="photo2">
              <span class="hidden-xs" id="ms_name1"><?php echo $fullname; ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo $photo; ?>" class="img-circle" alt="User Image" id="photo1">

                <p>
                  <span id="ms_name2">
                  <?php echo $fullname; ?></span>
                  <small>Member since Nov. 2012</small>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">Followers</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Sales</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Friends</a>
                  </div>
                </div>
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?php echo base_url().'profil'; ?>" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo base_url().'login/logout'; ?>" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
	<!-- =============================================== -->
	<?php echo $sidebar = isset($sidebar) ?  $sidebar : ''; ?>
	<!-- =============================================== -->
	<?php echo $content; ?>
	<!-- =============================================== -->
	<?php echo $control_sidebar = isset($control_sidebar) ?  $control_sidebar : ''; ?>
	<!-- =============================================== -->
  
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Simple Template </b> v 1.0
    </div>
    <strong>Theme by Admin LTE.</strong> elapsed time {elapsed_time} and memory usage<?php echo $this->benchmark->memory_usage();?>
  </footer>

  <!-- control-sidebar -->
  
</div>
<!-- ./wrapper -->

<!-- SlimScroll -->
<script src="<?php echo base_url().'assets/themes/adminlte'; ?>/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url().'assets/themes/adminlte'; ?>/bower_components/fastclick/lib/fastclick.js"></script>
<!-- PACE -->
<script src="<?php echo base_url(); ?>assets/themes/adminlte/bower_components/PACE/pace.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url().'assets/themes/adminlte'; ?>/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url().'assets/themes/adminlte'; ?>/dist/js/demo.js"></script>
<!-- notify  js -->
<script src="<?php echo base_url().'assets/themes/adminlte'; ?>/bower_components/notifyjs/notify.min.js"></script>
<script src="<?php echo base_url().'assets/themes/adminlte'; ?>/bower_components/notifyjs/dist/styles/metro/notify-metro.js"></script>
	<?php foreach($js as $file){
	  	echo "\n"; 
	    ?><script src="<?php echo base_url().$file; ?>"></script><?php
	  }
	 ?>
<script>
  
  $(document).ready(function () {
    $('.sidebar-menu').tree()
  });
  $(document).ajaxStart(function () {
    Pace.restart()
  });

  $('body').tooltip({selector: '[data-toggle="tooltip"]'});

  function notify(style, title, text) {
        $.notify({
            title: title,
            text: text,
            image : '<i class="fa fa-bell fa-2x"></i>'
        }, {
            style: 'metro',
            className: style,
            autoHide: true,
            clickToHide: true,
            autoHideDelay: 5000,
        });
    }

  /** add active class and stay opened when selected */
  var url_active = window.location;
  // for sidebar menu entirely but not cover treeview
  $('ul.sidebar-menu a').filter(function() {
     return this.href == url_active;
  }).parent().addClass('active');

  // for treeview
  $('ul.treeview-menu a').filter(function() {
     return this.href == url_active;
  }).parentsUntil( $( "ul.level-1" ) ).addClass('active');

</script>
<?php echo $js_view = isset($js_view) ?  $js_view : ''; ?>
</body>
</html>
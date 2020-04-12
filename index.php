<?php
session_start();

include "function.php";

$koneksi = new mysqli("localhost", "root", "", "db_inventor");

if ($_SESSION['admin'] || $_SESSION['user']) {


?>
  <!DOCTYPE html>
  <html>

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Web Aplikasi </title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="assets/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="assets/bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="assets/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="assets/dist/css/skins/_all-skins.min.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="assets/bower_components/morris.js/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="assets/bower_components/jvectormap/jquery-jvectormap.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="assets/bower_components/bootstrap-daterangepicker/daterangepicker.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

    <link href="assets/dataTables/dataTables.bootstrap.css" rel="stylesheet" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">


  </head>

  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

      <header class="main-header">
        <!-- Logo -->
        <a href="index2.html" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>W</b>eb</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Web</b>Aplikasi </span>
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

              <!-- Notifications: style can be found in dropdown.less -->

              <!-- Tasks: style can be found in dropdown.less -->
              <li class="dropdown tasks-menu">

                <ul class="dropdown-menu">

                  <li>
                    <!-- inner menu: contains the actual data -->
                    <ul class="menu">

                      <!-- end task item -->

                      <!-- end task item -->

                      <!-- end task item -->

                      <!-- end task item -->
                    </ul>
                  </li>

                </ul>
              </li>
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <span class="hidden-xs"> <?php echo $_SESSION['level'] ?> : <?php echo  $_SESSION['nm']; ?> </span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">

                    <p>
                      <?php echo $_SESSION['nm']; ?>
                      <small>Member Since 2020</small>
                    </p>
                  </li>
                  <!-- Menu Body -->

                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->

            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->

          <!-- search form -->
          <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
          </form>
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <li class="active treeview">

            </li>


            <!-- login berdasarkan level -->
            <?php
            //  var_dump($_SESSION['level'] == 'Kepala Gudang'); 
            //  die;
            if ($_SESSION['level'] == "Kepala Gudang") {
            ?>

              <li><a href="?"><i class="fa fa-dashboard"></i> <span>Dashbosard</span></a></li>
              <li><a href="?page=userall"><i class="fa fa-user-circle"></i> <span>User All</span></a></li>
              <li><a href="?page=barangAll"><i class="fa fa-cubes"></i> <span>Barang All</span></a></li>
              <li><a href="?page=satuan"><i class="fa fa-file-archive-o"></i> <span>Data Satuan</span></a></li>
              <li><a href="?page=rak"><i class="fa fa-stack-exchange"></i> <span>Data Rak</span></a></li>
              <li><a href="laporanmasuk.php"><i class="fa fa-check-square"></i> <span>Laporan Barang Masuk</span></a></li>
              <li><a href="laporankeluar.php"><i class="fa fa-check-square-o"></i> <span>Laporan Barang Keluar</span></a></li>
              <li><a href="?page=barangmasukall"><i class="fa fa-stack-exchange"></i> <span>Barang Masuk All</span></a></li>


            <?php } ?>


            <!-- <li><a href="?page=barang"><i class="fa fa-map"></i> <span>Data Barang</span></a></li>
            <li><a href="?page=user"><i class="fa fa-user"></i> <span>Data User</span></a></li> -->
            <li><a href="?page=barangmasuk"><i class="fa fa-book"></i> <span>Barang Masuk</span></a></li>
            <li><a href="?page=barangkeluar"><i class="fa fa-book"></i> <span>Barang Keluar</span></a></li>



            <!-- <li><a href="?page=satuan"><i class="fa fa-book"></i> <span>Data Satuan</span></a></li>
            <li><a href="?page=rak"><i class="fa fa-book"></i> <span>Data Rak</span></a></li> -->


          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">

          <div id="page-wrapper">
            <div id="page-inner">
              <div class="row">
                <div class="col-md-12">

                  <?php

                  $page = @$_GET['page'];
                  $aksi = @$_GET['aksi'];



                  if ($page == 'user') {
                    if ($aksi == "") {

                      include "page/user/user.php";
                    } elseif ($aksi == "tambah") {
                      include "page/user/tambah.php";
                    } elseif ($aksi == "ubah") {
                      include "page/user/ubah.php";
                    } elseif ($aksi == "hapus") {
                      include "page/user/hapus.php";
                    }
                  } elseif ($page == 'barang') {
                    if ($aksi == "") {

                      include "page/barang/barang.php";
                    } elseif ($aksi == "tambah") {
                      include "page/barang/tambah.php";
                    } elseif ($aksi == "ubah") {
                      include "page/barang/ubah.php";
                    } elseif ($aksi == "hapus") {
                      include "page/barang/hapus.php";
                    }
                  } elseif ($page == 'barangmasuk') {
                    if ($aksi == "") {

                      include "page/barangmasuk/barangmasuk.php";
                    } elseif ($aksi == "tambah") {
                      include "page/barangmasuk/tambah.php";
                    } elseif ($aksi == "ubah") {
                      include "page/barangmasuk/ubah.php";
                    } elseif ($aksi == "hapus") {
                      include "page/barangmasuk/hapus.php";
                    }
                  } elseif ($page == 'barangkeluar') {
                    if ($aksi == "") {

                      include "page/barangkeluar/barangkeluar.php";
                    } elseif ($aksi == "tambah") {
                      include "page/barangkeluar/tambah.php";
                    } elseif ($aksi == "ubah") {
                      include "page/barangkeluar/ubah.php";
                    } elseif ($aksi == "hapus") {
                      include "page/barangkeluar/hapus.php";
                    }
                  } elseif ($page == 'Rak') {
                    if ($aksi == "") {

                      include "page/barangkeluar/Rak.php";
                    } elseif ($aksi == "tambah") {
                      include "page/barangkeluar/tambah.php";
                    } elseif ($aksi == "ubah") {
                      include "page/barangkeluar/ubah.php";
                    } elseif ($aksi == "hapus") {
                      include "page/barangkeluar/hapus.php";
                    }
                  } elseif ($page == 'laporanbarangkeluar') {
                    if ($aksi == "") {

                      include "laporan/laporan_barangkeluar.php";
                    }
                  } elseif ($page == "") {
                    include "home.php";
                  } elseif ($page == 'userall') {
                    if ($aksi == "") {

                      include "page/user/userall.php";
                    } elseif ($aksi == "tambah") {
                      include "page/barangkeluar/tambah.php";
                    } elseif ($aksi == "ubah") {
                      include "page/barangkeluar/ubah.php";
                    } elseif ($aksi == "hapus") {
                      include "page/barangkeluar/hapus.php";
                    }
                  } elseif ($page == 'barangAll') {

                    include "page/user/data_barang_all.php";
                  } elseif ($page == 'satuan') {

                    include "page/user/data_satuan_all.php";
                  } elseif ($page == 'rak') {

                    include "page/user/data_rak.php";
                  } elseif ($page == 'barangmasukall') {                  
                      include "page/barangmasuk/barang_masuk_all.php";
                  }



                  ?>

                </div>
              </div>


            </div>

        </section>

        </section>




        <!-- ./wrapper -->

        <!-- jQuery 3 -->
        <script src="assets/bower_components/jquery/dist/jquery.min.js"></script>
        <!-- jQuery UI 1.11.4 -->
        <script src="assets/bower_components/jquery-ui/jquery-ui.min.js"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
          $.widget.bridge('uibutton', $.ui.button);
        </script>
        <!-- Bootstrap 3.3.7 -->
        <script src="assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <!-- Morris.js charts -->
        <script src="assets/bower_components/raphael/raphael.min.js"></script>
        <script src="assets/bower_components/morris.js/morris.min.js"></script>
        <!-- Sparkline -->
        <script src="assets/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
        <!-- jvectormap -->
        <script src="assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
        <script src="assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
        <!-- jQuery Knob Chart -->
        <script src="assets/bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
        <!-- daterangepicker -->
        <script src="assets/bower_components/moment/min/moment.min.js"></script>
        <script src="assets/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
        <!-- datepicker -->
        <script src="assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
        <!-- Slimscroll -->
        <script src="assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
        <!-- FastClick -->
        <script src="assets/bower_components/fastclick/lib/fastclick.js"></script>
        <!-- AdminLTE App -->
        <script src="assets/dist/js/adminlte.min.js"></script>
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="assets/dist/js/pages/dashboard.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="assets/dist/js/demo.js"></script>
        <script src="assets/dataTables/jquery.dataTables.js"></script>
        <script src="assets/dataTables/dataTables.bootstrap.js"></script>
        <script>
          $(document).ready(function() {
            $('#dataTables-example').dataTable();
          });
        </script>

  </body>

  </html>
<?php

} else {
  header("location:login.php");
}


?>
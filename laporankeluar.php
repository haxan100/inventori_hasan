
<?php
    session_start();

    include"function.php";

     $koneksi = new mysqli("localhost","root","","db_inventor");



?>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Web Aplikasi</title>
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

<div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Data Barang Keluar
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>No</th>                                            
                                            <th>Kode Barang Keluar</th>
                                             <th>Nama Barang</th>
                                            <th>Jenis Barang</th>
                                               <th>No. Rak</th>
                                                  <th>Tanggal</th>
                                            <th>Satuan</th>
                                            <th>Jumlah</th>
                                         <th>Nama User</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php

                                            $no = 1;

                                            $sql = $koneksi -> query("select tb_barang.* , tb_barang_keluar.* , tb_user.* from tb_user , tb_barang_keluar , tb_barang where tb_barang.kode_barang = tb_barang_keluar.kode_barang and tb_user.kode_user = tb_barang_keluar.kode_user ");
                                            while ($data = $sql->fetch_assoc()) {

                                        ?>


                                        <tr>
                                            <td><?php echo @$no++;?></td>
                                            <td><?php echo $data['kode_barang_keluar'];?></td>
                                            <td><?php echo @$data['nama_barang'];?></td>
                                            <td><?php echo @$data['jenis_barang'];?></td>
                                            <td><?php echo @$data['no_rak'];?></td>
                                            <td><?php echo @$data['tanggal_keluar'];?></td>
                                            <td><?php echo @$data['satuan'];?></td>
                                            <td><?php echo @$data['jumlah_keluar'];?></td>
                                            <td><?php echo @$data['nama_user'];?></td>
                                            
                                      
                                            
                                        </tr>

                                       <?php } ?>

                                    </tbody>   
                                    </table>
                            </div>

                          

                                        <div>
                                            <input type="submit" class="noPrint" name="simpan" value="Cetak" class="btn btn-primary" onclick="window.print()">
                                        </div>

                    </div>
                </div>
        </div>
    </div>
 <style>
    
        @media print{
            input.noPrint{
            display: none
            }
        }

 </style>
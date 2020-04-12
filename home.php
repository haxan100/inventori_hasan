  <?php
  include "koneksi.php";
  $sql = $koneksi->query("select count(kode_barang) as ttl from tb_barang ");
  $tampil = $sql->fetch_assoc();

  $sql1 = $koneksi->query("select count(kode_user) as ttl from tb_user ");
  $tampil1 = $sql1->fetch_assoc();

  $sql2 = $koneksi->query("select count(kode_barang_masuk) as ttl from tb_barang_masuk ");
  $tampil2 = $sql2->fetch_assoc();

  $sql3 = $koneksi->query("select count(kode_barang_keluar) as ttl from tb_barang_keluar ");
  $tampil3 = $sql3->fetch_assoc();

  $barang = $tampil['ttl'];
  $user = $tampil1['ttl'];
  $masuk = $tampil2['ttl'];
  $keluar = $tampil3['ttl'];
  ?>
  <h1>
    Dashboard
    <small>Control panel</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Dashboard</li>
  </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
          <div class="inner">
            <h3><?php echo $barang; ?></h3>

            <p>Barang</p>
          </div>
          <div class="icon">
            <i class="ion ion-bag"></i>

          </div>
          <a href="index.php?page=barangAll" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
          <div class="inner">
            <h3><?php echo $user; ?><sup style="font-size: 20px"></sup></h3>

            <p>User</p>
          </div>
          <div class="icon">
            <i class="ion ion-person"></i>
          </div>
          <a href="index.php?page=userall" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
          <div class="inner">
            <h3><?php echo $masuk; ?></h3>

            <p>Data Barang Masuk</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          <a href="?page=barangmasuk" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
          <div class="inner">
            <h3><?php echo $keluar; ?></h3>

            <p>Data Barang Keluar</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          <a href="?page=barangkeluar" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
    </div>
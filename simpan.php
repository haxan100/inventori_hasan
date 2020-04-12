<?php
include "koneksi.php";
$detail = date("Y-m-d-H:i:s") ;
$long = $_GET["longitude"];
$lat= $_GET["latitude"];
$kode = $_GET["kode"];

if($long !='' && $lat !='' ) {


	mysqli_query($konek , "update tb_gps set longitude = '$long', latitude = '$lat' , detail_waktu = '$detail' where kode_gps = '$kode' ");



	
	
}





?>
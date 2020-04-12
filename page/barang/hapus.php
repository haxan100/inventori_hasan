<?php

	$id = $_GET ['id'];
	$koneksi->query("delete from tb_barang where kode_barang='$id'");

?>

<script type="text/javascript">
	alert("Data Berhasil Dihapus");
	window.location.href="?page=barang";
	</script>
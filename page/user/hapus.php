<?php

	$id = $_GET ['id'];
	$koneksi->query("delete from tb_user where kode_user='$id'");

?>

<script type="text/javascript">
	alert("Data Berhasil Dihapus");
	window.location.href="?page=user";
	</script>
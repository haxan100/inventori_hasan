    <div class="panel panel-primary">
<div class="panel-heading">
	Tambah Data Barang Masuk

</div>

<div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    
                                    <form method="POST">
                                       <div class="form-group">
                                            <label>Nama Barang</label>
                                            <select class="form-control" name="tkode">
                                           <?php 
                        $sql = $koneksi->query("select * from tb_barang");
                            
                        while ($dataRow =  $sql->fetch_array()) {
                        if ($dataBagian == $dataRow['kode_barang']) {
                        $cek = " selected";
                        } else { $cek=""; }
                        echo "<option value='$dataRow[kode_barang]' $cek>$dataRow[nama_barang]</option>";
                        }
                        ?>
                                            </select>
                                        </div>
                                           <div class="form-group">
                                            <label>Jumlah Barang Masuk</label>
                                            <input class="form-control" name="tjumlah"  type="number" />
                                        </div>
                                         <div class="form-group" hidden="hidden">
                                            <label>kodeuser</label>
                                            <input class="form-control" name="tid"  value="<?php echo $_SESSION['admin']; ?>" />
                                        </div>
                                          

                                        <div>
                                        	<input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
                                        </div>
                                </div>
                                </form>         
                            </div>
</div>
</div>
</div>

<?php
	$kode = @$_POST ['tkode'];
	$jumlah = @$_POST ['tjumlah'];
	$tanggal = date("Y-m-d");
   $id = @$_POST ['tid'];
	$simpan = @$_POST['simpan'];



	if($simpan) {
if($kode !='' && $jumlah !='' && $id !='' ) {


	$sql = $koneksi->query("insert into tb_barang_masuk values('' , '$tanggal', '$kode' ,'$jumlah' ,'$id') ");
    $sql = $koneksi->query("update tb_barang set stok = stok + '$jumlah' where kode_barang = '$kode' ");


	
	if($sql) {
		?>
    			<script type="text/javascript">
				alert("Data Berhasil Disimpan");
				window.location.href="?page=barangmasuk";

			</script>
			<?php
	}
}
else{
    ?>
                <script type="text/javascript">
                alert("Data Tidak Boleh Kosong");

            </script>
            <?php
}

}


?>



   <?php
    $id = $_GET['id'];
    $sql = $koneksi->query("select * from tb_user where kode_user='$id'");
    $tampil = $sql->fetch_assoc();
   $lvl = $tampil['level'];
    
?>
    <div class="panel panel-primary">
<div class="panel-heading">
	Ubah Data

</div>

<div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    
                                    <form method="POST">
                                         <div class="form-group">
                                            <label>Id_user</label>
                                            <input class="form-control" name="tid"  value="<?php echo $tampil['kode_user'];?>" readonly="readonly" />
                                        </div>
                                          <div class="form-group">
                                            <label>Nama User</label>
                                            <input class="form-control" name="tnama"  value="<?php echo $tampil['nama_user'];?>"/>
                                        </div>
					<div class="form-group">
                                            <label>Password</label>
                                            <input class="form-control" name="tpassword"  value="<?php echo $tampil['password'];?>"/>
                                        </div>
                                          <div class="form-group">
                                            <label>Level</label>
                                             <select class="form-control" name="tlevel">
                                            <option value="Kepala Gudang"<?php if ($lvl=='Kepala Gudang')
                                            {echo "selected";} ?>>Kepala Gudang</option>

                                            <option value="Admin Gudang"<?php if ($lvl=='Admin Gudang')
                                            {echo "selected";} ?>>admin Gudang</option>
                                            </select>
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
$id = @$_POST ['tid'];
	$nama = @$_POST ['tnama'];
	$pass = @$_POST ['tpassword'];
	$level = @$_POST ['tlevel'];
   
	$simpan = @$_POST['simpan'];



	if($simpan) {
if($id !='' && $nama !='' && $pass !='' && $level !='') {


	$sql = $koneksi->query("update tb_user set nama_user = '$nama' ,password= '$pass' , level ='$level' where kode_user = '$id' ");


	
	if($sql) {
		?>
    			<script type="text/javascript">
				alert("Data Berhasil Disimpan");
				window.location.href="?page=user";

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



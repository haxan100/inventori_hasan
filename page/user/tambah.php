    <div class="panel panel-primary">
<div class="panel-heading">
	Tambah Data

</div>

<div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    
                                    <form method="POST">
                                          <div class="form-group">
                                            <label>Nama User</label>
                                            <input class="form-control" name="tnama" />
                                        </div>
					<div class="form-group">
                                            <label>Password</label>
                                            <input class="form-control" name="tpassword" />
                                        </div>
                                          <div class="form-group">
                                            <label>Level</label>
                                             <select class="form-control" name="tlevel">
                                            <option value="Kepala Gudang">Kepala Gudang</option>
                                            <option value="Admin Gudang">admin Gudang</option>
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
	$nama = @$_POST ['tnama'];
	$pass = @$_POST ['tpassword'];
	$level = @$_POST ['tlevel'];
   
    $simpan = @$_POST['simpan'];
    // $now = NOW();
    // var_dump($now);die;



	if($simpan) {
    if($nama !='' && $pass !='' && $level !='') {


	$sql = $koneksi->query("insert into tb_user values('' , '$nama' ,'$pass' ,'$level'");

    // var_dump($sql);die;
	
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



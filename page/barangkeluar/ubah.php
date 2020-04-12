      <?php
    $id = $_GET['id'];
    $sql = $koneksi->query("select * from tb_barang where kode_barang='$id'");
    $tampil = $sql->fetch_assoc();
    
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
                                            <label>Nama Barang</label>
                                            <input class="form-control" name="tkode" value="<?php echo $tampil['kode_barang'];?>" readonly="readonly" />
                                        </div>
                                        <div class="form-group">
                                            <label>Nama Barang</label>
                                            <input class="form-control" name="tnama" value="<?php echo $tampil['nama_barang'];?>" />
                                        </div>
                                           <div class="form-group">
                                            <label>Jenis Barang</label>
                                            <input class="form-control" name="tjenis" value="<?php echo $tampil['jenis_barang'];?>" />
                                        </div>
                                           <div class="form-group">
                                            <label>spesifikasi</label>
                                            <input class="form-control" name="tspek" value="<?php echo $tampil['spesifikasi'];?>" />
                                        </div>
                                       <div class="form-group">
                                            <label>Satuan</label>
                                            <input class="form-control" name="tsatuan" value="<?php echo $tampil['satuan'];?>" />
                                        </div>
                                           <div class="form-group">
                                            <label>No. Rak</label>
                                            <input class="form-control" name="trak" type="number" value="<?php echo $tampil['no_rak'];?>" />
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
    $nama = @$_POST ['tnama'];
    $jenis = @$_POST ['tjenis'];
    $spek = @$_POST ['tspek'];
    $satuan = @$_POST ['tsatuan'];
    $rak = @$_POST ['trak'];
   
    $simpan = @$_POST['simpan'];



    if($simpan) {
if($kode !='' && $nama !='' && $jenis !='' && $spek !='' && $satuan !='' && $rak !='') {


    $sql = $koneksi->query("update tb_barang set nama_barang = '$nama' , jenis_barang = '$jenis' , spesifikasi = '$spek', satuan ='$satuan', no_rak ='$rak' where kode_barang = '$kode' ");


    
    if($sql) {
        ?>
                <script type="text/javascript">
                alert("Data Berhasil Disimpan");
                window.location.href="?page=barang";

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



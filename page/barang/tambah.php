<?php


$sql = $koneksi->query("select * from tb_rak");




?>


<div class="panel panel-primary">
    <div class="panel-heading">
        Tambah Data

    </div>

    <div class="panel-body">
        <div class="row">
            <div class="col-md-12">

                <form method="POST">
                    <div class="form-group">
                        <label>Nama Barang</label>
                        <input class="form-control" name="tnama" id="nama_barang" />
                    </div>
                    <div class="form-group">
                        <label>Jenis Barang</label>
                        <input class="form-control" name="tjenis" id="jenis_barang" />
                    </div>
                    <div class="form-group">
                        <label>spesifikasi</label>
                        <input class="form-control" name="tspek" id="spesifikasi" />
                    </div>
                    <div class=" form-group">
                        <label>Satuan</label>
                        <select class="form-control selectpicker" data-show-subtext="false" data-live-search="true" id="satuan">
                            <option value="default" selected disabled="disabled">Pilih Satuan</option>
                            <?php
                            // ini_set('display_errors', 1);
                            // ini_set('display_startup_errors', 1);
                            // error_reporting(E_ALL);
                            $sql0 = "SELECT *FROM tb_satuan";
                            $sql = $koneksi->query($sql0);
                            // $data = $database1->query($sql);
                            // var_dump($data);
                            while ($row = $sql->fetch_array()) {
                                echo '
                                  <option value="' . $row['id_satuan'] . '" >' . $row['nama_satuan'] . '</option>
                                  ';
                            }
                            ?>
                    </div>
                    </select>
            </div>

            <div class="form-group">
                <label>Pilih Rak</label>

                <select class="form-control selectpicker" data-show-subtext="false" data-live-search="true" id="rak">
                    <option value="default" selected disabled="disabled">Pilih Rak</option>
                    <?php
                    // ini_set('display_errors', 1);
                    // ini_set('display_startup_errors', 1);
                    // error_reporting(E_ALL);
                    $sql0 = "SELECT *FROM tb_rak";
                    $sql = $koneksi->query($sql0);
                    // $data = $database1->query($sql);
                    // var_dump($data);
                    while ($row = $sql->fetch_array()) {
                        echo '
                                  <option value="' . $row['no_rak'] . '" >' . $row['nama_rak'] . '</option>
                                  ';
                    }
                    ?>
            </div>
            </select>
            <br>
            <p id="demo"></p>

            <div>
                <!-- <!-- <input type="submit" name="simpan" value="Simpan" id="simpan" class="btn btn-primary"> -->
            
                <input  id="simpan" class="btn btn-primary"> 
            </div>
        </div>
        </form>
    </div>
</div>
</div>
</div>

<?php
$nama = @$_POST['tnama'];
$jenis = @$_POST['tjenis'];
$spek = @$_POST['tspek'];
$satuan = @$_POST['tsatuan'];
$rak = @$_POST['inputToko'];
// var_dump($rak);

$simpan = @$_POST['simpan'];



if ($simpan) {
    if ($nama != '' && $jenis != '' && $spek != '' && $satuan != '' && $rak != '') {


        $sql = $koneksi->query("insert into tb_barang values('' , '$nama' ,'$jenis' ,'$spek','$satuan','0','$rak') ");



        if ($sql) {
?>
            <script type="text/javascript">
                alert("Data Berhasil Disimpan");
                window.location.href = "?page=barang";
            </script>
        <?php
        }
    } else {
        ?>
        <script type="text/javascript">
            // alert("Data Tidak Boleh Kosong");
        </script>
<?php
    }
}


?>

<script src="assets/js/jquery-3.4.1.min.js"></script>
<script>
    $(document).ready(function() {

        $('#inputToko').val('default').change();


        $("#satuan").change(function() {

            var id_satuan = $('#satuan option:selected').val();
            var rak = $('#rak option:selected').val();
            console.log(rak);
        });



        $('#simpan').on('click', function() {
            $('small.text-danger').html('');

            var nama_barang = $('#nama_barang').val();
            var jenis_barang = $('#jenis_barang').val();
            var spesifikasi = $('#spesifikasi').val();
            var rak = $('#rak option:selected').val();
            var satuan = $('#satuan option:selected').val();


            // console.log(spesifikasi);
            // return (false);

            if (nama_barang == '') {
                $('*[for="nama_barang"] > small').html('Harap diisi!');
            } else {
                $.ajax({
                    url: 'page/ajax/ajax.php',
                    dataType: 'json',
                    method: 'POST',
                    data: {
                        aksi: 'tambahBarang',
                        data: {
                            nama_barang: nama_barang,
                            jenis_barang: jenis_barang,
                            spesifikasi: spesifikasi,
                            rak: rak,
                            satuan: satuan,
                        }
                    }
                }).done(function(e) {
                    // console.log('berhasil');
                    console.log(e);
                    var alert = '';
                    if (!e.output.error) {
                        alert = 'alert-success';
                        refreshForm();
                    } else {
                        alert = 'alert-danger';
                    }
                    $('#alertNotif').html('<div class="alert ' + alert + ' alert-dismissible" role="alert"><span>' + e.output.message + '</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                    dataTable1.ajax.reload();
                }).fail(function(e) {
                    console.log('gagal');
                    console.log(e);
                    var alert = "Terjadi Kesalahan. #JSMGD01";
                    $('#alertNotif').html('<div class="alert ' + alert + ' alert-dismissible" role="alert"><span>' + e.output.message + '</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                }).always(function() {
                    //   console.log('selesai');
                });
            }
            // return false;
        });








    });
</script>
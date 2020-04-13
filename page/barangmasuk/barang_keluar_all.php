<style>
    .tombolEdit,
    .tombolHapus {
        width: 125px;
    }
</style>

<div class="title-text">Master Barang Keluar</div><br>

<p>
    <button class="btn btn-success" data-toggle="modal" data-target="#modalTambahMitra" href="#">
        <i class="fa fa-plus"></i> Tambah Barang Keluar
    </button>
</p>

<p id="alertNotif">
</p>

<p>


    <!-- </div> -->
    <div class="row">
        <div class="col-md-12">
            <!-- Advanced Tables -->
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Data Barang
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Barang Keluar</th>
                                    <th>Nama Barang</th>
                                    <th>Jenis Barang</th>
                                    <th>Nama Rak</th>
                                    <th>Tanggal</th>
                                    <th>Satuan</th>
                                    <th>Jumlah</th>
                                    <!-- <th>Nama User</th> -->
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Modal Tambah Mitra-->
    <div class="modal fade" id="modalTambahMitra" tabindex="-1" role="dialog" aria-labelledby="modalTambahMitraTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahMitraTitle">Tambah Barang Keluar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formTambahMitra">
                        <div class="form-group">
                            <label for="inputNamaBarang">Nama Barang <small class="text-danger"></small></label>
                            <select class="form-control" id="nama_barang">
                                <option value="default">Pilih Nama Barang</option>
                                <?php
                                // ini_set('display_errors', 1);
                                // ini_set('display_startup_errors', 1);
                                // error_reporting(E_ALL);
                                $sql0 = "SELECT *FROM tb_barang";
                                $sql = $koneksi->query($sql0);
                                // $data = $database1->query($sql);
                                // var_dump($data);
                                while ($row = $sql->fetch_array()) {
                                    echo '
                                  <option value="' . $row['kode_barang'] . '" >' . $row['nama_barang'] . '</option>
                                  ';
                                }
                                ?>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-body">
                    <form id="formTambahMitra">
                        <div class="form-group">
                            <label for="inputJumlah">Jumlah <small class="text-danger"></small></label>
                            <input type="text" class="form-control" id="jumlah" placeholder="Jumlah">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-success" id="tambahMitra"><i class="glyphicon glyphicon-plus"></i> Tambahkan Barang Keluar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Mitra-->
    <div class="modal fade" id="modalEditMitra" tabindex="-1" role="dialog" aria-labelledby="modalEditMitraTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditMitraTitle">Edit Barang Keluar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formEditBarang">
                        <div class="form-group">
                            <label for="inputNamaBarang">Nama Barang Keluar <small class="text-danger"></small></label>
                            <select class="form-control" id="nama_barang_keluar">
                                <option value="default">Pilih Nama Barang</option>
                                <?php
                                // ini_set('display_errors', 1);
                                // ini_set('display_startup_errors', 1);
                                // error_reporting(E_ALL);
                                $sql0 = "SELECT *FROM tb_barang";
                                $sql = $koneksi->query($sql0);
                                // $data = $database1->query($sql);
                                // var_dump($data);
                                while ($row = $sql->fetch_array()) {
                                    echo '
                                  <option value="' . $row['kode_barang'] . '" >' . $row['nama_barang'] . '</option>
                                  ';
                                }
                                ?>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-body">
                    <form id="formTambahMitra">
                        <div class="form-group">
                            <label for="inputEditJumlah">Jumlah <small class="text-danger"></small></label>
                            <input type="number" class="form-control" id="inputEditJumlah" placeholder="Jumlah">
                        </div>
                        <div class="form-group"></small></label>
                            <input type="hidden" class="form-control" id="KodeBarangKeluar">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-success" id="editMitra"><i class="glyphicon glyphicon-pencil"></i> Edit Barang Keluar</button>
                </div>
            </div>
        </div>
    </div>



    <script src="assets/js/jquery-3.4.1.min.js"></script>

    <script>
        function initSideBar() {
            var _idPage = $('#idPage').val();
            $('a[href="?page=' + _idPage + '"]').addClass('active');
        }







        $(document).ready(function() {
            setTimeout(() => {
                initSideBar();
            }, 1000);

            // Datatables
            var dataTable = $('#table').DataTable({
                "processing": true,
                "serverSide": true,
                "columnDefs": [{
                        "targets": 0,
                        "className": "dt-body-center dt-head-center",
                        "orderable": false,
                        "width": "50px"
                    },
                    {
                        "targets": 1,
                        "className": "dt-body-center dt-head-center"
                    },
                    {
                        "targets": 2,
                        "className": "dt-body-center dt-head-center"
                    },
                    {
                        "targets": 3,
                        "className": "dt-body-center dt-head-center",
                        "orderable": false
                    }, {
                        "targets": 4,
                        "className": "dt-body-center dt-head-center",
                        "orderable": false
                    }, {
                        "targets": 5,
                        "className": "dt-body-center dt-head-center",
                        "orderable": false
                    }, {
                        "targets": 6,
                        "className": "dt-body-center dt-head-center",
                        "orderable": false
                    }, {
                        "targets": 7,
                        "className": "dt-body-center dt-head-center",
                        "orderable": false
                    },
                    {
                        "targets": 8,
                        "className": "dt-body-center dt-head-center",
                        "orderable": false
                    },
                ],
                "order": [
                    [1, "asc"]
                ],
                "ajax": {
                    "url": "page/ajax/load_barang_keluar.php",
                    "type": "POST",
                }
            });

            // Button Tambah Mitra
            $('#tambahMitra').on('click', function() {

                console.log("tes");
                $('small.text-danger').html('');
                var kode_barang = $('#nama_barang  option:selected').val();
                var jumlah = $('#jumlah').val();
                // console.log(jumlah);
                // return (false);

                if (kode_barang == 'default') {
                    $('*[for="inputNamaBarang"] > small').html('Harap diisi!');
                } else if (jumlah == '') {
                    $('*[for="inputJumlah"] > small').html('Harap diisi!');
                } else {

                    $.ajax({
                        url: 'page/ajax/ajax.php',
                        dataType: 'json',
                        method: 'POST',
                        data: {
                            aksi: 'tambahBarangKeluar',
                            data: {
                                kode_barang: kode_barang,
                                jumlah: jumlah,
                            }
                        }
                    }).done(function(e) {
                        console.log('berhasil');
                        console.log(e);
                        $('#nama_barang').val('');
                        $('#jumlah').val('');
                        $('#modalTambahMitra').modal('hide'); //$('body').removeClass('modal-open');$('.modal-backdrop').remove();
                        var alert = '';
                        if (!e.output.error) {
                            alert = 'alert-success';
                        } else {
                            alert = 'alert-danger';
                        }
                        $('#alertNotif').html('<div class="alert ' + alert + ' alert-dismissible show" role="alert"><span>' + e.output.message + '</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                        dataTable.ajax.reload();

                    }).fail(function(e) {
                        console.log('gagal');
                        console.log(e);
                        var message = 'Terjadi Kesalahan. #JSMTR01';
                        $('#alertNotif').html('<div class="alert alert-danger alert-dismissible show" role="alert"><span>' + message + '</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                    }).always(function() {
                        console.log('selesai');
                    });
                }
                // return false;
            });

            $('#modalTambahMitra, #modalEditMitra').on('hidden.bs.modal', function(e) {
                $('small.text-danger').html('');
                console.log('tutup');
            });

            // Button Edit
            $('body').on('click', '.tombolEdit', function() {

                var kode_barang_keluar = $(this).data('kode_barang_keluar');
                var nama_barang = $(this).data('nama_barang_masuk');
                var jumlah_keluar = $(this).data('jumlah_keluar');
                var kode_barang = $(this).data('kode_barang');
                console.log(kode_barang);
                // return (false);
                $('#nama_barang_keluar').val(kode_barang);
                $('#inputEditJumlah').val(jumlah_keluar);
                $('#KodeBarangKeluar').val(kode_barang_keluar);
                // $('#inputEditStok').val(stok);
                $('#modalEditMitra').modal('show');
                return false;
            });


            // Button Edit Mitra
            $('#editMitra').on('click', function() {
                var kode_barang_keluar = $('#KodeBarangKeluar').val();
                var nama_barang = $('#nama_barang_keluar').val();
                var jumlah_keluar = $('#inputEditJumlah').val();

                // console.log(jumlah_keluar);
                // return (false);
                if (jumlah_keluar == '') {
                    $('*[for="inputEditJumlah"] > small').html('Harap diisi!');
                }
                if (nama_barang == 'default') {
                    $('*[for="inputNamaBarang"] > small').html('Harap dipilih!');
                } else {
                    $.ajax({
                        url: 'page/ajax/ajax.php',
                        dataType: 'json',
                        method: 'POST',
                        data: {
                            aksi: 'editBarangKeluar',
                            data: {
                                kode_barang_keluar: kode_barang_keluar,
                                nama_barang: nama_barang,
                                jumlah_keluar: jumlah_keluar,
                            }
                        }
                    }).done(function(e) {
                        console.log('berhasil');
                        console.log(e);
                        var alert = '';
                        $('#inputEditMitra').val('');
                        $('#inputEditPassword').val('');
                        $('#EditLevel').val('');
                        $('#modalEditMitra').modal('hide');
                        if (!e.output.error) {
                            alert = 'alert-success';
                        } else {
                            alert = 'alert-danger';
                        }
                        $('#alertNotif').html('<div class="alert ' + alert + ' alert-dismissible show" role="alert"><span>' + e.output.message + '</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                        dataTable.ajax.reload();

                    }).fail(function(e) {
                        console.log('gagal');
                        console.log(e);
                        var message = 'Terjadi Kesalahan. #JSMUT02';
                        $('#alertNotif').html('<div class="alert alert-danger alert-dismissible show" role="alert"><span>' + message + '</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                    }).always(function() {
                        console.log('selesai');
                    });
                }
                // return false;
            });

            // Button Hapus
            $('body').on('click', '.tombolHapus', function() {
                var kode_barang_keluar = $(this).data('kode_barang_keluar');
                var nama_barang = $(this).data('nama_barang');
                var c = confirm('Apakah anda yakin akan menghapus Barang: "' + nama_barang + '" ?');
                // console.log(kode_barang_keluar);return(false);
                if (c == true) {
                    $.ajax({
                        url: 'page/ajax/ajax.php',
                        dataType: 'json',
                        method: 'POST',
                        data: {
                            aksi: 'hapusBarangKeluar',
                            data: {
                                kode_barang_keluar: kode_barang_keluar,
                                nama_barang: nama_barang
                            }
                        }
                    }).done(function(e) {
                        console.log('berhasil');
                        console.log(e);
                        var alert = '';
                        if (!e.output.error) {
                            alert = 'alert-success';
                        } else {
                            alert = 'alert-danger';
                        }
                        $('#alertNotif').html('<div class="alert ' + alert + ' alert-dismissible show" role="alert"><span>' + e.output.message + '</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                        dataTable.ajax.reload();

                    }).fail(function(e) {
                        console.log('gagal');
                        console.log(e);
                        var message = 'Terjadi Kesalahan. #JSMUT03';
                        $('#alertNotif').html('<div class="alert alert-danger alert-dismissible show" role="alert"><span>' + message + '</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                    }).always(function() {
                        console.log('selesai');
                    });
                }
                return false;
            });

        });
    </script>
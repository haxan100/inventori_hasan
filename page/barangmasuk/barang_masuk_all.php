<style>
    .tombolEdit,
    .tombolHapus {
        width: 125px;
    }
</style>

<div class="title-text">Master Barang Masuk</div><br>

<p>
    <button class="btn btn-success" data-toggle="modal" data-target="#modalTambahMitra" href="#">
        <i class="fa fa-plus"></i> Tambah Barang Masuk
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
                                    <th>Kode Barang Masuk</th>
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
                    <h5 class="modal-title" id="modalTambahMitraTitle">Tambah Barang Masuk</h5>
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
                    <button type="button" class="btn btn-success" id="tambahMitra"><i class="glyphicon glyphicon-plus"></i> Tambahkan Barang Masuk</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Mitra-->
    <div class="modal fade" id="modalEditMitra" tabindex="-1" role="dialog" aria-labelledby="modalEditMitraTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditMitraTitle">Edit Barang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formEditBarang">
                        <div class="form-group">
                            <label for="inputEditBarang">Nama Barang <small class="text-danger"></small></label>
                            <input type="text" class="form-control" id="inputEditNamaBarang" placeholder="Nama Mitra..">
                            <input type="hidden" class="form-control" id="inputKodeBarang">
                        </div>
                    </form>
                </div>
                <div class="modal-body">
                    <form id="formTambahMitra">
                        <div class="form-group">
                            <label for="inputEditJenisBarang">Jenis Barang <small class="text-danger"></small></label>
                            <input type="text" class="form-control" id="inputEditJenisBarang" placeholder="Jenis Barang">
                        </div>
                    </form>
                </div>
                <div class="modal-body">
                    <form id="formTambahMitra">
                        <div class="form-group">
                            <label for="inputEditSpesifikasi">Spesifikasi <small class="text-danger"></small></label>
                            <input type="text" class="form-control" id="inputEditSpesifikasi" placeholder="Spesifikasi Barang">
                        </div>
                    </form>
                </div>
                <div class="modal-body">
                    <form id="formTambahMitra">
                        <div class="form-group">
                            <label for="inputEditStok">Stok <small class="text-danger"></small></label>
                            <input type="text" class="form-control" id="inputEditStok" placeholder="Stok Barang">
                        </div>
                    </form>
                </div>
                <div class="modal-body">
                    <form id="formTambahMitra">
                        <div class="form-group">
                            <label for="EditSatuan">Satuan <small class="text-danger"></small></label>
                            <select class="form-control" id="editSatuan">
                                <option value="default">Pilih Satuan</option>
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
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-body">
                    <form id="formTambahMitra">
                        <div class="form-group">
                            <label for="EditRak">Rak <small class="text-danger"></small></label>
                            <select class="form-control" id="editRak">
                                <option value="default">Pilih Rak</option>
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
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-success" id="editMitra"><i class="glyphicon glyphicon-pencil"></i> Edit User</button>
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
                            "url": "page/ajax/load_barang_masuk.php",
                            "type": "POST",
                        }
                    });

                    // Button Tambah Mitra
                    $('#tambahMitra').on('click', function() {

                            console.log("tes");
                            $('small.text-danger').html('');
                            var kode_barang = $('#nama_barang  option:selected'
                                ).val();
                                // console.log(kode_barang);
                                // return (false);
                                var jumlah = $('#jumlah').val();

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
                                            aksi: 'tambahBarangMasuk',
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

                            var kode_barang = $(this).data('kode_barang');
                            var nama_barang = $(this).data('nama_barang');
                            var jenis_barang = $(this).data('jenis_barang');
                            var spesifikasi = $(this).data('spesifikasi');
                            var satuan = $(this).data('satuan');
                            var rak = $(this).data('rak');
                            var stok = $(this).data('stok');
                            console.log(kode_barang);
                            $('#inputEditNamaBarang').val(nama_barang);
                            $('#inputEditJenisBarang').val(jenis_barang);
                            $('#inputEditSpesifikasi').val(spesifikasi);
                            $('#editSatuan').val(satuan);
                            $('#editRak').val(rak);
                            $('#inputKodeBarang').val(kode_barang);
                            $('#inputEditStok').val(stok);
                            $('#modalEditMitra').modal('show');
                            return false;
                        });


                        // Button Edit Mitra
                        $('#editMitra').on('click', function() {
                            var kode_barang = $('#inputKodeBarang').val();
                            var nama_barang = $('#inputEditNamaBarang').val();
                            var jenis_barang = $('#inputEditJenisBarang').val();
                            var spesifikasi = $('#inputEditSpesifikasi').val();
                            var satuan = $('#editSatuan').val();
                            var rak = $('#editRak').val();
                            var stok = $('#inputEditStok').val();

                            // console.log(kode_barang);
                            // return (false);
                            if (nama_barang == '') {
                                $('*[for="inputEditBarang"] > small').html('Harap diisi!');
                            }
                            if (satuan == 'default') {
                                $('*[for="EditSatuan"] > small').html('Harap dipilih!');
                            } else {
                                $.ajax({
                                    url: 'page/ajax/ajax.php',
                                    dataType: 'json',
                                    method: 'POST',
                                    data: {
                                        aksi: 'editBarang',
                                        data: {
                                            nama_barang: nama_barang,
                                            kode_barang: kode_barang,
                                            jenis_barang: jenis_barang,
                                            spesifikasi: spesifikasi,
                                            satuan: satuan,
                                            rak: rak,
                                            stok: stok,
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
                            var kode_barang = $(this).data('kode_barang');
                            var nama_barang = $(this).data('nama_barang');
                            var c = confirm('Apakah anda yakin akan menghapus Barang: "' + nama_barang + '" ?');
                            if (c == true) {
                                $.ajax({
                                    url: 'page/ajax/ajax.php',
                                    dataType: 'json',
                                    method: 'POST',
                                    data: {
                                        aksi: 'hapusBarang',
                                        data: {
                                            kode_barang: kode_barang,
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
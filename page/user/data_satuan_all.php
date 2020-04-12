<style>
    .tombolEdit,
    .tombolHapus {
        width: 125px;
    }
</style>

<div class="title-text">Master Barang</div><br>

<p>
    <button class="btn btn-success" data-toggle="modal" data-target="#modalTambahMitra" href="#">
        <i class="fa fa-plus"></i> Tambah Satuan
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
                                    <th>Kode Satuan</th>
                                    <th>Nama Satuan</th>

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
                    <h5 class="modal-title" id="modalTambahMitraTitle">Tambah Satuan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formTambahMitra">
                        <div class="form-group">
                            <label for="inputNamaSatuan">Nama Satuan <small class="text-danger"></small></label>
                            <input type="text" class="form-control" id="nama_satuan" placeholder="Nama Satuan">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-success" id="tambahMitra"><i class="glyphicon glyphicon-plus"></i> Tambahkan Satuan</button>
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
                            <label for="inputEditSatuan">Nama Satuan <small class="text-danger"></small></label>
                            <input type="text" class="form-control" id="inputEditNamaSatuan" placeholder="Nama Satuan..">
                            <input type="hidden" class="form-control" id="inputIdSatuan">
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
                        "orderable": false,
                    },

                ],
                "order": [
                    [1, "asc"]
                ],
                "ajax": {
                    "url": "page/ajax/load-satuanAll.php",
                    "type": "POST",
                }
            });

            // Button Tambah Mitra
            $('#tambahMitra').on('click', function() {

                console.log("tes");
                $('small.text-danger').html('');
                var nama_satuan = $('#nama_satuan').val();

                // console.log(nama, password, level);
                if (nama_satuan == '') {
                    $('*[for="inputNamaSatuan"] > small').html('Harap diisi!');
                } else {

                    $.ajax({
                        url: 'page/ajax/ajax.php',
                        dataType: 'json',
                        method: 'POST',
                        data: {
                            aksi: 'tambahSatuan',
                            data: {
                                nama_satuan: nama_satuan,
                            }
                        }
                    }).done(function(e) {
                        console.log('berhasil');
                        console.log(e);
                        $('#nama_satuan').val('');
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

                var id_satuan = $(this).data('id_satuan');
                var nama_satuan = $(this).data('nama_satuan');
                console.log(id_satuan);
                $('#inputEditNamaSatuan').val(nama_satuan);
                $('#inputIdSatuan').val(id_satuan);
                $('#modalEditMitra').modal('show');
                return false;
            });


            // Button Edit Mitra
            $('#editMitra').on('click', function() {
                var id_satuan = $('#inputIdSatuan').val();
                var nama_satuan = $('#inputEditNamaSatuan').val();

                // console.log(id_satuan);
                // return (false);
                if (nama_satuan == '') {
                    $('*[for="inputNamaSatuan"] > small').html('Harap diisi!');
                } else {
                    $.ajax({
                        url: 'page/ajax/ajax.php',
                        dataType: 'json',
                        method: 'POST',
                        data: {
                            aksi: 'editSatuan',
                            data: {
                                nama_satuan: nama_satuan,
                                id_satuan: id_satuan
                            }
                        }
                    }).done(function(e) {
                        console.log('berhasil');
                        console.log(e);
                        var alert = '';
                        $('#nama_satuan').val('');
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
                var id_satuan = $(this).data('id_satuan');
                var nama_satuan = $(this).data('nama_satuan');
                var c = confirm('Apakah anda yakin akan menghapus Satuan: "' + nama_satuan + '" ?');
                if (c == true) {
                    $.ajax({
                        url: 'page/ajax/ajax.php',
                        dataType: 'json',
                        method: 'POST',
                        data: {
                            aksi: 'hapusSatuan',
                            data: {
                                id_satuan: id_satuan,
                                nama_satuan: nama_satuan
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
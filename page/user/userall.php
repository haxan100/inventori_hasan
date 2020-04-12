<style>
    .tombolEdit,
    .tombolHapus {
        width: 125px;
    }
</style>

<div class="title-text">Master USer</div><br>

<p>
    <button class="btn btn-success" data-toggle="modal" data-target="#modalTambahMitra" href="#">
        <i class="fa fa-plus"></i> Tambah User
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
                    Data Usser
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode User</th>
                                    <th>Nama</th>
                                    <th>Level</th>
                                    <th>password</th>

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
                    <h5 class="modal-title" id="modalTambahMitraTitle">Tambah User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formTambahMitra">
                        <div class="form-group">
                            <label for="inputNamaUser">Nama User <small class="text-danger"></small></label>
                            <input type="text" class="form-control" id="nama_user" placeholder="Nama">
                        </div>
                    </form>
                </div>
                <div class="modal-body">
                    <form id="formTambahMitra">
                        <div class="form-group">
                            <label for="inputPassword">Password <small class="text-danger"></small></label>
                            <input type="text" class="form-control" id="password" placeholder="Password">
                        </div>
                    </form>
                </div>
                <div class="modal-body">
                    <form id="formTambahMitra">
                        <div class="form-group">
                            <label for="inputLevel">Level <small class="text-danger"></small></label>
                            <select class="form-control" id="level">
                                <option value="default">Pilih Level</option>
                                <option value="Kepala Gudang">Kepala Gudang</option>
                                <option value="Admin Gudang">admin Gudang</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-success" id="tambahMitra"><i class="fas fa-check"></i> Tambahkan Mitra</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Mitra-->
    <div class="modal fade" id="modalEditMitra" tabindex="-1" role="dialog" aria-labelledby="modalEditMitraTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditMitraTitle">Edit User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formEditMitra">
                        <div class="form-group">
                            <label for="inputEditUser">Nama User <small class="text-danger"></small></label>
                            <input type="text" class="form-control" id="inputEditMitra" placeholder="Nama Mitra..">
                            <input type="hidden" class="form-control" id="inputKodeUser">
                        </div>
                    </form>
                </div>
                <div class="modal-body">
                    <form id="formTambahMitra">
                        <div class="form-group">
                            <label for="inputEditPassword">Password <small class="text-danger"></small></label>
                            <input type="text" class="form-control" id="inputEditPassword" placeholder="Password">
                        </div>
                    </form>
                </div>
                <div class="modal-body">
                    <form id="formTambahMitra">
                        <div class="form-group">
                            <label for="EditLevel">Level <small class="text-danger"></small></label>
                            <select class="form-control" id="EditLevel">
                                <option value="default">Pilih Level</option>
                                <option value="Kepala Gudang">Kepala Gudang</option>
                                <option value="Admin Gudang">admin Gudang</option>
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
                    },
                ],
                "order": [
                    [1, "asc"]
                ],
                "ajax": {
                    "url": "page/ajax/load-userall.php",
                    "type": "POST",
                }
            });

            // Button Tambah Mitra
            $('#tambahMitra').on('click', function() {

                console.log("tes");
                $('small.text-danger').html('');
                var nama_user = $('#nama_user').val();
                var password = $('#password').val();
                var level = $('#level option:selected').val();

                // console.log(nama, password, level);
                if (nama_user == '') {
                    $('*[for="inputNamaUser"] > small').html('Harap diisi!');
                } else if (password == '') {
                    $('*[for="inputPassword"] > small').html('Harap diisi!');
                } else if (level == 'default') {
                    $('*[for="inputLevel"] > small').html('Harap diisi!');
                } else {

                    $.ajax({
                        url: 'page/ajax/ajax.php',
                        dataType: 'json',
                        method: 'POST',
                        data: {
                            aksi: 'tambahUser',
                            data: {
                                nama_user: nama_user,
                                password: password,
                                level: level,
                            }
                        }
                    }).done(function(e) {
                        console.log('berhasil');
                        console.log(e);
                        $('#inputTambahMitra').val('');
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

                var kode_user = $(this).data('kode_user');
                var nama_user = $(this).data('nama_user');
                var level = $(this).data('level');
                var password = $(this).data('password');
                console.log(kode_user, nama_user, level, password);
                $('#inputEditMitra').val(nama_user);
                $('#inputEditPassword').val(password);
                $('#EditLevel').val(level);
                $('#inputKodeUser').val(kode_user);
                $('#modalEditMitra').modal('show');
                return false;
            });


            // Button Edit Mitra
            $('#editMitra').on('click', function() {
                var nama_user = $('#inputEditMitra').val();
                var password = $('#inputEditPassword').val();
                var level = $('#EditLevel').val();
                var kode_user = $('#inputKodeUser').val();

                // console.log(nama_user, kode_user, level, password);return(false);
                if (nama_user == '') {
                    $('*[for="inputEditMitra"] > small').html('Harap diisi!');
                }
                if (level == 'default') {
                    $('*[for="EditLevel"] > small').html('Harap dipilih!');
                } else {
                    $.ajax({
                        url: 'page/ajax/ajax.php',
                        dataType: 'json',
                        method: 'POST',
                        data: {
                            aksi: 'editUser',
                            data: {
                                nama_user: nama_user,
                                password: password,
                                level: level,
                                kode_user: kode_user
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
                var kode_user = $(this).data('kode_user');
                var nama_user = $(this).data('nama');
                var c = confirm('Apakah anda yakin akan menghapus User: "' + nama_user + '" ?');
                if (c == true) {
                    $.ajax({
                        url: 'page/ajax/ajax.php',
                        dataType: 'json',
                        method: 'POST',
                        data: {
                            aksi: 'hapusUser',
                            data: {
                                kode_user: kode_user,
                                nama_user: nama_user
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
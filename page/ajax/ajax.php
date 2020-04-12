<?php


include('../db/config.php');
include('../db/function.php'); //

session_start();


if (
    $_POST['aksi'] === null ||
    $_POST['aksi'] === 'undefined' ||
    $_POST['aksi'] === '' ||
    empty($_POST['aksi'])
) {
    // echo $_POST['aksi'];
    die('No Action!!');
} else {
    $output = array(
        'params' => array(
            'aksi' => $_POST['aksi'],
            'data' => $_POST['data']
        )
    );


    
    $error = true;
    $msg = 'Tidak ada pesan! #AJX00';
    $dataArray = array();



    switch ($_POST['aksi']) {
        
        
        case 'tambahBarang': {
            
            $namaMitra = freeInput($database, $_POST['data']['nama_barang']);
            $jenis_barang = freeInput($database, $_POST['data']['jenis_barang']);
            $spesifikasi = freeInput($database, $_POST['data']['spesifikasi']);
            $rak = freeInput($database, $_POST['data']['rak']);
            $satuan = freeInput($database, $_POST['data']['satuan']);
            $stok=1;
            
            // var_dump($namaMitra);die;
            $sql = "SELECT kode_barang FROM tb_barang WHERE nama_barang='$namaMitra'";
            
            // var_dump($_POST);die;
            $data  = $database->query($sql)->num_rows;
            // var_dump($data);die;
            if ($data >0) {
                $msg = "Nama Barang sudah ada!";
            } else {
                if ($namaMitra == '') {
                    $msg = "Nama Barang harap diisi!";
                } else {
                    $sql = "INSERT INTO tb_barang(kode_barang, nama_barang, jenis_barang,spesifikasi,satuan,stok,no_rak) VALUES(NULL, '$namaMitra', '$jenis_barang', '$spesifikasi', '$satuan' ,'$stok' ,'$rak')";
                    // var_dump($sql);die;  
                    if ($database->query($sql)) {
                       
                        $error = false;
                        $msg = "Berhasil menambahkan Barang: <b>$namaMitra</b>";
                    } else {
                        $msg = "Terjadi Kesalahan. #AJX01 <br>" . $konek->error;
                    }
                }
            }
            break;
        }
        case 'hapusBarang': {

                $kode_barang = freeInput($database, $_POST['data']['kode_barang']);
                $nama_barang = freeInput($database, $_POST['data']['nama_barang']);

                // var_dump($namaMitra);die;
                $sql = "SELECT kode_barang FROM tb_barang WHERE nama_barang='$nama_barang'";

                // var_dump($_POST);die;
                $data  = $database->query($sql)->num_rows;
                // var_dump($data);die;
                if ($data < 1) {
                    $msg = "Nama Barang Tidak ada!";
                } else {

                    $sql = "DELETE From tb_barang where kode_barang='$kode_barang'";
                    // var_dump($sql);die;  
                    if ($database->query($sql)) {

                        $error = false;
                        $msg = "Berhasil Menghapus Brang: <b>$nama_barang</b>";
                    } else {
                        $msg = "Terjadi Kesalahan. #AJX02B <br>" . $database->error;
                    }
                }
                break;
            }
        case 'editBarang': {

                $kode_barang = freeInput($database, $_POST['data']['kode_barang']);
                $nama_barang = freeInput($database, $_POST['data']['nama_barang']);
                $jenis_barang = freeInput($database, $_POST['data']['jenis_barang']);
                $spesifikasi = freeInput($database, $_POST['data']['spesifikasi']);
                $satuan = freeInput($database, $_POST['data']['satuan']);
                $rak = freeInput($database, $_POST['data']['rak']);
                $stok = freeInput($database, $_POST['data']['stok']);

                // var_dump($namaMitra);die;
                $sql = "SELECT kode_barang FROM tb_barang WHERE kode_barang='$kode_barang' ";

                // var_dump($sql);die;
                $data  = $database->query($sql)->num_rows;
                // var_dump($data);die;
                if ($data < 1) {
                    $msg = "Barang Yang Di Maksud Tidak ada!";
                } else {

                    $sql = "UPDATE tb_barang SET 
                                    nama_barang='$nama_barang',
                                    jenis_barang='$jenis_barang', 
                                    spesifikasi='$spesifikasi',
                                    satuan='$satuan',
                                    no_rak='$rak',
                                    stok='$stok'
                                    WHERE kode_barang='$kode_barang'
                                ";
                    // var_dump($sql);die;  
                    if ($database->query($sql)) {

                        $error = false;
                        $msg = "Berhasil Mengubah Barang: <b>$nama_barang</b>";
                    } else {
                        $msg = "Terjadi Kesalahan. #AJX03 <br>" . $database->error;
                    }
                }
                break;
            }

        case 'tambahUser': {

                $nama_user = freeInput($database, $_POST['data']['nama_user']);
                $password = freeInput($database, $_POST['data']['password']);
                $level = freeInput($database, $_POST['data']['level']);
                $date=date('Y-m-d');

                // var_dump($namaMitra);die;
                $sql = "SELECT kode_user FROM tb_user WHERE nama_user='$nama_user' and level='$level'";

                // var_dump($_POST);die;
                $data  = $database->query($sql)->num_rows;
                // var_dump($data);die;
                if ($data >0) {
                    $msg = "Nama User sudah ada!";
                } else {
                    if ($nama_user == '') {
                        $msg = "Nama User harap diisi!";
                    }
                    elseif ($password == '') {
                        $msg = "Password harap diisi!";
                    }
                    elseif ($level == 'default') {
                        $msg = "Level Harap DI Pilih";
                    } else {
                        $sql = "INSERT INTO tb_user(kode_user, nama_user, password,level,registed_at) VALUES(NULL, '$nama_user', '$password', '$level','$date')";
                        // var_dump($sql);die;  
                        if ($database->query($sql)) {

                            $error = false;
                            $msg = "Berhasil menambahkan User: <b>$nama_user</b>";
                        } else {
                            $msg = "Terjadi Kesalahan. #AJX01 <br>" . $database->error;
                        }
                    }
                }
                break;
            }
        case 'hapusUser': {

                $kode_user = freeInput($database, $_POST['data']['kode_user']);
                $nama_user = freeInput($database, $_POST['data']['nama_user']);

                // var_dump($namaMitra);die;
                $sql = "SELECT kode_user FROM tb_user WHERE nama_user='$nama_user'";

                // var_dump($_POST);die;
                $data  = $database->query($sql)->num_rows;
                // var_dump($data);die;
                if ($data < 1) {
                    $msg = "Nama User Tidak ada!";
                } else {
                    
                        $sql = "DELETE From tb_user where kode_user='$kode_user'";
                        // var_dump($sql);die;  
                        if ($database->query($sql)) {

                            $error = false;
                            $msg = "Berhasil Menghapus User: <b>$nama_user</b>";
                        } else {
                            $msg = "Terjadi Kesalahan. #AJX02 <br>" . $database->error;
                        }
                  
                }
                break;
            }
        case 'editUser': {

                $kode_user = freeInput($database, $_POST['data']['kode_user']);
                $nama_user = freeInput($database, $_POST['data']['nama_user']);
                $password = freeInput($database, $_POST['data']['password']);
                $level = freeInput($database, $_POST['data']['level']);

                // var_dump($namaMitra);die;
                $sql = "SELECT kode_user FROM tb_user WHERE nama_user='$nama_user'";

                // var_dump($_POST);die;
                $data  = $database->query($sql)->num_rows;
                // var_dump($data);die;
                if ($data > 1) {
                    $msg = "Nama User Tidak ada!";
                } else {

                    $sql = "UPDATE tb_user SET 
                                    nama_user='$nama_user',
                                    password='$password', 
                                    level='$level',
                                    registed_at=NOW() 
                                    WHERE kode_user='$kode_user'
                                ";
                    // var_dump($sql);die;  
                    if ($database->query($sql)) {

                        $error = false;
                        $msg = "Berhasil Mengubah User: <b>$nama_user</b>";
                    } else {
                        $msg = "Terjadi Kesalahan. #AJX03 <br>" . $database->error;
                    }
                }
                break;
            }
        case 'tambahSatuan': {

                $nama_satuan = freeInput($database, $_POST['data']['nama_satuan']);

                // var_dump($namaMitra);die;
                $sql = "SELECT id_satuan FROM tb_satuan WHERE nama_satuan='$nama_satuan'";

                // var_dump($_POST);die;
                $data  = $database->query($sql)->num_rows;
                // var_dump($data);die;
                if ($data > 0) {
                    $msg = "Nama Satuan sudah ada!";
                } else {
                    if ($nama_satuan == '') {
                        $msg = "Nama Satuan harap diisi!";
                    } else {
                        $sql = "INSERT INTO tb_satuan(id_satuan, nama_satuan) VALUES(NULL, '$nama_satuan')";
                        // var_dump($sql);die;  
                        if ($database->query($sql)) {

                            $error = false;
                            $msg = "Berhasil menambahkan Satuan: <b>$nama_satuan</b>";
                        } else {
                            $msg = "Terjadi Kesalahan. #AJX04B <br>" . $database->error;
                        }
                    }
                }
                break;
            }
        case 'hapusSatuan': {

                $id_satuan = freeInput($database, $_POST['data']['id_satuan']);
                $nama_satuan = freeInput($database, $_POST['data']['nama_satuan']);

                // var_dump($namaMitra);die;
                $sql = "SELECT id_satuan FROM tb_satuan WHERE nama_satuan='$nama_satuan'";

                // var_dump($sql);die;
                $data  = $database->query($sql)->num_rows;
                // var_dump($data);die;
                if ($data < 1) {
                    $msg = "Nama Satuan Tidak ada!";
                } else {

                    $sql = "DELETE From tb_satuan where id_satuan='$id_satuan'";
                    // var_dump($sql);die;  
                    if ($database->query($sql)) {

                        $error = false;
                        $msg = "Berhasil Menghapus Satuan: <b>$nama_satuan</b>";
                    } else {
                        $msg = "Terjadi Kesalahan. #AJX04B <br>" . $database->error;
                    }
                }
                break;
        }

        case 'editSatuan': {

                $id_satuan = freeInput($database, $_POST['data']['id_satuan']);
                $nama_satuan = freeInput($database, $_POST['data']['nama_satuan']);

                // var_dump($namaMitra);die;
                $sql = "SELECT id_satuan FROM tb_satuan WHERE nama_satuan='$nama_satuan'";

                // var_dump($_POST);die;
                $data  = $database->query($sql)->num_rows;
                // var_dump($data);die;
                if ($data > 1) {
                    $msg = "Nama Satuan Tidak ada!";
                } else {

                    $sql = "UPDATE tb_satuan SET 
                                    nama_satuan='$nama_satuan'
                                    WHERE id_satuan='$id_satuan'
                                ";
                    // var_dump($sql);die;  
                    if ($database->query($sql)) {

                        $error = false;
                        $msg = "Berhasil Mengubah Satuan: <b>$nama_satuan</b>";
                    } else {
                        $msg = "Terjadi Kesalahan. #AJX04C <br>" . $database->error;
                    }
                }
                break;
        }

        case 'tambahRak': {

                $nama_rak = freeInput($database, $_POST['data']['nama_rak']);

                // var_dump($namaMitra);die;
                $sql = "SELECT no_rak FROM tb_rak WHERE nama_rak='$nama_rak'";

                // var_dump($_POST);die;
                $data  = $database->query($sql)->num_rows;
                // var_dump($data);die;
                if ($data > 0) {
                    $msg = "Nama Rak sudah ada!";
                } else {
                    if ($nama_rak == '') {
                        $msg = "Nama Rak harap diisi!";
                    } else {
                        $sql = "INSERT INTO tb_rak(no_rak, nama_rak) VALUES(NULL, '$nama_rak')";
                        // var_dump($sql);die;  
                        if ($database->query($sql)) {

                            $error = false;
                            $msg = "Berhasil menambahkan Rak: <b>$nama_rak</b>";
                        } else {
                            $msg = "Terjadi Kesalahan. #AJX05 <br>" . $database->error;
                        }
                    }
                }
                break;
        }

        case 'editRak': {

                $no_rak = freeInput($database, $_POST['data']['no_rak']);
                $nama_rak = freeInput($database, $_POST['data']['nama_rak']);

                // var_dump($no_rak);die;
                $sql = "SELECT no_rak FROM tb_rak WHERE nama_rak='$nama_rak'";

                // var_dump($sql);die;
                $data  = $database->query($sql)->num_rows;
                // var_dump($data);die;
                if ($data  >1 ) {
                    $msg = "Nama Rak Tidak ada!";
                } else {

                    $sql = "UPDATE tb_rak SET 
                                    nama_rak='$nama_rak'
                                    WHERE no_rak='$no_rak'";
                    // var_dump($sql);die;  
                    if ($database->query($sql)) {

                        $error = false;
                        $msg = "Berhasil Mengubah Rak: <b>$nama_rak</b>";
                    } else {
                        $msg = "Terjadi Kesalahan. #AJX04C <br>" . $database->error;
                    }
                }
                break;
            }
        case 'tambahBarangMasuk': {

                $kode_barang = freeInput($database, $_POST['data']['kode_barang']);
                $jumlah = freeInput($database, $_POST['data']['jumlah']);

                $tanggal = date("Y-m-d");
                // $_SESSION
                $id = $_SESSION['admin'];
                // var_dump($kode_barang);die;
                // $sql = "SELECT no_rak FROM tb_rak WHERE nama_rak='$nama_rak'";

                // // var_dump($_POST);die;
                // $data  = $database->query($sql)->num_rows;
                // var_dump($data);die;
              
                    if ($kode_barang == '') {
                        $msg = "Nama Barang Harap  Di Pilih!";
                    } else {
                        $sql = "INSERT INTO tb_barang_masuk(kode_barang_masuk, tanggal_masuk,kode_barang,jumlah_masuk,kode_user) VALUES(NULL, '$$tanggal','$kode_barang','$jumlah','$id')";
                        // var_dump($sql);die;  
                        if ($database->query($sql)) {
                            $sql2="update tb_barang set stok = stok + '$jumlah' where kode_barang = '$kode_barang' ";
                            $database->query($sql2);


                            $error = false;
                            $msg = "Berhasil menambahkan Barang Masuk: ";
                        } else {
                            $msg = "Terjadi Kesalahan. #AJX06A <br>" . $database->error;
                        }
                   
                }
                break;
            }
        case 'editBarangMasuk': {

                $kode_barang_masuk = freeInput($database, $_POST['data']['kode_barang_masuk']);
                $nama_barang = freeInput($database, $_POST['data']['nama_barang']);
                $jumlah_masuk = freeInput($database, $_POST['data']['jumlah_masuk']);

                // var_dump($nama_barang);die;
                $sql = "SELECT kode_barang_masuk FROM tb_barang_masuk WHERE kode_barang_masuk='$kode_barang_masuk'";

                // var_dump($sql);die;
                $data  = $database->query($sql)->num_rows;
                // var_dump($data);die;
                if ($data  > 1) {
                    $msg = "Barang Tidak ada!";
                } else {

                    $sql = "UPDATE tb_barang_masuk SET 
                                    kode_barang='$nama_barang' ,jumlah_masuk='$jumlah_masuk'
                                    WHERE kode_barang_masuk='$kode_barang_masuk'";
                    // var_dump($sql);die;  
                    if ($database->query($sql)) {

                        $sql2 = "update tb_barang set stok = stok + '$jumlah_masuk' where kode_barang = '$nama_barang' ";
                        $database->query($sql2);

                        $error = false;
                        $msg = "Berhasil Mengubah Barang Masuk";
                    } else {
                        $msg = "Terjadi Kesalahan. #AJX06B <br>" . $database->error;
                    }
                }
                break;
            }

        case 'hapusBarangMasuk': {

                $kode_barang_masuk = freeInput($database, $_POST['data']['kode_barang_masuk']);
                $nama_barang = freeInput($database, $_POST['data']['nama_barang']);

                // var_dump($namaMitra);die;
                $sql = "SELECT kode_barang FROM tb_barang_masuk WHERE kode_barang_masuk='$kode_barang_masuk'";

                // var_dump($sql);die;
                $data  = $database->query($sql)->num_rows;
                // var_dump($data);die;
                if ($data < 1) {
                    $msg = "Nama Barang Masuk Tidak ada!";
                } else {

                    $sql = "DELETE From tb_barang_masuk where kode_barang_masuk='$kode_barang_masuk'";
                    // var_dump($sql);die;  
                    if ($database->query($sql)) {

                        $error = false;
                        $msg = "Berhasil Menghapus Barang Masuk</b>";
                    } else {
                        $msg = "Terjadi Kesalahan. #AJX06C <br>" . $database->error;
                    }
                }
                break;
            }



}
    $output["output"] = array(
        'error' => $error,
        'message' => $msg,
        'data' => $dataArray,
    ); 



    echo json_encode($output);
}




?>
<?php 

include('../../db/config.php');
include('../../db/function.php'); 


  switch ($_POST['aksi']) {


    case 'tambahBarang': {

            $namaMitra = freeInput($database, $_POST['data']['nama_barang']);

            var_dump($namaMitra);die;
            $sql = "SELECT id FROM master_mitra_utama WHERE nama='$namaMitra'";
            $data  = $database->query($sql)->num_rows;
            if ($data > 0) {
                $msg = "Nama mitra sudah ada!";
            } else {
                if ($namaMitra == '') {
                    $msg = "Nama mitra harap diisi!";
                } else {
                    $sql = "INSERT INTO master_mitra_utama(id, nama, updated) VALUES(NULL, '$namaMitra', NOW())";
                    if ($database->query($sql)) {
                        $in = array(
                            'user' => $user,
                            'id' => 42,
                            'ket' => 'Nama Mitra Utama : ' . $namaMitra,
                        );
                        // var_dump($in);die();
                        log_aksi($database, $in);
                        $error = false;
                        $msg = "Berhasil menambahkan Mitra Utama: <b>$namaMitra</b>";
                    } else {
                        $msg = "Terjadi Kesalahan. #AJX01 <br>" . $database->error;
                    }
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




?>
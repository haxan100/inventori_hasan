<?php

function isDev()
{
    // return true; // jika dev
    return false; // jika prod
}

$databasePortalweb = isDev() ? 'dev_portalweb' : 'db_inventor';
$databasePlusphone = isDev() ? 'dev_plusphone' : 'db_inventor';

function freeInput($database, $str)
{
    $str = $database->real_escape_string(htmlentities(trim($str)));
    return $str;
}

function cekAksesUser($database, $role_index, $onlyPOST = true)
{
    if (!isset($_SESSION["id_user"]) || ($_SERVER['REQUEST_METHOD'] != 'POST' && $onlyPOST)) { // jika tidak ada sesi
        die('403 Access Forbidden!!! #1');
    }
    $role = getUserRole($database, $_SESSION['id_user']);
    if (is_array($role_index)) {
        $array_true = array();
        foreach ($role_index as $index) {
            if ($role[$index] != 1) {
                $array_true[] = false;
            } else {
                $array_true[] = true;
            }
        }
        // var_dump($array_true);die;
        if (!in_array(true, $array_true)) die('403 Access Forbidden!!! #2');
    } else {
        if ($role[$role_index] != 1) {
            die('403 Access Forbidden!!! #3');
        }
    }
}

function log_aksi($database, $in)
{
    $id = $in['id'];
    $user = $in['user'];
    $ket = "[" . getLogKategori($database, $id) . "]\n" . $in['ket'];
    $sql = "INSERT INTO log_aksi(id_log_aksi, user, kategori, aksi, created_at) 
    VALUES(NULL, '$user', '$id', '$ket', NOW()
    )";
    $database->query($sql);
}

function getTipePameran($no)
{
    switch ($no) {
        default:;
        case 1:
            return 'Smartphone';
            break;
        case 2:
            return 'Smartwatch';
            break;
        case 3:
            return 'Elektronik';
            break;
    }
}

function getTipeDetailBudgetMarketing($id = 100)
{
    $tipeDetail = array(
        1 => 'Material Iklan',
        2 => 'Promotor',
        3 => 'Insentif',
        99 => 'Lainnya',
    );

    if ($id == 0) return "Subsidi";
    else if (0 < $id && $id < 100) return $tipeDetail[$id];
    else return $tipeDetail;
}

function getKategoriMarket($id = 100)
{
    $kategoriMarket = array(
        1 => 'Dealer',
        2 => 'Bidding',
        3 => 'E-commerce',
        99 => 'Lainnya',
    );

    if ($id == 0) return "Kategori";
    else if (0 < $id && $id < 100) return $kategoriMarket[$id];
    else return $kategoriMarket;
}

function getStatusTransaksi($id = 0)
{
    $kategoriMarket = array(
        0 => 'Belum Selesai',
        1 => 'Menunggu Pembayaran',
        2 => 'Selesai',
        99 => 'Gagal',
    );

    if (0 <= $id && $id < 100) return $kategoriMarket[$id];
    else return $kategoriMarket; // return array nya
}

function getLogKategori($database, $idLogKategori)
{
    $sql = "SELECT kategori FROM log_kategori WHERE id_log_kategori='$idLogKategori'";
    $data  = $database->query($sql);
    $out = "Undefined!";
    if ($data->num_rows > 0) {
        $row = $data->fetch_array();
        $out = $row["kategori"];
    }

    return $out;
}

function getUsername($database, $idUser)
{
    $sql = "SELECT username FROM user WHERE id_user='$idUser'";
    $data  = $database->query($sql);
    $out = "Undefined!";
    if ($data->num_rows > 0) {
        $row = $data->fetch_array();
        $out = $row["username"];
    }

    return $out;
}
function getUsernameMitra($database, $idUser)
{
    $sql = "SELECT username FROM user_mitra WHERE id_user_mitra='$idUser'";
    $data  = $database->query($sql);
    $out = "Undefined!";
    if ($data->num_rows > 0) {
        $row = $data->fetch_array();
        $out = $row["username"];
    }

    return $out;
}


function getNamaMitra($database, $idMitra)
{
    // $idMitra = id mitra utama
    $sql = "SELECT nama FROM master_mitra_utama WHERE id='$idMitra'";
    $data  = $database->query($sql);
    $out = "Undefined!";
    if ($data->num_rows > 0) {
        $row = $data->fetch_array();
        $out = $row["nama"];
    }

    return $out;
}

function getNamaMitraById($database, $idMitra)
{
    $sql = "SELECT nama_mitra FROM mitra_utama WHERE id_mitra='$idMitra'";
    $data  = $database->query($sql);
    $out = "Undefined!";
    if ($data->num_rows > 0) {
        $row = $data->fetch_array();
        $out = $row["nama_mitra"];
    }

    return $out;
}

function removeKoma($str)
{
    $str = str_replace(',', '', $str);
    $str = str_replace('.', '', $str);
    return $str;
}

function formatHarga($str)
{
    $str = number_format($str, 0, ',', '.');
    return $str;
}

function formatUang($str)
{
    $str = "Rp " . number_format($str, 0, ',', '.');
    return $str;
}

function getUserRole($database, $id_user)
{
    $sql = "SELECT * FROM user_role WHERE id_user='$id_user'";
    $role = $database->query($sql)->fetch_array();
    return $role;
}

function getLastIdUser($database)
{
    $sql = "SELECT MAX(id_user) AS last_id FROM user";
    $out = $database->query($sql)->fetch_array();
    return $out['last_id'];
}

function getUserMitraRole($database, $id_user)
{
    $sql = "SELECT * FROM user_mitra_role WHERE id_user_mitra='$id_user'";
    $role = $database->query($sql)->fetch_assoc();
    return $role;
}

function getLastIdUserMitra($database)
{
    $sql = "SELECT MAX(id_user_mitra) AS last_id FROM user_mitra";
    $out = $database->query($sql)->fetch_array();
    return $out['last_id'];
}

function getFirstPageRoleUserMitra($database, $id_user_mitra)
{
    $role = getUserMitraRole($database, $id_user_mitra);
    unset($role['id_user_mitra']);
    return array_search("1", $role);
}

function getNamaMitraUtama($database, $idMU)
{
    $sql = "SELECT nama FROM master_mitra_utama WHERE id='$idMU'";
    $data  = $database->query($sql);
    $out = "Undefined!";
    if ($data->num_rows > 0) {
        $row = $data->fetch_array();
        $out = $row["nama"];
    }

    return $out;
}

function getidKategoriMarket($database, $kategoriMarket)
{
    $sql = "SELECT id_kategoriMarket FROM master_market WHERE id_kategoriMarket='$kategoriMarket'";
    $data  = $database->query($sql);
    $out = "Undefined!";
    if ($data->num_rows > 0) {
        $row = $data->fetch_array();
        $out = $row["id_kategoriMarket"];
    }

    return $out;
}

function getImeiByKodeTradein($database, $kode_tradein)
{
    $sql = "SELECT imei FROM tradein WHERE kode_tradein='$kode_tradein'";
    $data  = $database->query($sql);
    $out = "";
    if ($data->num_rows > 0) {
        $row = $data->fetch_array();
        $out = $row["imei"];
    }

    return $out;
}

function getImeiByIdCek($database, $id_cek)
{
    $sql = "SELECT imei FROM tradein WHERE id_cek='$id_cek'";
    $data  = $database->query($sql);
    $out = "";
    if ($data->num_rows > 0) {
        $row = $data->fetch_array();
        $out = $row["imei"];
        // var_dump($out);die();
    }

    return $out;
}

function getKodeIdCekByIMEI($database, $imei)
{
    $sql = "SELECT id_cek FROM tradein WHERE imei='$imei'";
    $data  = $database->query($sql);
    $out = "";
    // var_dump($sql);die();
    // var_dump($data);die();
    if ($data->num_rows > 0) {
        $row = $data->fetch_array();
        $out = $row["id_cek"];
    }

    return $out;
}

function getIdCekByKodeTradein($database, $kode_tradein)
{
    $sql = "SELECT id_cek FROM tradein WHERE kode_tradein='$kode_tradein'";
    $data  = $database->query($sql);
    $out = "";
    // var_dump($sql);die();
    // var_dump($data);die();
    if ($data->num_rows > 0) {
        $row = $data->fetch_array();
        $out = $row["id_cek"];
    }

    return $out;
}
function getIdCekByLogistik($database, $kode_tradein, $imei)
{
    $sql = "SELECT id_cek FROM logistik WHERE kode_tradein='$kode_tradein' AND imei='$imei'";
    $data  = $database->query($sql);
    $out = "";
    // var_dump($sql);die();
    // var_dump($data);die();
    if ($data->num_rows > 0) {
        $row = $data->fetch_array();
        $out = $row["id_cek"];
    }

    return $out;
}
function getIdCekByLogistiksmartwatch($database, $kode_tradein, $imei)
{
    $sql = "SELECT id_cek FROM logistik_smartwatch WHERE kode_tradein='$kode_tradein' AND imei='$imei'";
    $data  = $database->query($sql);
    $out = "";
    // var_dump($sql);die();
    // var_dump($data);die();
    if ($data->num_rows > 0) {
        $row = $data->fetch_array();
        $out = $row["id_cek"];
    }

    return $out;
}
function getIdCekSmartwatchByKodeTradein($database, $kode_tradein)
{
    $sql = "SELECT id_cek FROM tradein_smartwatch WHERE kode_tradein='$kode_tradein'";
    $data  = $database->query($sql);
    $out = "";
    // var_dump($sql);die();
    // var_dump($data);die();
    if ($data->num_rows > 0) {
        $row = $data->fetch_array();
        $out = $row["id_cek"];
    }

    return $out;
}

function getKodeTradeinByIdCek($database, $id_cek)
{
    $sql = "SELECT kode_tradein FROM tradein WHERE id_cek='$id_cek'";
    $data  = $database->query($sql);
    $out = "";
    // var_dump($data);die();
    if ($data->num_rows > 0) {
        $row = $data->fetch_array();
        $out = $row["kode_tradein"];
    }

    return $out;
}

function getHargaByIdCek($database, $id_cek)
{
    $sql = "SELECT harga_apps FROM tradein WHERE id_cek='$id_cek'";
    $data  = $database->query($sql);
    $out = 0;
    // var_dump($sql);die();
    if ($data->num_rows > 0) {
        $row = $data->fetch_array();
        $out = $row["harga_apps"];
    }

    return $out;
}

function getHargaSmartwatchByIdCek($database, $id_cek)
{
    $sql = "SELECT harga_apps FROM tradein_smartwatch WHERE id_cek='$id_cek'";
    $data  = $database->query($sql);
    $out = 0;
    // var_dump($sql);die();
    if ($data->num_rows > 0) {
        $row = $data->fetch_array();
        $out = $row["harga_apps"];
    }

    return $out;
}

function getBedaGradeByIdCek($database, $id_cek)
{
    $sql = "SELECT * FROM grade_beda WHERE id_cek='$id_cek'";
    $data  = $database->query($sql);
    $out = "";
    // var_dump($sql);die();
    if ($data->num_rows > 0) {
        $out = $data->fetch_array();
        // $out = $row["kode_tradein"];
    }

    return $out;
}

function getBedaGradeSmartwatchByIdCek($database, $id_cek)
{
    $sql = "SELECT * FROM grade_beda_smartwatch WHERE id_cek='$id_cek'";
    $data  = $database->query($sql);
    $out = "";
    // var_dump($sql);die();
    if ($data->num_rows > 0) {
        $out = $data->fetch_array();
        // $out = $row["kode_tradein"];
    }

    return $out;
}

function getHargaByKodeTradein($database, $kode_tradein)
{
    $sql = "SELECT harga_apps FROM tradein WHERE kode_tradein='$kode_tradein'";
    $data  = $database->query($sql);
    $out = "";
    if ($data->num_rows >= 0) {
        $row = $data->fetch_array();
        $out = $row["harga_apps"];
        // var_dump($out);die();
    }

    return $out;
}

function getSemuaByKodeTradein($database, $kode_tradein)
{
    $sql = "SELECT
    mg.imei,
    mg.created_at,
    mg.merk,
    mg.model,
    mg.storage,
    mg.tipe,
    mg.harga_apps,
    mg.grade,
    mg.approval,
    mg.nama_te
    FROM manual_grade mg
    WHERE mg.kode_tradein='$kode_tradein'";
    $data  = $database->query($sql);
    $out = "";
    if ($data->num_rows >= 0) {
        $row = $data->fetch_array();
        // var_dump($row);die();
        $out = $row["harga_apps"];
    }

    return $row;
}

function getIdMitraUtamaByIdMitra($database, $idMitra)
{
    $sql = "SELECT id_mitra_utama FROM mitra_utama WHERE id_mitra='$idMitra'";
    $data  = $database->query($sql);
    $out = 0;
    if ($data->num_rows > 0) {
        $row = $data->fetch_array();
        $out = $row["id_mitra_utama"];
    }

    return $out;
}

function removeJam($tanggal)
{
    $tgl_create = date("Y-m-d", strtotime($tanggal));
    if ($tanggal == NULL) {
        $tgl_create = '-';
        // var_dump($tgl_create);
    }

    // var_dump($tanggal);
    // die();
    return $tgl_create;
}

function getWaktu($interval)
{
    date_default_timezone_set('Asia/Jakarta'); # add your city to set local time zone
    $date = date('Y-m-d H:i:s', strtotime("+" . $interval . " day", time()));
    return $date;
}

function Test_getWaktu($test_date, $interval)
{
    // date_default_timezone_set('Asia/Jakarta'); # add your city to set local time zone
    $date = date('Y-m-d H:i:s', strtotime("+" . $interval . " day", $test_date));
    return $date;
}

function getAllMarket($database)
{
    $sql = "SELECT * FROM master_market";
    $data  = $database->query($sql);
    $out = array();
    if ($data->num_rows > 0) {
        $out = $data;
        // $row = $data->fetch_field();
        // $out = $row["username"];
    }

    return $out;
}

function getMarketNameById($database, $id_market)
{
    $sql = "SELECT nama FROM master_market WHERE id='$id_market'";
    $data  = $database->query($sql);
    $out = "Undefined!";
    if ($data->num_rows > 0) {
        $row = $data->fetch_array();
        $out = $row["nama"];
    }

    return $out;
}

function getKontrakByIdMarket($database, $id_market)
{
    $sql = "SELECT kontrak FROM master_market WHERE id='$id_market'";
    $data  = $database->query($sql);
    $out = 0;
    if ($data->num_rows > 0) {
        $row = $data->fetch_array();
        $out = $row["kontrak"];
    }

    return $out;
}

function getNamaBulan($no)
{
    switch ($no) {
        default:
            return 'Undefined';
            break;
        case 1:
            return 'Januari';
            break;
        case 2:
            return 'Februari';
            break;
        case 3:
            return 'Maret';
            break;
        case 4:
            return 'April';
            break;
        case 5:
            return 'Mei';
            break;
        case 6:
            return 'Juni';
            break;
        case 7:
            return 'Juli';
            break;
        case 8:
            return 'Agustus';
            break;
        case 9:
            return 'September';
            break;
        case 10:
            return 'Oktober';
            break;
        case 11:
            return 'November';
            break;
        case 12:
            return 'Desember';
            break;
    }
}

function getNamaBudgetMarketing($database, $id_budget_marketing, $separator)
{
    $sql = "SELECT id_mitra,bulan,tahun FROM budget_marketing WHERE id_budget_marketing='$id_budget_marketing'";
    $data  = $database->query($sql);
    $out = "Budget_Marketing";
    if ($data->num_rows > 0) {
        $row = $data->fetch_array();
        $out = getNamaMitra($database, $row['id_mitra']) . $separator . getNamaBulan($row["bulan"]) . $separator . $row["tahun"];
    }

    return $out;
}

function getIdBudgetMarketing($database, $id_mitra, $date)
{
    $tahun = getYearFromDate($date);
    $bulan = intval(getMonthFromDate($date));
    $id_mitra_utama = getIdMitraUtamaByIdMitra($database, $id_mitra);

    $sql = "SELECT * FROM budget_marketing 
        WHERE id_mitra='$id_mitra_utama' AND tahun='$tahun' AND bulan='$bulan'
    ";
    // die($sql);
    $data  = $database->query($sql);
    $out = array();
    if ($data->num_rows > 0) {
        $out = $data->fetch_assoc();
    }

    return $out;
}
function getIdBudgetMarketingDetail($database, $id_budget_marketing, $keterangan, $bulan, $tahun, $week)
{
    // var_dump($keterangan);die;
    $sql = "SELECT id FROM budget_marketing_detail BMD
        JOIN budget_marketing BM
        ON BMD.id_budget_marketing=BM.id_budget_marketing
        WHERE week='$week'  
        AND bulan='$bulan'
        AND tahun='$tahun'
        AND keterangan='$keterangan'
        AND BM.id_budget_marketing='$id_budget_marketing'
    ";
    // die($sql);
    $data  = $database->query($sql);
    $out = array();
    if ($data->num_rows > 0) {
        $out = $data->fetch_assoc();
    }

    return $out;
}

function getDataHPFromCekHP($database, $id_cek)
{
    $sql = "SELECT * FROM cek_hp WHERE id_cek='$id_cek'";
    $data  = $database->query($sql);
    $out = array();
    if ($data->num_rows > 0) {
        $out = $data->fetch_array();
        // var_dump($out);die();
    }

    return $out;
}
function getDataHPFromCekSmartwatch($database, $id_cek)
{
    $sql = "SELECT * FROM cek_smartwatch WHERE id_cek='$id_cek'";
    $data  = $database->query($sql);
    $out = array();
    if ($data->num_rows > 0) {
        $out = $data->fetch_array();
        // var_dump($out);die();
    }

    return $out;
}
function getDataHPFromTradein($database, $id_cek)
{
    $databasePortalweb = $GLOBALS['databasePortalweb'];
    $databasePlusphone = $GLOBALS['databasePlusphone'];

    $sql = "SELECT T.*,P.nama_pameran FROM $databasePortalweb.tradein T 
    JOIN $databasePlusphone.cek_hp C ON C.id_cek=T.id_cek 
    JOIN $databasePlusphone.pameran P ON P.id_pameran=C.id_pameran 
    WHERE T.id_cek='$id_cek'";
    $data  = $database->query($sql);
    $out = array();
    if ($data->num_rows > 0) {
        $out = $data->fetch_assoc();
        // var_dump($out);die();
    }

    return $out;
}
function getDataSmartwatchFromTradein($database, $id_cek)
{
    $databasePortalweb = $GLOBALS['databasePortalweb'];
    $databasePlusphone = $GLOBALS['databasePlusphone'];

    $sql = "SELECT T.*,P.nama_pameran FROM $databasePortalweb.tradein_smartwatch T 
    JOIN $databasePlusphone.cek_smartwatch C ON C.id_cek=T.id_cek 
    JOIN $databasePlusphone.pameran P ON P.id_pameran=C.id_pameran
    WHERE T.id_cek='$id_cek'";
    $data  = $database->query($sql);
    $out = array();
    if ($data->num_rows > 0) {
        $out = $data->fetch_assoc();
        // var_dump($out);die();
    }

    return $out;
}

function getDataHPFromLogistik($database, $id_cek)
{
    $databasePortalweb = $GLOBALS['databasePortalweb'];
    $databasePlusphone = $GLOBALS['databasePlusphone'];

    $sql = "SELECT  l.*,P.nama_pameran FROM $databasePortalweb.logistik l 
    JOIN $databasePlusphone.cek_hp C ON C.id_cek=l.id_cek 
    JOIN $databasePlusphone.pameran P ON P.id_pameran=C.id_pameran 
    WHERE l.id_cek='$id_cek'";

    $data  = $database->query($sql);
    // var_dump($sql);die();
    $out = array();
    if ($data->num_rows > 0) {
        $out = $data->fetch_assoc();
        // var_dump($out);die();
    }

    return $out;
}
function getDataSmartwatchFromLogistik($database, $id_cek)
{
    $databasePortalweb = $GLOBALS['databasePortalweb'];
    $databasePlusphone = $GLOBALS['databasePlusphone'];

    $sql = "SELECT  l.*,P.nama_pameran FROM $databasePortalweb.logistik_smartwatch l 
    JOIN $databasePlusphone.cek_smartwatch C ON C.id_cek=l.id_cek 
    JOIN $databasePlusphone.pameran P ON P.id_pameran=C.id_pameran
    WHERE l.id_cek='$id_cek'";

    $data  = $database->query($sql);
    // var_dump($sql);die();
    $out = array();
    if ($data->num_rows > 0) {
        $out = $data->fetch_assoc();
        // var_dump($out);die();
    }

    return $out;
}

function getDataHPFromJual($database, $id_cek)
{
    $databasePortalweb = $GLOBALS['databasePortalweb'];
    $databasePlusphone = $GLOBALS['databasePlusphone'];

    $sql = "SELECT  j.*,P.nama_pameran FROM $databasePortalweb.jual j 
    JOIN $databasePlusphone.cek_hp C ON C.id_cek=j.id_cek 
    JOIN $databasePlusphone.pameran P ON P.id_pameran=C.id_pameran 
    WHERE j.id_cek='$id_cek'";

    $data  = $database->query($sql);
    // var_dump($sql);die();
    $out = array();
    if ($data->num_rows > 0) {
        $out = $data->fetch_assoc();
        // var_dump($out);die();
    }

    return $out;
}

function getYearFromDate($date)
{
    return substr($date, 0, 4);
}

function getMonthFromDate($date)
{
    return substr($date, 5, 2);
}

function getDayFromDate($date)
{
    return substr($date, 8, 2);
}

function getWeekDefinitionByDate($date)
{
    $tanggal = intval(getDayFromDate($date));
    if ($tanggal > 21) {
        $out = 4;
    } else if ($tanggal > 14) {
        $out = 3;
    } else if ($tanggal > 7) {
        $out = 2;
    } else {
        $out = 1;
    }

    return $out;
}

function getBudgetMarketingDetailSpending($database, $id_budget_marketing, $subsidi = '')
{
    $sql = "SELECT total,editable,qty FROM budget_marketing_detail 
        WHERE id_budget_marketing='$id_budget_marketing' 
    ";
    if ($subsidi != '') {
        $sql .= "And keterangan ='$subsidi'";
    }
    $data  = $database->query($sql);
    $out = array(
        'subsidi' => 0,
        'kuota' => 0,
        'lainnya' => 0,
    );
    if ($data->num_rows > 0) {
        while ($row = $data->fetch_assoc()) {
            if ($row['editable'] == 0) {
                $out['subsidi'] += intval($row['total']);
                $out['kuota'] += $row['qty'];
            } else {
                $out['lainnya'] += intval($row['total']);
            }
        }
    }

    return $out;
}

function getAllMitra($database)
{
    $sql = "SELECT * FROM master_mitra_utama ORDER BY nama ASC";
    $data  = $database->query($sql);
    $out = array();
    if ($data->num_rows > 0) {
        $out = $data;
    }

    return $out;
}
function getAllPameran($database1)
{
    $databasePortalweb = $GLOBALS['databasePortalweb'];
    $databasePlusphone = $GLOBALS['databasePlusphone'];

    $sql = "SELECT * FROM $databasePlusphone.pameran P
    JOIN $databasePortalweb.mitra_utama M on M.id_mitra=P.id_mitra 
    GROUP BY nama_pameran order by nama_pameran ASC";
    $data  = $database1->query($sql);
    $out = array();
    if ($data->num_rows > 0) {
        $out = $data;
    }
    return $out;
}

function getNamaPameranFromAdmin($database, $id_pameran)
{
    $databasePortalweb = $GLOBALS['databasePortalweb'];
    $databasePlusphone = $GLOBALS['databasePlusphone'];

    $sql = "SELECT nama_pameran FROM $databasePlusphone.pameran WHERE id_pameran='$id_pameran'";
    $data  = $database->query($sql);
    $out = array();
    if ($data->num_rows > 0) {
        $row = $data->fetch_assoc();
        $out = $row['nama_pameran'];
    }

    echo $sql;
    return $out;
}

function getMitraForUser($database, $id_user_mitra)
{
    $sql = "SELECT id,nama FROM user_mitra_for U
    LEFT JOIN master_mitra_utama M ON M.id=U.id_mitra
    WHERE id_user_mitra='$id_user_mitra'";
    // echo $sql;die;
    $data  = $database->query($sql);
    $out = array(
        'id' => "",
        'nama' => "-",
    );
    if ($data->num_rows > 0) {
        $i = 0;
        $out['id'] = "";
        $out['nama'] = "";
        while ($row = $data->fetch_assoc()) {
            $i++;
            $out['id'] .= $row['id'];
            $out['nama'] .= $row['nama'];
            $out['id'] .= ",";
            if ($i != $data->num_rows) {
                $out['nama'] .= ",";
            }
        }
        // $out['id'] .= "]";
    }

    return $out;
}

function getSubsidi($database)
{
    $sql = "SELECT * FROM budget_marketing_detail WHERE editable='0' GROUP BY keterangan ASC";
    $data  = $database->query($sql);
    $out = array();

    // var_dump($sql);die;
    if ($data->num_rows > 0) {
        $out = $data;
    }

    return $out;
}


function getSisaTahunanBudgetMarketing_old($database, $id_mitra, $tahun)
{
    $sql = "SELECT SUM(balance) AS sisa_tahunan FROM budget_marketing 
    WHERE id_mitra='$id_mitra' AND tahun='$tahun'";
    $data  = $database->query($sql);
    $out = 0;
    if ($data->num_rows > 0) {
        while ($row = $data->fetch_assoc()) {
            $out = $row['sisa_tahunan'];
        }
    }

    return $out;
}

function getSisaTahunanBudgetMarketing($database, $id_mitra, $tahun, $bulan)
{
    $sql = "SELECT SUM(balance) AS sisa_tahunan FROM budget_marketing 
    WHERE id_mitra='$id_mitra' AND tahun='$tahun'
    AND bulan <= '$bulan'
    ";
    $data  = $database->query($sql);
    $out = 0;
    if ($data->num_rows > 0) {
        while ($row = $data->fetch_assoc()) {
            $out = $row['sisa_tahunan'];
        }
    }

    return $out;
}

function getPendapatanBulanSebelumnya($database, $id_mitra, $tahun, $bulan)
{
    $sql = "SELECT income_real FROM budget_marketing 
    WHERE id_mitra='$id_mitra' AND tahun='$tahun' AND bulan='$bulan'";
    $data  = $database->query($sql);
    $out = 0;
    if ($data->num_rows > 0) {
        while ($row = $data->fetch_assoc()) {
            $out = $row['income_real'];
        }
    }

    return $out;
}

function dropdownMenuSmartphone($database, $idMU, $id_user, $page)
{

    $role = getUserRole($database, $id_user);
    $nama_Mitra = getNamaMitraUtama($database, $idMU);
    $select = '
    <div class="dropdown">
      <div class="dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="nama_menu">
            ' . $page . '( ' . $nama_Mitra . ' )
        </span>
      </div>
      <div class="dropdown-menu menu_bawah mt-0" aria-labelledby="dropdownMenuButton">';
    if ($role['tradein'] == 1) $select .= '<a class="dropdown-item" href="?id_mu=' . $idMU . '&page=tradein">Data Trade In ( ' . $nama_Mitra . ' )</a>';
    if ($role['logistik'] == 1) $select .= '<a class="dropdown-item" href="?id_mu=' . $idMU . '&page=logistik">Data Logistik ( ' . $nama_Mitra . ' )</a>';
    if ($role['jual'] == 1) $select .= '<a class="dropdown-item" href="?id_mu=' . $idMU . '&page=jual">Data Jual ( ' . $nama_Mitra . ' )</a>';
    if ($role['finance'] == 1) $select .= '<a class="dropdown-item" href="?id_mu=' . $idMU . '&page=finance">Data Finance ( ' . $nama_Mitra . ' )</a>';
    if ($role['foto_pickup'] == 1) $select .= '<a class="dropdown-item" href="?id_mu=' . $idMU . '&page=foto-pickup">Data Track Logistik ( ' . $nama_Mitra . ' )</a>';
    if ($role['beda_grade'] == 1) $select .= '<a class="dropdown-item" href="?id_mu=' . $idMU . '&page=beda-grade">Data Beda Grade ( ' . $nama_Mitra . ' )</a>';
    if ($role['manual_grade'] == 1) $select .= '<a class="dropdown-item" href="?id_mu=' . $idMU . '&page=manual-grade">Data Manual Grade ( ' . $nama_Mitra . ' )</a>';
    if ($role['statistik'] == 1) $select .= '<a class="dropdown-item" href="?id_mu=' . $idMU . '&page=statistik">Data Statistik ( ' . $nama_Mitra . ' )</a>';

    $select .= '
      </div>
    </div>';


    return $select;
}

function dropdownMenuSmartwatch($database, $idMU, $id_user, $page)
{

    $role = getUserRole($database, $id_user);
    $nama_Mitra = getNamaMitraUtama($database, $idMU);
    $select = '
    <div class="dropdown">
      <div class="dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="nama_menu">
        ' . $page . '( ' . $nama_Mitra . ' )
        </span>
      </div>
      <div class="dropdown-menu menu_bawah mt-0" aria-labelledby="dropdownMenuButton">';
    if ($role['tradein_smartwatch'] == 1) $select .= '<a class="dropdown-item" href="?id_mu=' . $idMU . '&page=tradein-smartwatch">Data Trade In Smartwatch ( ' . $nama_Mitra . ' )</a>';
    if ($role['logistik_smartwatch'] == 1) $select .= '<a class="dropdown-item" href="?id_mu=' . $idMU . '&page=logistik-smartwatch">Data Logistik Smartwatch ( ' . $nama_Mitra . ' )</a>';
    if ($role['jual_smartwatch'] == 1) $select .= '<a class="dropdown-item" href="?id_mu=' . $idMU . '&page=jual-smartwatch">Data Jual Smartwatch ( ' . $nama_Mitra . ' )</a>';
    if ($role['finance_smartwatch'] == 1) $select .= '<a class="dropdown-item" href="?id_mu=' . $idMU . '&page=finance-smartwatch">Data Finance Smartwatch ( ' . $nama_Mitra . ' )</a>';
    if ($role['foto_pickup_smartwatch'] == 1) $select .= '<a class="dropdown-item" href="?id_mu=' . $idMU . '&page=foto-pickup-smartwatch">Data Track Logistik Smartwatch ( ' . $nama_Mitra . ' )</a>';
    if ($role['beda_grade_smartwatch'] == 1) $select .= '<a class="dropdown-item" href="?id_mu=' . $idMU . '&page=beda-grade-smartwatch">Data Beda Grade Smartwatch ( ' . $nama_Mitra . ' )</a>';
    if ($role['statistik_smartwatch'] == 1) $select .= '<a class="dropdown-item" href="?id_mu=' . $idMU . '&page=statistik-smartwatch">Data Statistik Smartwatch ( ' . $nama_Mitra . ' )</a>';

    $select .= '
      </div>
    </div>';
    return $select;
}
function getNamaMitraMarket($database, $inputIDMarket)
{
    // $idMitra = id mitra utama
    $sql = "SELECT nama FROM master_market WHERE id='$inputIDMarket'";
    // var_dump($sql);die;
    $data  = $database->query($sql);
    $out = "Undefined!";
    if ($data->num_rows > 0) {
        $row = $data->fetch_array();
        $out = $row["nama"];
    }

    return $out;
}
function getNamaPameran($database, $id_pameran)
{
    $sql = "SELECT nama_pameran FROM pameran WHERE id_pameran='$id_pameran'";
    $data  = $database->query($sql);
    $out = "Undefined!";
    if ($data->num_rows > 0) {
        $row = $data->fetch_array();
        $out = $row["nama_pameran"];
    }

    return $out;
}
function getBulanPameran($database, $id_pameran)
{
    $sql = "SELECT bulan FROM pameran WHERE id_pameran='$id_pameran'";
    $data  = $database->query($sql);
    $out = "Undefined!";
    if ($data->num_rows > 0) {
        $row = $data->fetch_array();
        $out = getNamaBulan($row["bulan"]);
    }

    return $out;
}
function getNamaMarket($database, $id_pameran)
{
    $sql = "SELECT mm.nama FROM pameran p join master_market mm on p.id_market=mm.id WHERE id_pameran='$id_pameran'";
    $data  = $database->query($sql);
    $out = "Undefined!";
    if ($data->num_rows > 0) {
        $row = $data->fetch_array();
        $out = $row["nama"];
    }

    return $out;
}
function getNamaMarket2($database, $idMarket)
{
    $sql = "SELECT nama FROM master_market WHERE id='$idMarket'";
    $data  = $database->query($sql);
    $out = "Undefined!";
    if ($data->num_rows > 0) {
        $row = $data->fetch_array();
        $out = $row["nama"];
    }

    return $out;
}
function getTipePameranInDB($database, $idPameran)
{
    $sql = "SELECT tipe_pameran FROM pameran WHERE id_pameran='$idPameran'";
    $data  = $database->query($sql);
    $out = "Undefined!";
    if ($data->num_rows > 0) {
        $row = $data->fetch_array();
        $out = $row["tipe_pameran"];
    }

    return $out;
}

function dropdownMenuAllSmartphone($database, $id_user, $page)
{

    $role = getUserRole($database, $id_user);
    $nama_Mitra = "All Mitra";
    $select = '
    <div class="dropdown">
      <div class="dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="nama_menu">
            ' . $page . '( ' . $nama_Mitra . ' )
        </span>
      </div>
      <div class="dropdown-menu menu_bawah mt-0" aria-labelledby="dropdownMenuButton">';
    if ($role['tradein'] == 1) $select .= '<a class="dropdown-item" href="?page=tradein-all">Data Trade In ( ' . $nama_Mitra . ' )</a>';
    if ($role['logistik'] == 1) $select .= '<a class="dropdown-item" href="?page=logistik-all">Data Logistik ( ' . $nama_Mitra . ' )</a>';
    if ($role['jual'] == 1) $select .= '<a class="dropdown-item" href="?page=jual-all">Data Jual ( ' . $nama_Mitra . ' )</a>';
    if ($role['finance'] == 1) $select .= '<a class="dropdown-item" href="?page=finance-all">Data Finance ( ' . $nama_Mitra . ' )</a>';
    if ($role['foto_pickup'] == 1) $select .= '<a class="dropdown-item" href="?page=foto-pickup-all">Data Track Logistik ( ' . $nama_Mitra . ' )</a>';
    if ($role['beda_grade'] == 1) $select .= '<a class="dropdown-item" href="?page=beda-grade-all">Data Beda Grade ( ' . $nama_Mitra . ' )</a>';
    if ($role['manual_grade'] == 1) $select .= '<a class="dropdown-item" href="?page=manual-grade-all">Data Manual Grade ( ' . $nama_Mitra . ' )</a>';


    $select .= '
      </div>
    </div>';


    return $select;
}

function getIdCekSmartwatchByImei($database, $imei)
{
    $sql = "SELECT id_cek FROM tradein_smartwatch WHERE imei='$imei'";
    $data  = $database->query($sql);
    $out = "";
    // var_dump($sql);die();
    // var_dump($data);die();
    if ($data->num_rows > 0) {
        $row = $data->fetch_array();
        $out = $row["id_cek"];
    }

    return $out;
}

function getKodeTradeinSmartwatchByIdCek($database, $id_cek)
{
    $sql = "SELECT kode_tradein FROM tradein_smartwatch WHERE id_cek='$id_cek'";
    $data  = $database->query($sql);
    $out = "";
    // var_dump($data);die();
    if ($data->num_rows > 0) {
        $row = $data->fetch_array();
        $out = $row["kode_tradein"];
    }

    return $out;
}

function random_word($id)
{
    $pool = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

    $word = '';
    for ($i = 0; $i < $id; $i++) {
        $word .= substr($pool, mt_rand(0, strlen($pool) - 1), 1);
    }
    return $word;
}

function getLastIdTransaksi($database)
{
    $sql = "SELECT MAX(id_transaksi) AS last_id FROM transaksi";
    $out = $database->query($sql)->fetch_array();
    return $out['last_id'];
}

function isKodeTransaksiExist($database, $kode_transaksi)
{
    $sql = "SELECT id_transaksi FROM transaksi WHERE kode_transaksi='$kode_transaksi'";
    $data = $database->query($sql);
    return $data->num_rows;
    // return $sql;
}

function generateKodeTransaksi($database)
{
    $last_id = getLastIdTransaksi($database) + 1;
    if ($last_id < 10000) $newID .= '0';
    if ($last_id < 1000) $newID .= '0';
    if ($last_id < 100) $newID .= '0';
    if ($last_id < 10) $newID .= '0';
    $newID .= $last_id;

    return 'T' . date('ym') . random_word(2) . $newID;
}

function mulaiTransaksi($database, $id_market)
{
    $kode_transaksi = generateKodeTransaksi($database);
    // $kode_transaksi = "T2003DE00007";
    // $kode_transaksi = "TYYMMXXNNNNN";
    // T = Transaksi
    // YY = year, 19 (untuk 2019)
    // MM = month, 03 (untuk Maret)
    // XX = random alphabet
    // NN = incremental number

    // selama kode_transaksi ada dan masih dalam batas generate_counting (max 50),
    // akan generate kode_transaksi terus
    $generate_counting = 0;
    while (isKodeTransaksiExist($database, $kode_transaksi) != 0 && $generate_counting < 50) {
        $generate_counting++;
        // $kode_transaksi = "T2003DE00007";
        $kode_transaksi = generateKodeTransaksi($database);
    }
    $out = array(
        'error' => true,
    );
    if ($generate_counting < 50) {
        $sql = "INSERT INTO transaksi 
            (id_transaksi, kode_transaksi, id_market, created_at, updated_at) VALUES 
            (NULL, '$kode_transaksi', '$id_market', NOW(), NOW())";
        if ($database->query($sql)) {
            $out['msg'] = $kode_transaksi;
            $out['error'] = false;
        } else {
            $out['msg'] = $database->error;
        }
    } else {
        $out['msg'] = "#RTO";
    }
    return $out;
}

function batalTransaksi($database, $kode_transaksi)
{
    $transaksi = isKodeTransaksiExist($database, $kode_transaksi);
    // var_dump($transaksi);die;
    if ($transaksi == 0) {
        return false;
    } else {
        return hapusTransaksiByKodeTransaksi($database, $kode_transaksi);
    }
}

function getIdTransaksiByKodeTransaksi($database, $kode_transaksi)
{
    $sql = "SELECT id_transaksi FROM transaksi WHERE kode_transaksi='$kode_transaksi'";
    $data = $database->query($sql);
    $out = 0;
    if ($data->num_rows > 0) {
        $row = $data->fetch_array();
        $out = $row['id_transaksi'];
    }
    return $out;
}

function hapusTransaksiByKodeTransaksi($database, $kode_transaksi)
{
    $out = array(
        'error' => true,
    );
    $id_transaksi = getIdTransaksiByKodeTransaksi($database, $kode_transaksi);
    if ($id_transaksi != 0) {
        $sql1 = "UPDATE transaksi SET status='99' WHERE kode_transaksi='$kode_transaksi';";
        $database->query($sql1);
        $sql2 = "UPDATE jual SET status='IN STOCK' 
        WHERE id_cek IN 
        (SELECT id_cek FROM transaksi_detail WHERE id_transaksi='$id_transaksi')
        ";
        $sql3 = "DELETE FROM transaksi_detail WHERE id_transaksi='$id_transaksi'";

        /* disable autocommit */
        $database->autocommit(FALSE);
        $database->begin_transaction(MYSQLI_TRANS_START_READ_WRITE);
        if ($database->query($sql1)) {
            if ($database->query($sql2)) {
                if ($database->query($sql3)) {
                    $database->commit();
                    $out['error'] = false;
                } else {
                    $out['msg'] = "#1-" . $database->error;
                    $database->rollback();
                }
            } else {
                $out['msg'] = "#2-" . $database->error;
                $database->rollback();
            }
        }
        $database->autocommit(TRUE);
    }

    return $out;
}

function tambahTransaksiDetail($database, $kode_transaksi, $id_cek, $harga_jual)
{
    $id_transaksi = getIdTransaksiByKodeTransaksi($database, $kode_transaksi);
    $sql1 = "INSERT INTO transaksi_detail 
        (id_detail, id_transaksi, id_cek, harga_awal, harga_akhir, created_at, updated_at) VALUES 
        (NULL, '$id_transaksi', '$id_cek', '$harga_jual', '$harga_jual', NOW(), NOW())
    ";

    $sql2 = "UPDATE jual SET status='ON HOLD' 
    WHERE id_cek='$id_cek'";

    $out = array(
        'error' => true,
    );

    /* disable autocommit */
    $database->autocommit(FALSE);
    $database->begin_transaction(MYSQLI_TRANS_START_READ_WRITE);
    if ($database->query($sql1)) {
        if ($database->query($sql2)) {
            $out['error'] = false;
            $database->commit();
        } else {
            $out['msg'] = $database->error;
            $database->rollback();
        }
    } else {
        $out['msg'] = $database->error;
    }
    $database->autocommit(TRUE);
    return $out;
}

function hapusTransaksiDetail($database, $kode_transaksi, $id_cek)
{
    $id_transaksi = getIdTransaksiByKodeTransaksi($database, $kode_transaksi);
    $sql1 = "DELETE FROM transaksi_detail WHERE id_transaksi='$id_transaksi' 
    AND id_cek='$id_cek'";

    $sql2 = "UPDATE jual SET status='IN STOCK' 
    WHERE id_cek='$id_cek'";

    $out = array(
        'error' => true,
    );

    /* disable autocommit */
    $database->autocommit(FALSE);
    $database->begin_transaction(MYSQLI_TRANS_START_READ_WRITE);
    if ($database->query($sql1)) {
        if ($database->query($sql2)) {
            $out['error'] = false;
            $database->commit();
        } else {
            $out['msg'] = "#1-" . $database->error;
            $database->rollback();
        }
    } else {
        $out['msg'] = "#2-" . $database->error;
    }
    $database->autocommit(TRUE);
    return $out;
}

<?php
/**
 * Informasi untuk koneksi database
 */
date_default_timezone_set('Asia/Jakarta'); //timezone yan dipakai
$dbhost = 'localhost';
$dbuser = "root";
$dbpass ="";
$dbname = "plusphone";

// koneksi ke database
$database = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
if ($database->connect_error) {
    die('Oops!! database Not Connect : ' . $database->connect_error);
}

// include('function.php'); // berisi fungsi-fungsi input/output formatting

?>
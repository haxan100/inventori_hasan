<?php
/**
 * Informasi untuk koneksi database
 */
  $dbhost1 = 'localhost';
  $dbuser1 = 'root';
  $dbpass1 = '';
  $dbname1 = 'db_inventor';
  
  // koneksi ke database
  $database1 = new mysqli($dbhost1, $dbuser1, $dbpass1, $dbname1);
  if ($database1->connect_error) {
     die('Oops!! database1 Not Connect : ' . $database1->connect_error);
  }

?>
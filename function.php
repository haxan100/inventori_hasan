<?php
function tgl_indo($tgl) {
	$tanggal	= substr($tgl, 8, 2);
	$bulan		= substr($tgl, 5, 2);
	$tahun 		= substr($tgl, 0, 4);
	return $tanggal."-".$bulan."-".$tahun;
}
<?php
function tanggal_indonesia($tanggal){
	$bulan = array (
		1 =>   'Januari',
		'Februari',
		'Maret',
		'April',
		'Mei',
		'Juni',
		'Juli',
		'Agustus',
		'September',
		'Oktober',
		'November',
		'Desember'
	);
	$pecahkan = explode('-', $tanggal);
	return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}

function tanggal_arsip($tanggal){
	$bulan = array (
		1 =>   'Januari',
		'Februari',
		'Maret',
		'April',
		'Mei',
		'Juni',
		'Juli',
		'Agustus',
		'September',
		'Oktober',
		'November',
		'Desember'
	);
	$pecahkan = explode('-', $tanggal);
	return $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}

function nama_bulan_to_angka($tanggal){
	$bulan = explode(" ", $tanggal);
	$arsip = null;
	if($bulan[0] == "Januari") {
		$arsip[0] = 1;
	} else if($bulan[0] == "Februari") {
		$arsip[0] = 2;
	} else if($bulan[0] == "Maret") {
		$arsip[0] = 3;
	} else if($bulan[0] == "April") {
		$arsip[0] = 4;
	} else if($bulan[0] == "Mei") {
		$arsip[0] = 5;
	} else if($bulan[0] == "Juni") {
		$arsip[0] = 6;
	} else if($bulan[0] == "Juli") {
		$arsip[0] = 7;
	} else if($bulan[0] == "Agustus") {
		$arsip[0] = 8;
	} else if($bulan[0] == "September") {
		$arsip[0] = 9;
	} else if($bulan[0] == "Oktober") {
		$arsip[0] = 10;
	} else if($bulan[0] == "November") {
		$arsip[0] = 11;
	} else if($bulan[0] == "Desember") {
		$arsip[0] = 12;
	}
	$arsip[1] = $bulan[1];
	return $arsip;
}

function pecah_kalimat($isi) {
    $isi_array = explode(".", $isi);
    return $isi_array[0];
}

function getDataUser($koneksi, $sql)
{
	$query = mysqli_query($koneksi, $sql);
	$data_user = null;
	while ($data = mysqli_fetch_assoc($query)) {
		$data_user[] = $data;
	}
	return $data_user;
}
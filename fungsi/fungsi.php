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

function pecah_kalimat($isi) {
    $isi_array = explode(".", $isi);
    return $isi_array[0];
}

function getDataUser($koneksi, $sql)
{
	$query = mysqli_query($koneksi, $sql);
	while ($data = mysqli_fetch_assoc($query)) {
		$data_user[] = $data;
	}
	return $data_user;
}
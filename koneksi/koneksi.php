<?php
$koneksi = mysqli_connect("localhost","dikky","1","katalog_buku");
// cek koneksi
if (!$koneksi){
 die("Error koneksi: " . mysqli_connect_errno());
}
?>

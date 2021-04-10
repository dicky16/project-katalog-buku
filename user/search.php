<?php
header('Content-Type: application/json');
include("../fungsi/fungsi.php");
include("../koneksi/koneksi.php");
if(isset($_POST['data'])) {
    $key = $_POST['data'];
    $sql = "select buku.*, kategori_buku.*, penerbit.*
    from buku 
    INNER JOIN kategori_buku ON buku.id_kategori_buku = kategori_buku.id_kategori_buku
    INNER JOIN penerbit ON buku.id_penerbit = penerbit.id_penerbit
    WHERE buku.judul LIKE '%$key%'";
    $data = getDataUser($koneksi, $sql);
    $response = [
        "status" => "success",
        "data" => $data
    ];
    echo json_encode($data);
}
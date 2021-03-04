<?php
include('../koneksi/koneksi.php');
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    if(is_numeric($id)) {
        $sql = "DELETE from  `kategori_buku` where `id_kategori_buku`='$id'";
        mysqli_query($koneksi,$sql);
        header("Location:kategoribuku.php");
    }
}
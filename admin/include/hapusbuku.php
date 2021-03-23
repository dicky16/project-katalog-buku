<?php
include('../koneksi/koneksi.php');
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if (is_numeric($id)) {
        $sql_d = "select `cover` from `buku` where `id_buku`='$id'";
        $query_d = mysqli_query($koneksi, $sql_d);
        while ($cover = mysqli_fetch_row($query_d)) {
            $coverhapus = $cover[0];
        }
        unlink("cover/$coverhapus");
        $sql = "DELETE from  `buku` where `id_buku`='$id'";
        mysqli_query($koneksi, $sql);
        header("Location:buku.php");
    }
}

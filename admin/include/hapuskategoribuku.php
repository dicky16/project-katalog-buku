<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE from  `kategori_buku` where `id_kategori_buku`='$id'";
    mysqli_query($koneksi, $sql);
    header("Location:kategori-buku");
}

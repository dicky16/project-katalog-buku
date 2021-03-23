<?php
if (isset($_POST['tambahblog'])) {
    $id_kategoriblog = $_POST['kategori_blog'];
    $id_user = $_SESSION['id_user'];
    $judul = $_POST['judul'];
    $tanggal = date("Y-m-d");
    $isi = $_POST['isi'];
     
    if (empty($id_kategoriblog)) {
        header("Location:tambahblog.php?notif=tambahkosong&jenis=kategoriblog");
    } elseif (empty($judul)) {
        header("Location:tambahblog.php?notif=tambahkosong&jenis=judul");
    } elseif (empty($isi)) {
        header("Location:tambahblog.php?notif=tambahkosong&jenis=isi");
    } else {
        $sql_i = "INSERT INTO `blog` (`id_kategori_blog`, `id_user`, `tanggal`, `judul`, `isi`) 
        VALUES ('$id_kategoriblog', '$id_user', '$tanggal', '$judul', '$isi')";
        mysqli_query($koneksi, $sql_i);
        header("Location:blog.php?notif=tambahberhasil");
    }
}

<?php
if (isset($_POST['tambahblog'])) {
    $id_kategoriblog = $_POST['id-kategori-blog'];
    $id_user = $_SESSION['id_user'];
    $judul = $_POST['judul'];
    $tanggal = date("Y-m-d");
    $isi = $_POST['isi'];
     
    if (empty($id_kategoriblog)) {
        $_SESSION['notif'] = "tambahkosong";
        $_SESSION['jenis'] = "kategori blog";
        header("Location:tambah-blog");
    } elseif (empty($judul)) {
        $_SESSION['notif'] = "tambahkosong";
        $_SESSION['jenis'] = "judul";
        header("Location:tambah-blog");
    } elseif (empty($isi)) {
        $_SESSION['notif'] = "tambahkosong";
        $_SESSION['jenis'] = "isi";
        header("Location:tambah-blog");
    } else {
        $sql_i = "INSERT INTO `blog` (`id_kategori_blog`, `id_user`, `tanggal`, `judul`, `isi`) 
        VALUES ('$id_kategoriblog', '$id_user', '$tanggal', '$judul', '$isi')";
        mysqli_query($koneksi, $sql_i);
        $_SESSION['notif'] = "tambahberhasil";
        header("Location:blog");
    }
}

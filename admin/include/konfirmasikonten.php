<?php
date_default_timezone_set("Asia/Jakarta");
if(isset($_POST['updatekonten'])) {
    $judul = $_POST['judul'];
    $isi = $_POST['isi'];
    $tanggal = date("Y-m-d");
    if(empty($judul)) {
        $_SESSION['notif'] = "editkosong";
        $_SESSION['jenis'] = "judul";
        header("Location:edit-konten-id-".$_GET['id']);
     } else if(empty($isi)) {
        $_SESSION['notif'] = "editkosong";
        $_SESSION['jenis'] = "isi";
        header("Location:edit-konten-id-".$_GET['id']);
     } else {
        $id = $_GET['id'];
        $_SESSION['notif'] = "editberhasil";
        $sql = "update `konten` set `judul`='$judul', `isi`='$isi', `tanggal`='$tanggal' where `id_konten`='$id'";
        mysqli_query($koneksi,$sql);
        header("Location:konten");
    
    }
}
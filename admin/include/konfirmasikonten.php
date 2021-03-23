<?php
date_default_timezone_set("Asia/Jakarta");
include("../koneksi/koneksi.php");
if(isset($_POST['updatekonten'])) {
    $judul = $_POST['judul'];
    $isi = $_POST['isi'];
    $tanggal = date("Y-m-d");
    if(empty($judul)) {
        header("Location:editkonten.php?id=".$_GET['id']."&notif=editkosong&jenis=judul");
     } else if(empty($isi)) {
        header("Location:editkonten.php?id=".$_GET['id']."&notif=editkosong&jenis=isi");
     } else {
        $id = $_GET['id'];
        $sql = "update `konten` set `judul`='$judul', `isi`='$isi', `tanggal`='$tanggal' where `id_konten`='$id'";
        mysqli_query($koneksi,$sql);
        header("Location:konten.php?notif=editberhasil");
    
    }
}
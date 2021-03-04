<?php
 //akses file koneksi database
 include('../koneksi/koneksi.php');
 if (isset($_POST['tambahkategori'])) {
     $kategori = $_POST['tambahkategoribuku'];
     if(empty($kategori)) {
        header("Location:tambahkategoribuku.php?notif=tambahkosong");
     } else {
        $sql = "INSERT INTO `kategori_buku` (`kategori_buku`) VALUES ('$kategori');";
        mysqli_query($koneksi,$sql);
        header("Location:kategoribuku.php?notif=tambahberhasil");
     }
 }  else if(isset($_POST['updatekategoribuku'])) {
   $kategori = $_POST['kategoribuku'];
   if(empty($kategori)) {
      header("Location:editkategoribuku.php?id=".$_GET['id']."=&notif=editkosong");
   } else {
      if(isset($_GET['id'])) {
         $id = $_GET['id'];
         $sql = "update `kategori_buku` set `kategori_buku`='$kategori' where `id_kategori_buku`='$id'";
         mysqli_query($koneksi,$sql);
         header("Location:kategoribuku.php?notif=editberhasil");
      }
   }
 }
<?php
 //akses file koneksi database
 include('../koneksi/koneksi.php');
 if (isset($_POST['tambahkategoribuku'])) {
     $kategori = $_POST['kategoribuku'];
     if(empty($kategori)) {
        header("Location:?include=tambah-kategori-buku&notif=tambahkosong");
     } else {
        $sql = "INSERT INTO `kategori_buku` (`kategori_buku`) VALUES ('$kategori');";
        mysqli_query($koneksi,$sql);
        header("Location:?include=kategori-buku&notif=tambahberhasil");
     }
 }  else if(isset($_POST['updatekategoribuku'])) {
   $kategori = $_POST['kategoribuku'];
   if(empty($kategori)) {
      header("Location:?include=edit-kategori-buku&id=".$_GET['id']."&notif=editkosong");
   } else {
      if(isset($_GET['id'])) {
         $id = $_GET['id'];
         $sql = "update `kategori_buku` set `kategori_buku`='$kategori' where `id_kategori_buku`='$id'";
         mysqli_query($koneksi,$sql);
         header("Location:?include=kategori-buku&notif=editberhasil");
      }
   }
 }
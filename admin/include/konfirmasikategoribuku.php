<?php
 //akses file koneksi database
 if (isset($_POST['tambahkategoribuku'])) {
     $kategori = $_POST['kategoribuku'];
     if(empty($kategori)) {
      $_SESSION['notif'] = "tambahkosong";
        header("Location:tambah-kategori-buku");
     } else {
        $sql = "INSERT INTO `kategori_buku` (`kategori_buku`) VALUES ('$kategori');";
        mysqli_query($koneksi,$sql);
        $_SESSION['notif'] = "tambahberhasil";
        header("Location:kategori-buku");
     }
 }  else if(isset($_POST['updatekategoribuku'])) {
   $kategori = $_POST['kategoribuku'];
   if(empty($kategori)) {
      $_SESSION['notif'] = "editkosong";
      header("Location:edit-kategori-buku-id-".$_GET['id']);
   } else {
      if(isset($_GET['id'])) {
         $id = $_GET['id'];
         $sql = "update `kategori_buku` set `kategori_buku`='$kategori' where `id_kategori_buku`='$id'";
         mysqli_query($koneksi,$sql);
         $_SESSION['notif'] = "editberhasil";
         header("Location:kategori-buku");
      }
   }
 }
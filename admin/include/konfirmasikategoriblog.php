<?php
 //akses file koneksi database
 if (isset($_POST['tambahkategoriblog'])) {
     $kategori = $_POST['kategoriblog'];
     if(empty($kategori)) {
        header("Location:tambahkategoriblog.php?notif=tambahkosong");
     } else {
        $sql = "INSERT INTO `kategori_blog` (`kategori_blog`) VALUES ('$kategori');";
        mysqli_query($koneksi,$sql);
        header("Location:kategoriblog.php?notif=tambahberhasil");
     }
 }  else if(isset($_POST['updatekategoriblog'])) {
   $kategori = $_POST['kategoriblog'];
   if(empty($kategori)) {
      header("Location:editkategoriblog.php?id=".$_GET['id']."&notif=editkosong");
   } else {
      if(isset($_GET['id'])) {
         $id = $_GET['id'];
         $sql = "update `kategori_blog` set `kategori_blog`='$kategori' where `id_kategori_blog`='$id'";
         mysqli_query($koneksi,$sql);
         header("Location:kategoriblog.php?notif=editberhasil");
      }
   }
 }
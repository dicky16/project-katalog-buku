<?php
 //akses file koneksi database
 if (isset($_POST['tambahkategoriblog'])) {
     $kategori = $_POST['kategoriblog'];
     if(empty($kategori)) {
        $_SESSION['notif'] = 'tambahkosong';
        header("Location:tambah-kategori-blog.php");
     } else {
        $sql = "INSERT INTO `kategori_blog` (`kategori_blog`) VALUES ('$kategori');";
        mysqli_query($koneksi,$sql);
        $_SESSION['notif'] = 'tambahberhasil';
        header("Location:kategori-blog");
     }
 }  else if(isset($_POST['updatekategoriblog'])) {
   $kategori = $_POST['kategoriblog'];
   if(empty($kategori)) {
      $_SESSION['notif'] = 'editkosong';
      header("Location:edit-kategori-blog-id-".$_GET['id']);
   } else {
      if(isset($_GET['id'])) {
         $id = $_GET['id'];
         $sql = "update `kategori_blog` set `kategori_blog`='$kategori' where `id_kategori_blog`='$id'";
         mysqli_query($koneksi,$sql);
         $_SESSION['notif'] = 'editberhasil';
         header("Location:kategori-blog");
      }
   }
 }
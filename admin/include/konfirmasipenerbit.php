<?php
 //akses file koneksi database
 if (isset($_POST['tambahpenerbit'])) {
     $penerbit = $_POST['penerbit'];
     $alamat = $_POST['alamat'];
     if(empty($penerbit)) {
        $_SESSION['notif'] = 'tambahkosong';
        $_SESSION['jenis'] = 'penerbit';
        header("Location:tambah-penerbit");
     } else if(empty($alamat)) {
      $_SESSION['notif'] = 'tambahkosong';
      $_SESSION['jenis'] = 'alamat';
        header("Location:tambah-penerbit");
     } else {
        $sql = "INSERT INTO `penerbit` (`penerbit`, `alamat`) VALUES ('$penerbit', '$alamat');";
        mysqli_query($koneksi,$sql);
        $_SESSION['notif'] = 'tambahberhasil';
        header("Location:penerbit");
     }
 }  else if(isset($_POST['updatepenerbit'])) {
    $penerbit = $_POST['penerbit'];
    $alamat = $_POST['alamat'];
    if(empty($penerbit)) {
      $_SESSION['notif'] = 'editkosong';
      $_SESSION['jenis'] = 'penerbit';
        header("Location:edit-penerbit-id-".$_GET['id']);
     } else if(empty($alamat)) {
      $_SESSION['notif'] = 'editkosong';
      $_SESSION['jenis'] = 'alamat';
        header("Location:edit-penerbit-id-".$_GET['id']);
     } else {
      if(isset($_GET['id'])) {
         $id = $_GET['id'];
         $sql = "update `penerbit` set `penerbit`='$penerbit', `alamat`='$alamat' where `id_penerbit`='$id'";
         mysqli_query($koneksi,$sql);
         $_SESSION['notif'] = 'editberhasil';
         header("Location:penerbit");
      }
   }
 }
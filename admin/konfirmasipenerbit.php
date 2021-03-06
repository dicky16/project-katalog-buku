<?php
 //akses file koneksi database
 include('../koneksi/koneksi.php');
 if (isset($_POST['tambahpenerbit'])) {
     $penerbit = $_POST['penerbit'];
     $alamat = $_POST['alamat'];
     if(empty($penerbit)) {
        header("Location:tambahpenerbit.php?notif=tambahkosong&jenis=penerbit");
     } else if(empty($alamat)) {
        header("Location:tambahpenerbit.php?notif=tambahkosong&jenis=alamat");
     } else {
        $sql = "INSERT INTO `penerbit` (`penerbit`, `alamat`) VALUES ('$penerbit', '$alamat');";
        mysqli_query($koneksi,$sql);
        header("Location:penerbit.php?notif=tambahberhasil");
     }
 }  else if(isset($_POST['updatepenerbit'])) {
    $penerbit = $_POST['penerbit'];
    $alamat = $_POST['alamat'];
    if(empty($penerbit)) {
        header("Location:editpenerbit.php?id=".$_GET['id']."&notif=editkosong&jenis=penerbit");
     } else if(empty($alamat)) {
        header("Location:editpenerbit.php?id=".$_GET['id']."&notif=editkosong&jenis=alamat");
     } else {
      if(isset($_GET['id'])) {
         $id = $_GET['id'];
         $sql = "update `penerbit` set `penerbit`='$penerbit', `alamat`='$alamat' where `id_penerbit`='$id'";
         mysqli_query($koneksi,$sql);
         header("Location:penerbit.php?notif=editberhasil");
      }
   }
 }
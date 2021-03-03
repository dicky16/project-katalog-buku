<?php
 //akses file koneksi database
 include('../koneksi/koneksi.php');
//  require_once('includes/fungsi/getdatabyid.php');
 if (isset($_POST['tambahuser'])) {
     $foto = $_FILES['foto']['name'];
     $nama = $_POST['nama'];
     $email = $_POST['email'];
     $username = $_POST['username'];
     $password = $_POST['password'];
     $level = $_POST['level'];
     //cek username and email
   //   $data = getDataById(1, $koneksi);
   //   var_dump($data); die;
     if(empty($foto)) {
        header("Location:tambahuser.php?notif=tambahkosong&jenis=foto");
     } else if(empty($nama)) {
        header("Location:tambahuser.php?notif=tambahkosong&jenis=nama");
     } else if(empty($email)) {
        header("Location:tambahuser.php?notif=tambahkosong&jenis=email");
     } else if(empty($username)) {
        header("Location:tambahuser.php?notif=tambahkosong&jenis=username");
     } else if(empty($password)) {
        header("Location:tambahuser.php?notif=tambahkosong&jenis=password");
     } else if(empty($level)) {
        header("Location:tambahuser.php?notif=tambahkosong&jenis=level");
     } else {
        $password = MD5($password);
        $lokasi_file = $_FILES['foto']['tmp_name'];
        $direktori = "foto/".$foto;
        if (move_uploaded_file($lokasi_file, $direktori)) {
            $sql = "INSERT INTO `user` (`nama`, `email`, `username`, `password`, `level`, `foto`) VALUES ('$nama', '$email', '$username', '$password', '$level', '$foto');";
            mysqli_query($koneksi,$sql);
        }
        header("Location:user.php?notif=tambahberhasil");
     }
 }
<?php
 //akses file koneksi database
 if (isset($_POST['tambahuser'])) {
     $foto = $_FILES['foto']['name'];
     $nama = $_POST['nama'];
     $email = $_POST['email'];
     $username = $_POST['username'];
     $password = $_POST['password'];
     $level = $_POST['level'];

     $_SESSION['nama'] = $nama;
     $_SESSION['email'] = $email;
     $_SESSION['username'] = $username;
     $_SESSION['level'] = $level;

     //cek username and email
     if (empty($foto)) {
         $_SESSION['notif'] = "tambahkosong";
         $_SESSION['jenis'] = "foto";
         header("Location:tambah-user");
     } elseif (empty($nama)) {
         $_SESSION['notif'] = "tambahkosong";
         $_SESSION['jenis'] = "nama";
         header("Location:tambah-user");
     } elseif (empty($email)) {
         $_SESSION['notif'] = "tambahkosong";
         $_SESSION['jenis'] = "email";
         header("Location:tambah-user");
     } elseif (empty($username)) {
         $_SESSION['notif'] = "tambahkosong";
         $_SESSION['jenis'] = "username";
         header("Location:tambah-user");
     } elseif (empty($password)) {
         $_SESSION['notif'] = "tambahkosong";
         $_SESSION['jenis'] = "password";
         header("Location:tambah-user");
     } elseif (empty($level)) {
         $_SESSION['notif'] = "tambahkosong";
         $_SESSION['jenis'] = "level";
         header("Location:tambah-user");
     } else {
         $password = MD5($password);
         $lokasi_file = $_FILES['foto']['tmp_name'];
         $direktori = "foto/".$foto;
         if (move_uploaded_file($lokasi_file, $direktori)) {
             $sql = "INSERT INTO `user` (`nama`, `email`, `username`, `password`, `level`, `foto`) VALUES ('$nama', '$email', '$username', '$password', '$level', '$foto');";
             mysqli_query($koneksi, $sql);
         }
         $_SESSION['notif'] = "tambahberhasil";
         unset($_SESSION['nama']);
         unset($_SESSION['email']);
         unset($_SESSION['username']);
         unset($_SESSION['level']);
         header("Location:user");
     }
 }

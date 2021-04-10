<?php
 //akses file koneksi database
 $edit_id = $_GET['id'];
 //get foto
 $sql_f = "SELECT `foto` FROM `user` WHERE `id_user`=".$edit_id;
 $query_f = mysqli_query($koneksi,$sql_f);
 while ($data_f = mysqli_fetch_row($query_f)) {
     $foto_old = $data_f[0];
 }
 if (isset($_POST['edituser'])) {
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

     if (empty($nama)) {
         $_SESSION['notif'] = "editkosong";
         $_SESSION['jenis'] = "nama";
         header("Location:edit-user-id-".$_GET['id']);
     } elseif (empty($email)) {
         $_SESSION['notif'] = "editkosong";
         $_SESSION['jenis'] = "email";
         header("Location:edit-user-id-".$_GET['id']);
     } elseif (empty($username)) {
         $_SESSION['notif'] = "editkosong";
         $_SESSION['jenis'] = "username";
         header("Location:edit-user-id-".$_GET['id']);
     } elseif (empty($level)) {
         $_SESSION['notif'] = "editkosong";
         $_SESSION['jenis'] = "level";
         header("Location:edit-user-id-".$_GET['id']);
     } else {
        if(!empty($foto) && !empty($password)) {
         $lokasi_file = $_FILES['foto']['tmp_name'];
         $foto = date('His')."-".$foto;
         $direktori = "foto/".$foto;
         unlink("foto/$foto_old");
         $password = MD5($password);
         if (move_uploaded_file($lokasi_file, $direktori)) {
             $sql = "update `user` set `nama`='$nama', `email`='$email', `username`='$username', `password`='$password', `level`='$level', `foto`='$foto' where id_user='$edit_id'";
         }
         mysqli_query($koneksi,$sql);
        } else if(!empty($foto)) {
         $lokasi_file = $_FILES['foto']['tmp_name'];
         $foto = date('His')."-".$foto;
         $direktori = "foto/".$foto;
         unlink("foto/$foto_old");
         if (move_uploaded_file($lokasi_file, $direktori)) {
            $sql = "update `user` set `nama`='$nama', `email`='$email', `username`='$username', `level`='$level', `foto`='$foto' where id_user='$edit_id'";
         }
         mysqli_query($koneksi,$sql);
        } else if(!empty($password)) {
         $password = MD5($password);
         $sql = "update `user` set `nama`='$nama', `email`='$email', `username`='$username', `password`='$password', `level`='$level' where id_user='$edit_id'";
         mysqli_query($koneksi,$sql);
        } else {
         $sql = "update `user` set `nama`='$nama', `email`='$email', `username`='$username', `level`='$level' where id_user='$edit_id'";
         mysqli_query($koneksi,$sql);
        }
        $_SESSION['notif'] = "editberhasil";
         unset($_SESSION['nama']);
         unset($_SESSION['email']);
         unset($_SESSION['username']);
         unset($_SESSION['level']);
        header("Location:user");
     }
 }
<?php
 //akses file koneksi database
 include('../koneksi/koneksi.php');
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
     if(empty($nama)) {
        header("Location:edituser.php?notif=editkosong&jenis=nama");
     } else if(empty($email)) {
        header("Location:edituser.php?notif=editkosong&jenis=email");
     } else if(empty($username)) {
        header("Location:edituser.php?notif=editkosong&jenis=username");
     } else if(empty($level)) {
        header("Location:edituser.php?notif=editkosong&jenis=level");
     } else {
        if(!empty($foto) && !empty($password)) {
         $lokasi_file = $_FILES['foto']['tmp_name'];
         $direktori = "foto/".$foto;
         unlink("foto/$foto_old");
         $password = MD5($password);
         if (move_uploaded_file($lokasi_file, $direktori)) {
             $sql = "update `user` set `nama`='$nama', `email`='$email', `username`='$username', `password`='$password', `level`='$level', `foto`='$foto' where id_user='$edit_id'";
         }
         mysqli_query($koneksi,$sql);
        } else if(!empty($foto)) {
         $lokasi_file = $_FILES['foto']['tmp_name'];
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
        header("Location:user.php?notif=editberhasil");
     }
 }
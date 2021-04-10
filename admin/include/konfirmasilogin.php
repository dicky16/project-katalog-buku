<?php
 //akses file koneksi database
 if (isset($_POST['login'])) {
     $user = $_POST['username'];
     $pass = $_POST['password'];
     $username = mysqli_real_escape_string($koneksi, $user);
     $password = mysqli_real_escape_string($koneksi, MD5($pass));

     //cek username dan password
     $sql="select `id_user`, `level` from `user`
    where (`username`='$username' or `email`='$username') and
    `password`='$password'";
     $query = mysqli_query($koneksi, $sql);
     $jumlah = mysqli_num_rows($query);
     if (empty($user)) {
        $_SESSION['gagal_login'] = 'username tidak boleh kosong!';
         header("Location:login");
     } elseif (empty($pass)) {
        $_SESSION['gagal_login'] = 'password tidak boleh kosong!';
         header("Location:login");
     } elseif ($jumlah==0) {
        $_SESSION['gagal_login'] = 'username atau password salah';
         header("Location:login");
     } else {
        //  session_start();
         //get data
         while ($data = mysqli_fetch_row($query)) {
             $id_user = $data[0]; //1
            $level = $data[1]; //speradmin
            $_SESSION['id_user']=$id_user;
             $_SESSION['level']=$level;
             unset($_SESSION['gagal_login']);
             header("Location:profil");
         }
     }
 }

<?php
 if (isset($_POST['tambahslider'])) {
     $label = $_POST['label'];
     $isi = $_POST['isi'];
     $gambar = $_FILES['gambar']['name'];

     $_SESSION['label'] = $label;
     $_SESSION['isi'] = $isi;

     if (empty($label)) {
         $_SESSION['notif'] = 'tambahkosong';
         $_SESSION['jenis'] = 'label';
         header("Location:tambah-slide");
     } elseif (empty($isi)) {
         $_SESSION['notif'] = 'tambahkosong';
         $_SESSION['jenis'] = 'isi';
         header("Location:tambah-slide");
     } elseif (empty($gambar)) {
         $_SESSION['notif'] = 'tambahkosong';
         $_SESSION['jenis'] = 'gambar';
         header("Location:tambah-slide");
     } else {
         $gambar = date('His')."-".$gambar;
         $lokasi_file = $_FILES['gambar']['tmp_name'];
         $direktori = 'slider/'.$gambar;
         if (move_uploaded_file($lokasi_file, $direktori)) {
             $sql = "INSERT INTO `slider` (`label`, `isi`, `gambar`) 
            VALUES ('$label', '$isi', '$gambar');";
             mysqli_query($koneksi, $sql);
             
             unset($_SESSION['label']);
             unset($_SESSION['isi']);
             
             $_SESSION['notif'] = 'tambahberhasil';
             header("Location:slide");
         }
     }
 } elseif (isset($_POST['updateslider'])) {
    $label = $_POST['label'];
    $isi = $_POST['isi'];
    $gambar = $_FILES['gambar']['name'];

    $_SESSION['label'] = $label;
    $_SESSION['isi'] = $isi;

    if (empty($label)) {
        $_SESSION['notif'] = 'tambahkosong';
        $_SESSION['jenis'] = 'label';
        header("Location:edit-slide");
    } elseif (empty($isi)) {
        $_SESSION['notif'] = 'tambahkosong';
        $_SESSION['jenis'] = 'isi';
        header("Location:edit-slide");
    } else {
        if(empty($gambar)) {
            $sql = "UPDATE `slider` SET `label` = '$label', `isi` = '$isi' 
            WHERE `slider`.`id` = ".$_GET['id'].";";
            mysqli_query($koneksi, $sql);
            
            unset($_SESSION['label']);
            unset($_SESSION['isi']);
            
            $_SESSION['notif'] = 'tambahberhasil';
            header("Location:slide");
        } else {
            $gambar = date('His')."-".$gambar;
            $lokasi_file = $_FILES['gambar']['tmp_name'];
            $direktori = 'slider/'.$gambar;
            $sql_gambar = "select gambar from slider where id=".$_GET['id'];
            $data_gambar = getDataUser($koneksi, $sql_gambar);
            unlink("slider/".$data_gambar[0]['gambar']);
            if (move_uploaded_file($lokasi_file, $direktori)) {
                $sql = "UPDATE `slider` SET `label` = '$label', `isi` = '$isi', gambar = '$gambar'
                WHERE `slider`.`id` = ".$_GET['id'].";";
                mysqli_query($koneksi, $sql);
            
                unset($_SESSION['label']);
                unset($_SESSION['isi']);
            
                $_SESSION['notif'] = 'tambahberhasil';
                header("Location:slide");
            }
        }
    }
 }

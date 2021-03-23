<?php
 //akses file koneksi database
 include('../koneksi/koneksi.php');
 session_start();
 if (isset($_POST['tambahbuku'])) {
     $id_kategoribuku = $_POST['kategori_buku'];
     $judul = $_POST['judul'];
     $pengarang = $_POST['pengarang'];
     $penerbit = $_POST['penerbit'];
     $tahun_terbit = $_POST['tahun'];
     $sinopsis = $_POST['sinopsis'];
     $cover = $_FILES['cover']['name'];
     $tag = $_POST['tag'];
     
     $_SESSION['id_kategori'] = $id_kategoribuku;
     $_SESSION['judul'] = $judul;
     $_SESSION['pengarang'] = $pengarang;
     $_SESSION['penerbit'] = $penerbit;
     $_SESSION['tahun_terbit'] = $tahun_terbit;
     $_SESSION['sinopsis'] = $sinopsis;
     $_SESSION['tag'] = $tag;
     if (empty($id_kategoribuku)) {
         header("Location:tambahbuku.php?notif=tambahkosong&jenis=kategoribuku");
     } elseif (empty($judul)) {
         header("Location:tambahbuku.php?notif=tambahkosong&jenis=judul");
     } elseif (empty($pengarang)) {
         header("Location:tambahbuku.php?notif=tambahkosong&jenis=pengarang");
     } elseif (empty($penerbit)) {
         header("Location:tambahbuku.php?notif=tambahkosong&jenis=penerbit");
     } elseif (empty($tahun_terbit)) {
         header("Location:tambahbuku.php?notif=tambahkosong&jenis=tahunterbit");
     } elseif (empty($sinopsis)) {
         header("Location:tambahbuku.php?notif=tambahkosong&jenis=sinopsis");
     } elseif (empty($tag)) {
         header("Location:tambahbuku.php?notif=tambahkosong&jenis=tag");
     } elseif (empty($cover)) {
         header("Location:tambahbuku.php?notif=tambahkosong&jenis=cover");
     } else {
         $nama_cover = date('His')."-".$cover;
         $lokasi_file = $_FILES['cover']['tmp_name'];
         $direktori = 'cover/'.$nama_cover;
         if (move_uploaded_file($lokasi_file, $direktori)) {
             $sql = "INSERT INTO `buku` (`id_kategori_buku`, `judul`, `pengarang`, 
            `id_penerbit`, `tahun_terbit`, `sinopsis`, `cover`) 
            VALUES ('$id_kategoribuku', '$judul', '$pengarang', 
            '$penerbit', '$tahun_terbit', '$sinopsis', '$nama_cover');";
             mysqli_query($koneksi, $sql);
             $id_buku = mysqli_insert_id($koneksi);
             //insert tag
             if (isset($_POST['tag'])) {
                 $jumlah_tag = count($_POST['tag']);
                 for ($i=0; $i < $jumlah_tag; $i++) {
                     $tag[] = $_POST['tag'][$i];
                     $sql_tag = "INSERT INTO `tag_buku` (`id_buku`, `id_tag`) 
                    VALUES ('$id_buku', '$tag[$i]');";
                     mysqli_query($koneksi, $sql_tag);
                 }
             }
             //end insert tag
             unset($_SESSION['id_kategori']);
             unset($_SESSION['judul']);
             unset($_SESSION['pengarang']);
             unset($_SESSION['penerbit']);
             unset($_SESSION['tahun_terbit']);
             unset($_SESSION['sinopsis']);
             unset($_SESSION['tag']);
             header("Location:buku.php?notif=tambahberhasil");
         }
     }
 } elseif (isset($_POST['updatebuku'])) {
     $id = $_GET['id'];
     if (is_numeric($id)) {
         $id_kategoribuku = $_POST['kategori_buku'];
         $judul = $_POST['judul'];
         $pengarang = $_POST['pengarang'];
         $penerbit = $_POST['penerbit'];
         $tahun_terbit = $_POST['tahun'];
         $sinopsis = $_POST['sinopsis'];
         $cover = $_FILES['cover']['name'];
         $tag = $_POST['tag'];
         $_SESSION['id_kategori'] = $id_kategoribuku;
         $_SESSION['judul'] = $judul;
         $_SESSION['pengarang'] = $pengarang;
         $_SESSION['penerbit'] = $penerbit;
         $_SESSION['tahun_terbit'] = $tahun_terbit;
         $_SESSION['sinopsis'] = $sinopsis;
         $_SESSION['tag'] = $tag;
         if (empty($id_kategoribuku)) {
             header("Location:editbuku.php?id=".$_GET['id']."&notif=editkosong&jenis=kategoribuku");
         } elseif (empty($judul)) {
             header("Location:editbuku.php?id=".$_GET['id']."&notif=editkosong&jenis=judul");
         } elseif (empty($pengarang)) {
             header("Location:editbuku.php?id=".$_GET['id']."&notif=editkosong&jenis=pengarang");
         } elseif (empty($penerbit)) {
             header("Location:editbuku.php?id=".$_GET['id']."&notif=editkosong&jenis=penerbit");
         } elseif (empty($tahun_terbit)) {
             header("Location:editbuku.php?id=".$_GET['id']."&notif=editkosong&jenis=tahunterbit");
         } elseif (empty($sinopsis)) {
             header("Location:editbuku.php?id=".$_GET['id']."&notif=editkosong&jenis=sinopsis");
         } elseif (empty($tag)) {
             header("Location:editbuku.php?id=".$_GET['id']."&notif=editkosong&jenis=tag");
         } elseif (empty($cover)) {
             header("Location:editbuku.php?id=".$_GET['id']."&notif=editkosong&jenis=cover");
         } else {
             $id = $_GET['id'];
             $nama_cover = date('His')."-".$cover;
             $lokasi_file = $_FILES['cover']['tmp_name'];
             $direktori = 'cover/'.$nama_cover;
             //hapus cover di folder server
             $sql_d = "select `cover` from `buku` where `id_buku`='$id'";
             $query_d = mysqli_query($koneksi, $sql_d);
             while ($cover = mysqli_fetch_row($query_d)) {
                 $coverhapus = $cover[0];
             }
             if($coverhapus) {
                unlink("cover/$coverhapus");
             }
             //end hapus cover
             if (move_uploaded_file($lokasi_file, $direktori)) {
                 $sql = "UPDATE `buku` SET `id_kategori_buku` = '$id_kategoribuku', `judul` = '$judul', 
                 `pengarang` = '$pengarang', `id_penerbit` = '$penerbit', `tahun_terbit` = '$tahun_terbit', 
                 `sinopsis` = '$sinopsis', `cover` = '$nama_cover' 
                 WHERE `buku`.`id_buku` = '$id';";
                 mysqli_query($koneksi, $sql);
             }
             //hapus tag
             if(isset($_GET['id'])) {
                $sql_hapus_tag = "delete from `tag_buku` where `id_buku`='$id'";
                mysqli_query($koneksi, $sql_hapus_tag);
             }
             //insert tag
             if (isset($_POST['tag'])) {
                 $jumlah_tag = count($_POST['tag']);
                 for ($i=0; $i < $jumlah_tag; $i++) {
                     $tag[] = $_POST['tag'][$i];
                     $sql_tag = "INSERT INTO `tag_buku` (`id_buku`, `id_tag`) 
                   VALUES ('$id', '$tag[$i]');";
                     mysqli_query($koneksi, $sql_tag);
                 }
             }
             unset($_SESSION['id_kategori']);
             unset($_SESSION['judul']);
             unset($_SESSION['pengarang']);
             unset($_SESSION['penerbit']);
             unset($_SESSION['tahun_terbit']);
             unset($_SESSION['sinopsis']);
             unset($_SESSION['tag']);
             header("Location:buku.php?notif=editberhasil");
         }
     }
 }

<?php
session_start();
include("../koneksi/koneksi.php");
if (isset($_GET["include"])) {
    $include = $_GET["include"];
    if ($include=="konfirmasi-login") {
        include("include/konfirmasilogin.php");
    } elseif ($include=="logout") {
        include("include/logout.php");
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<?php include("includes/head.php") ?>
</head>
<?php
//cek ada get include
if (isset($_GET["include"])) {
    $include = $_GET["include"];
    //cek apakah ada session id admin
    if (isset($_SESSION['id_user'])) {
        //pemanggilan ke halaman-halaman menu admin
        if ($include=="kategori-buku") { //kategori buku
            include("include/kategoribuku.php");
        } else if($include=="konfirmasi-kategori-buku") {
            include("include/konfirmasikategoribuku.php");
        } else if($include=="tambah-kategori-buku") {
            include("include/tambahkategoribuku.php");
        } else if($include=="edit-kategori-buku") {
            include("include/editkategoribuku.php");
        } else if($include=="hapus-kategori-buku") {
            include("include/hapuskategoribuku.php"); //end kategori buku

        } else if($include=="blog") { //blog
            include("include/blog.php");
        } else if($include=="edit-blog") {
            include("include/editblog.php");
        } else if($include=="tambah-blog") {
            include("include/tambahblog.php");
        } else if($include=="konfirmasi-blog") {
            include("include/konfirmasiblog.php");
        } else if($include=="detail-blog") {
            include("include/detailblog.php");
        } else if($include=="hapus-blog") {
            include("include/hapusblog.php"); // end blog
        } 
        else if($include=="tag") { //tag
            include("include/tag.php");
        } else if($include=="tambah-tag") {
            include("include/tambahtag.php");
        } else if($include=="konfirmasi-tag") {
            include("include/konfirmasitag.php");
        } else if($include=="edit-tag") {
            include("include/edittag.php");
        } else if($include=="hapus-tag") {
            include("include/hapustag.php"); // end tag
        }
        else if($include=="penerbit") { //penerbit
            include("include/penerbit.php");
        } else if($include=="tambah-penerbit") {
            include("include/tambahpenerbit.php");
        } else if($include=="konfirmasi-penerbit") {
            include("include/konfirmasipenerbit.php");
        } else if($include=="hapus-penerbit") {
            include("include/hapuspenerbit.php");
        } else if($include=="edit-penerbit") {
            include("include/editpenerbit.php");
        }
         else if($include=="set-session") {
            include("include/setsession.php");
        } else {
            include("include/profil.php");
        }
    } else {
        //pemanggilan halaman form login
        include("include/login.php");
    }
} else {
    if (isset($_SESSION['id_user'])) {
        //pemanggilan ke halaman-halaman profil jika ada session
        include("include/profil.php");
    } else {
        //pemanggilan halaman form login
        include("include/login.php");
    }
}
?>
</html>

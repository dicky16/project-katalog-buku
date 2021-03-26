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
            include("include/editpenerbit.php");//end penerbit
        }
        else if($include=="kategori-blog") {//kategori blog
            include("include/kategoriblog.php");
        } else if($include=="tambah-kategori-blog") {
            include("include/tambahkategoriblog.php");
        } else if($include=="konfirmasi-kategori-blog") {
            include("include/konfirmasikategoriblog.php");
        } else if($include=="edit-kategori-blog") {
            include("include/editkategoriblog.php");
        } else if($include=="hapus-kategori-blog") {
            include("include/hapuskategoriblog.php"); // end kategori blog
        } 
        else if($include=="edit-profil") { // edit profil
            include("include/editprofil.php"); 
        } else if($include=="konfirmasi-edit-profil") {
            include("include/konfirmasieditprofil.php"); //end edit profil 
        } 
        else if($include=="konten") { // konten
            include("include/konten.php"); 
        } else if($include=="edit-konten") {
            include("include/editkonten.php"); 
        } else if($include=="konfirmasi-konten") {
            include("include/konfirmasikonten.php"); 
        } else if($include=="detail-konten") {
            include("include/detailkonten.php"); //end konten
        }
        else if($include=="buku") { // buku
            include("include/buku.php");
        } else if($include=="tambah-buku") {
            include("include/tambahbuku.php");
        } else if($include=="konfirmasi-buku") {
            include("include/konfirmasibuku.php");
        } else if($include=="edit-buku") {
            include("include/editbuku.php");
        } else if($include=="hapus-buku") {
            include("include/hapusbuku.php"); //end buku
        } 
        else if($include=="user") { // user
            include("include/user.php");
        } else if($include=="tambah-user") {
            include("include/tambahuser.php");
        } else if($include=="konfirmasi-user") {
            include("include/konfirmasiuser.php");
        } else if($include=="konfirmasi-tambah-user") {
            include("include/konfirmasitambahuser.php");
        } else if($include=="edit-user") {
            include("include/edituser.php");
        } else if($include=="konfirmasi-edit-user") {
            include("include/konfirmasiedituser.php");
        } else if($include=="hapus-user") {
            include("include/hapususer.php");
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

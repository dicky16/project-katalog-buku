<?php
include("koneksi/koneksi.php");
include("fungsi/fungsi.php");
?>
<!DOCTYPE html>
<html>
<head>
</head>
<?php
//cek ada get include
if (isset($_GET["page"])) {
    $page = $_GET["page"];
    //cek apakah ada session id admin
        //pemanggilan ke halaman-halaman menu admin
      if ($page=="blog") { //kategori buku
        include("blog.php");
      } else if($page == "detail-blog") {
        include("detailblog.php");
      } else {
        include("beranda.php");
      }
}
?>
</html>
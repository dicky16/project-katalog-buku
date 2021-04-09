<?php
include("koneksi/koneksi.php");
include("fungsi/fungsi.php");
?>
<!DOCTYPE html>
<html>
<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="user/dist/css/bootstrap.min.css">
<!-- Global CSS-->
<link rel="stylesheet" href="user/dist/css/style.css">
<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
<title>Katalog Buku</title>
</head>
<body>
<?php
//data kategori blog
$sql_kategori_buku = "select kategori_buku.*
                from buku 
                INNER JOIN kategori_buku ON buku.id_kategori_buku = kategori_buku.id_kategori_buku
                INNER JOIN penerbit ON buku.id_penerbit = penerbit.id_penerbit limit 5";
                $data_kategori_buku = getDataUser($koneksi, $sql_kategori_buku);
                $result = array();
                foreach ($data_kategori_buku as $key => $value){
                  if(!in_array($value, $result))
                    $result[$key]=$value;
                }
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
        <a class="navbar-brand" href="beranda">Katalog Buku</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample07" aria-controls="navbarsExample07" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    
        <div class="collapse navbar-collapse" id="navbarsExample07">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="beranda">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about-us">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="daftar-buku">Buku</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown07" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Kategori</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown07">
                    <?php foreach ($result as $kategori_buku) { ?>
                    <a class="dropdown-item" href="daftar-buku_kategori-<?= $kategori_buku['id_kategori_buku'] ?>"><?= $kategori_buku['kategori_buku'] ?></a>
                    <?php } ?>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="blog">Blog</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact-us">Contact Us</a>
                </li>
            </ul>
            <form class="form-inline mt-2 mt-md-0">
              <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
        </div>
    </nav>
<?php
//cek ada get include
if (isset($_GET["page"])) {
    $page = $_GET["page"];
    //cek apakah ada session id admin
        //pemanggilan ke halaman-halaman menu admin
      if ($page=="blog") { //kategori buku
        include("user/blog.php");
      } else if($page == "detail-blog") {
<<<<<<< HEAD
        include("detailblog.php");
      } else if($page == "detail-buku") {
        include("detailbuku.php");
=======
        include("user/detailblog.php");
      } else if($page == "about-us") {
        include("user/aboutus.php");
      } else if($page == "daftar-buku") {
        include("user/daftarbuku.php");
      } else if($page == "contact-us") {
        include("user/contactus.php");
      } else if($page == "detail-buku") {
        include("user/detailbuku.php");
>>>>>>> 11155a68fe59a268feb58a652b963a19ecfafd2d
      } else {
        include("user/beranda.php");
      }
}
?>
<footer class="bg-primary text-dark">
  <div class="container">
    <p class="float-right">
      <a href="#" class="text-white">Back to top</a>
    </p>
    <p>&copy; <b>2021 Vokasi UB.</b> All rights reserved.</p>
  </div>
</footer>
<!-- Optional JavaScript; choose one of the two! -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="user/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
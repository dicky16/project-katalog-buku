<?php
include("koneksi/koneksi.php");
include("fungsi/fungsi.php");
session_start();
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
<style>
.typeahead__container, .typeahead__field, .typeahead__filter, .typeahead__query {
    position: relative;
}
.typeahead__dropdown, .typeahead__list {
    position: absolute;
    left: 0;
    z-index: 1000;
    width: 100%;
    min-width: 160px;
    padding: 5px 0;
    margin: 2px 0 0;
    list-style: none;
    text-align: left;
    background-color: #fff;
    border: 1px solid #ccc;
    border-radius: 2px;
    background-clip: padding-box;
}
    /* -webkit-tap-highlight-color: transparent;
    -webkit-text-size-adjust: 100%;
    font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
    font-size: 14px;
    line-height: 1.42857143;
    color: #333;
    box-sizing: border-box;
    position: relative; */
</style>
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
                foreach ($data_kategori_buku as $key => $value) {
                    if (!in_array($value, $result)) {
                        $result[$key]=$value;
                    }
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

            <div class="typeahead__container cancel result">
              <input class="form-control mr-sm-2" id="search" name="search" type="text" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-light my-2 my-sm-0" type="submit"><i class='icon-search'></i></button>
              <div id="display-search"></div>
            </div>
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
      } elseif ($page == "detail-blog") {
          include("user/detailblog.php");
      } elseif ($page == "about-us") {
          include("user/aboutus.php");
      } elseif ($page == "daftar-buku") {
          include("user/daftarbuku.php");
      } elseif ($page == "contact-us") {
          include("user/contactus.php");
      } elseif ($page == "detail-buku") {
          include("user/detailbuku.php");
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
<!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="user/dist/js/bootstrap.bundle.min.js"></script>
<script>
$( "#search" ).keyup(function() {
  $("#display-search").empty();
  var key = $("#search").val();
  console.log("jalan " + key);
  if(key) {
    $.post( "user/search.php", { data: key})
      .done(function( data ) {
      console.log(data);
      for (let index = 0; index < data.length; index++) {
        // const element = array[index];
        
    $("#display-search").html('<div class="typeahead__result">'+
      '<ul class="typeahead__list">'+
      '<li class="typeahead__item typeahead__group-default" data-group="default" data-index="0">'+
      '<a href="detail-buku-id-'+data[index].id_buku+'">'+
      '<span class="typeahead__display">'+
      '<strong>'+data[index].judul+''+
      '</span>'+
      '</a>'+
      '</li>'+
      '</ul>'+
      '</div>');
    }
    });
  } else {
    $("#display-search").empty();
  }
});
</script>
</body>
</html>
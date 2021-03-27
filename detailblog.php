<?php
// data blog
$sql_blog = "select blog.*, kategori_blog.*, user.nama
          from blog 
          INNER JOIN kategori_blog ON blog.id_kategori_blog = kategori_blog.id_kategori_blog 
          INNER JOIN user ON blog.id_user = user.id_user
          WHERE id_blog='".$_GET['id']."'";
$query_blog = mysqli_query($koneksi, $sql_blog);
while ($data_b = mysqli_fetch_assoc($query_blog)) {
    $data_blog[] = $data_b;
}
//data kategori blog
$sql_kategori_blog_detail = "select * from kategori_blog order by kategori_blog";
$query_kategori_blog_detail = mysqli_query($koneksi, $sql_kategori_blog_detail);
while ($data_k_detail = mysqli_fetch_assoc($query_kategori_blog_detail)) {
    $data_kategori_blog_detail[] = $data_k_detail;
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="dist/css/bootstrap.min.css">

    <!-- Global CSS-->
    <link rel="stylesheet" href="dist/css/style.css">

    <title>Katalog Buku</title>
  </head>
  <body>
  <?php include('section/nav.php') ?>
    <section id="blog-header">
      <div class="container">
        <h1 class="text-white">BLOG</h1>
      </div>
    </section><br><br>
    <section id="blog-list">
      <main role="main" class="container">
        <div class="row">
          <div class="col-md-9 blog-main">
            <div class="blog-post">
              <h2 class="blog-post-title"><?= $data_blog[0]['judul'] ?></h2>
              <p class="blog-post-meta"><?= tanggal_indonesia($data_blog[0]['tanggal']) ?> by <a href="#"><?= $data_blog[0]['nama'] ?></a></p>

              <?= $data_blog[0]['isi'] ?>
            </div><br><br><!-- /.blog-post -->

           

          </div><!-- /.blog-main -->
      
          <aside class="col-md-3 blog-sidebar">
      
            <div class="p-4">
              <h4 class="font-italic">Categories</h4>
              <ol class="list-unstyled mb-0">
              <?php 
              $i = 0;
              foreach ($data_kategori_blog_detail as $kategori_blog_detail) {
                // var_dump($data_kategori_blog_detail); die;
                  ?>
                <a class="dropdown-item" href="daftarbuku_kategori-<?= $kategori_blog_detail['kategori_blog'] ?>"><?= $kategori_blog_detail['kategori_blog'] ?></a>
              <?php } ?>
            </div>
      
            <div class="p-4">
              <h4 class="font-italic">Archives</h4>
              <ol class="list-unstyled mb-0">
                <li><a href="#">March 2014</a></li>
                <li><a href="#">February 2014</a></li>
                <li><a href="#">January 2014</a></li>
                <li><a href="#">December 2013</a></li>
                <li><a href="#">November 2013</a></li>
                <li><a href="#">October 2013</a></li>
                <li><a href="#">September 2013</a></li>
                <li><a href="#">August 2013</a></li>
                <li><a href="#">July 2013</a></li>
                <li><a href="#">June 2013</a></li>
                <li><a href="#">May 2013</a></li>
                <li><a href="#">April 2013</a></li>
              </ol>
            </div>
      
            
          </aside><!-- /.blog-sidebar -->
      
        </div><!-- /.row -->
      
      </main><!-- /.container -->
    </section><br><br>
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
    <script src="dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
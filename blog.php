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
  <?php include("section/nav.php") ?>
    <section id="blog-header">
      <div class="container">
        <h1 class="text-white">BLOG</h1>
      </div>
    </section><br><br>
    <section id="blog-list">
      <main role="main" class="container">
        <div class="row">
          <div class="col-md-9 blog-main">
          <?php
          $batas = 5;
          if (!isset($_GET['halaman'])) {
              $posisi = 0;
              $halaman = 1;
          } else {
              $halaman = $_GET['halaman'];
              $posisi = ($halaman-1) * $batas;
          }
          $sql_jum = "select id_blog, kategori_blog.kategori_blog, `judul`, `tanggal`, user.nama 
                  from blog 
                  INNER JOIN kategori_blog ON blog.id_kategori_blog = kategori_blog.id_kategori_blog 
                  INNER JOIN user ON blog.id_user = user.id_user";
                  $sql_jum .= " order by `judul`";
                  $query_jum = mysqli_query($koneksi, $sql_jum);
                  $jum_data = mysqli_num_rows($query_jum);
                  $jum_halaman = ceil($jum_data/$batas);
          $sql = "select blog.*, kategori_blog.kategori_blog, user.nama 
          from blog 
          INNER JOIN kategori_blog ON blog.id_kategori_blog = kategori_blog.id_kategori_blog 
          INNER JOIN user ON blog.id_user = user.id_user";
          if(isset($_GET['kategori'])) {
            $kategori_blog = $_GET['kategori'];
            $sql_id_kategori_blog = "select id_kategori_blog from kategori_blog where kategori_blog='$kategori_blog'";
            $id_kategori_blog = getDataUser($koneksi, $sql_id_kategori_blog);
            $sql .=" where blog.id_kategori_blog=".$id_kategori_blog[0]['id_kategori_blog'];
          }
          if(isset($_GET['bulan']) && isset($_GET['tahun'])) {
            $bulan = $_GET['bulan'];
            $tahun = $_GET['tahun'];
            $sql .= " WHERE YEAR(blog.tanggal) = '$tahun' AND MONTH(blog.tanggal) = '$bulan'";
          }
          $sql .=" ORDER BY `judul` limit $posisi, $batas ";
          $data_blog = getDataUser($koneksi, $sql);
          // var_dump($data_blog); die;
          if ($data_blog) {
              foreach ($data_blog as $blog) {
                  // var_dump($blog); die?>
            <div class="blog-post">
              <h2 class="blog-post-title"><a href="detail-blog-id-<?= $blog['id_blog'] ?>"><?= $blog['judul'] ?></a></h2>
              <p class="blog-post-meta"><?= tanggal_indonesia($blog['tanggal']) ?> by <a href="#"><?= $blog['nama'] ?></a></p>
              <!--<img src="slideshow/slide-1.jpg" class="img-fluid" alt="Responsive image"><br><br>-->
      
              <?= $blog['isi'] ?>
              <br>
                <a href="detail-blog-id-<?= $blog['id_blog'] ?>" class="btn btn-primary">Continue reading..</a>
              </div><!-- /.blog-post --><br><br>
            <?php
              }
          } else {
              ?>
          <div class="blog-post">
          <p>Tidak ada blog kategori <?php echo isset($_GET['kategori']) ? $_GET['kategori'] : '' ?></p>
          </div>
          <?php
          } ?>
            <nav class="blog-pagination">
            <?php
            if ($jum_halaman==0) {
              //tidak ada halaman
            } elseif ($jum_halaman==1) {

            } else {
              $sebelum = $halaman-1;
              $setelah = $halaman+1;
              echo "<a class='btn btn-outline-primary' href='blog-halaman-".$sebelum."'> <i class='icon-chevron-left'></i> New </a>";
              echo "<a class='btn btn-outline-primary' href='blog-halaman-".$setelah."'><i class='icon-chevron-right'></i> Old</a>";
            }
            ?>
        
            </nav>
      
          </div><!-- /.blog-main -->
      
          <aside class="col-md-3 blog-sidebar">
      
            <div class="p-4">
              <h4 class="font-italic">Categories</h4>
              <ol class="list-unstyled mb-0">
                <?php
                $sql_kategori_blog = "select * from kategori_blog";
                $data_kategori_blog = getDataUser($koneksi, $sql_kategori_blog);
                foreach ($data_kategori_blog as $kategori_blog) {
                    ?>
                    <li><a href="blog_kategori-<?= $kategori_blog['kategori_blog'] ?>""><?= $kategori_blog['kategori_blog'] ?></a></li>
                <?php
                } ?>
            </div>
      
            <div class="p-4">
              <h4 class="font-italic">Archives</h4>
              <ol class="list-unstyled mb-0">
              <?php
              $sql_archives = "select tanggal from blog";
              $data_archives = getDataUser($koneksi, $sql_archives);
              $data_archives_array[0] = tanggal_arsip($data_archives[0]['tanggal']);
              for ($i=0; $i < count($data_archives); $i++) {
                  if (!is_numeric(array_search(tanggal_arsip($data_archives[$i]['tanggal']), $data_archives_array))) {
                      array_push($data_archives_array, tanggal_arsip($data_archives[$i]['tanggal']));
                  }
              }
              ?>
              <?php foreach ($data_archives_array as $arsip) {
                $arsip_array = nama_bulan_to_angka($arsip);
                ?>
                <li><a href="blog_bulan-<?= $arsip_array[0] ?>-tahun-<?= $arsip_array[1] ?>"><?= $arsip ?></a></li>
              <?php } ?>
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
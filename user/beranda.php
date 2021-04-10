<?php
// data blog
$sql_blog = "select id_blog, kategori_blog.kategori_blog, `judul`, `tanggal`, user.nama, isi
          from blog 
          INNER JOIN kategori_blog ON blog.id_kategori_blog = kategori_blog.id_kategori_blog 
          INNER JOIN user ON blog.id_user = user.id_user
          order by id_blog desc";
$query_blog = mysqli_query($koneksi, $sql_blog);
while ($data_b = mysqli_fetch_assoc($query_blog)) {
  $data_blog[] = $data_b;
}
// var_dump($data_blog); die;
//data buku
$sql = "select buku.*, kategori_buku.*, penerbit.*
          from buku 
          INNER JOIN kategori_buku ON buku.id_kategori_buku = kategori_buku.id_kategori_buku
          INNER JOIN penerbit ON buku.id_penerbit = penerbit.id_penerbit";
          $sql .=" ORDER BY `judul` limit 6";
          $data_buku = getDataUser($koneksi, $sql);
?>
    <section id="carousel-item">
        <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
              <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
              <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
              <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="user/slideshow/slide-1.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                  <h5>First slide label</h5>
                  <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
                </div>
              </div>
              <div class="carousel-item">
                <img src="user/slideshow/slide-2.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                  <h5>Second slide label</h5>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                </div>
              </div>
              <div class="carousel-item">
                <img src="user/slideshow/slide-3.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                  <h5>Third slide label</h5>
                  <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
                </div>
              </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>
    </section>
    <section id="notes-item">
        <div class="container">
            <div class="row featurette">
                <div class="col-md-7">
                <?php $sql_headline = "select * from konten";
                $data_headline = getDataUser($koneksi, $sql_headline); ?>
                  <h2 class="featurette-heading"><?= $data_headline[0]['judul'] ?></h2>
                  <p class="lead"><?= $data_headline[0]['isi'] ?></p>
                </div>
                <div class="col-md-5">
                    <img src="user/images/undraw_book_lover_mkck.png" class="img-fluid mx-auto featurette-image">
                  <!--<svg class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 500x500"><title>Placeholder</title><rect width="100%" height="100%" fill="#eee"/><text x="50%" y="50%" fill="#aaa" dy=".3em">500x500</text></svg>-->
                </div>
            </div>
            <hr class="featurette-divider"> 
        </div>
    </section><!-- #notes-item -->
    
    <section id="product-item">
        <div class="container">
            <h2>Koleksi Terbaru</h2>
            <div class="row">
            <?php
              foreach ($data_buku as $buku) {
                  ?>
              <div class="col-md-4">
                <div class="card mb-4 shadow-sm">
                  <img src="admin/cover/<?= $buku['cover'] ?>" class="img-fluid" alt="<?= $buku['judul'] ?>" title="<?= $buku['judul'] ?>">
                  <div class="card-body bg-warning">
                    <p class="card-text"><?= $buku['judul'] ?></p>
                    <div class="d-flex justify-content-between align-items-center">
                      <div class="btn-group">
                       <a href="detail-buku-id-<?= $buku['id_buku'] ?>" class="btn btn-primary stretched-link">Detail</a>
                      </div>
                      <small class="text-muted"><?= $buku['penerbit'] ?></small>
                    </div>
                  </div>
                </div>
              </div>
              <?php
              } ?>

              <div class="col text-right"><a href="daftar-buku" class="btn btn-primary stretched-link">Lihat Semua</a></div>
              
            </div>
          </div>
    </section><br><br><!-- #product-item -->
    
    <!-- <section id="quotes-item" class="bg-light" style="min-height: 80px;padding:40px 0px 0px 0px;">
        <div class="container">
            <blockquote class="blockquote text-center">
                <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                <footer class="blockquote-footer">Someone famous in <cite title="Source Title">Source Title</cite></footer>
            </blockquote>
        </div>
    </section><br><br> -->
    <section id="blog-item" class="mb-4">
        <div class="container">
            <h2>Blog Terbaru</h2><br>
            <div class="row mb-2">
              <?php foreach ($data_blog as $blog) {
                ?>
                <div class="col-md-6">
                    <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                        <div class="col p-4 d-flex flex-column position-static bg-light">
                        <strong class="d-inline-block mb-2 text-success"><?= $blog['judul'] ?></strong>
                        <h3 class="mb-0"><a href="detail-blog-id-<?= $blog['id_blog']; ?>" ><?= $blog['judul'] ?></a></h3>
                        <div class="mb-1 text-muted"><?= tanggal_indonesia($blog['tanggal']) ?></div>
                        </div>
                        <div class="col-auto d-none d-lg-block">
                            <img src="user/images/blog.jpg" class="img-fluid" title="<?= $blog['judul'] ?>">
                        </div>
                    </div>
                </div>
              <?php } ?>
            </div>
        </div>
    </section>
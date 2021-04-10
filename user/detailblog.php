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
                $sql_kategori_blog = "select * from kategori_blog";
                $data_kategori_blog = getDataUser($koneksi, $sql_kategori_blog);
                foreach ($data_kategori_blog as $kategori_blog) {
                    ?>
                    <li><a href="blog_kategori-<?= $kategori_blog['kategori_blog'] ?>"><?= $kategori_blog['kategori_blog'] ?></a></li>
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
                $arsip_array = nama_bulan_to_angka($arsip); ?>
                <li><a href="blog_bulan-<?= $arsip_array[0] ?>-tahun-<?= $arsip_array[1] ?>"><?= $arsip ?></a></li>
              <?php } ?>
              </ol>
            </div>
      
            
          </aside><!-- /.blog-sidebar -->
      
        </div><!-- /.row -->
      
      </main><!-- /.container -->
    </section><br><br>
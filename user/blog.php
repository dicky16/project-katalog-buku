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
          $sql_jum = "select id_blog, kategori_blog.kategori_blog, `judul`, `tanggal`, user.nama 
                  from blog 
                  INNER JOIN kategori_blog ON blog.id_kategori_blog = kategori_blog.id_kategori_blog 
                  INNER JOIN user ON blog.id_user = user.id_user";
          if (isset($_GET['kategori'])) {
            $kategori_blog = $_GET['kategori'];
            $sql_id_kategori_blog = "select id_kategori_blog from kategori_blog where kategori_blog='$kategori_blog'";
            $id_kategori_blog = getDataUser($koneksi, $sql_id_kategori_blog);
            if ($id_kategori_blog) {
                $sql_jum .= " WHERE blog.id_kategori_blog=".$id_kategori_blog[0]['id_kategori_blog'];
            }
          } elseif(isset($_GET['bulan']) && isset($_GET['tahun'])) {
            $bulan = $_GET['bulan'];
            $tahun = $_GET['tahun'];
            $sql_jum .= " WHERE YEAR(blog.tanggal) = '$tahun' AND MONTH(blog.tanggal) = '$bulan'";
          }

          $sql_jum .= " order by `judul`";
          $query_jum = mysqli_query($koneksi, $sql_jum);
          $jum_data = mysqli_num_rows($query_jum);
          $jum_halaman = ceil($jum_data/$batas);

          if (!isset($_GET['halaman'])) {
              $posisi = 0;
              $halaman = 1;
          } else if($_GET['halaman']==0 || $_GET['halaman']>$jum_halaman) {
              $posisi = 0;
              $halaman = 1;
          } else {
              $halaman = $_GET['halaman'];
              $posisi = ($halaman-1) * $batas;
          }
          $sql = "select blog.*, kategori_blog.kategori_blog, user.nama 
          from blog 
          INNER JOIN kategori_blog ON blog.id_kategori_blog = kategori_blog.id_kategori_blog 
          INNER JOIN user ON blog.id_user = user.id_user";
          if(isset($_GET['kategori'])) {
            $kategori_blog = $_GET['kategori'];
            $sql_id_kategori_blog = "select id_kategori_blog from kategori_blog where kategori_blog='$kategori_blog'";
            $id_kategori_blog = getDataUser($koneksi, $sql_id_kategori_blog);
            if ($id_kategori_blog) {
                $sql .=" where blog.id_kategori_blog=".$id_kategori_blog[0]['id_kategori_blog'];
            }
          }
          if(isset($_GET['bulan']) && isset($_GET['tahun'])) {
            $bulan = $_GET['bulan'];
            $tahun = $_GET['tahun'];
            $sql .= " WHERE YEAR(blog.tanggal) = '$tahun' AND MONTH(blog.tanggal) = '$bulan'";
          }
          $sql .=" ORDER BY `judul` limit $posisi, $batas";
          $data_blog = getDataUser($koneksi, $sql);
          if ($data_blog) {
              foreach ($data_blog as $blog) {
                $isi_blog = str_word_count($blog['isi']) > 60 ? substr($blog['isi'],0,400)."..." : $blog['isi'];
                ?>
            <div class="blog-post">
              <h2 class="blog-post-title"><a href="detail-blog-id-<?= $blog['id_blog'] ?>"><?= $blog['judul'] ?></a></h2>
              <p class="blog-post-meta"><?= tanggal_indonesia($blog['tanggal']) ?> by <a href="#"><?= $blog['nama'] ?></a></p>
              <!--<img src="slideshow/slide-1.jpg" class="img-fluid" alt="Responsive image"><br><br>-->
      
              <?= $isi_blog ?>
              <br>
                <a href="detail-blog-id-<?= $blog['id_blog'] ?>" class="btn btn-primary">Continue reading..</a>
              </div><!-- /.blog-post --><br><br>
            <?php
              }
          } else {
              ?>
          <div class="blog-post">
          <p>Tidak ada blog</p>
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
              if($halaman==1) {
                if (isset($_GET['kategori'])) {
                  echo "<a class='btn btn-outline-primary' href='blog_kategori-".$_GET['kategori']."-halaman-".$setelah."'><i class='icon-chevron-right'></i> Old</a>";
                } elseif(isset($_GET['bulan']) && isset($_GET['tahun'])) {
                  echo "<a class='btn btn-outline-primary' href='blog_bulan-".$_GET['bulan']."-tahun-".$_GET['tahun']."-halaman-".$setelah."'><i class='icon-chevron-right'></i> Old</a>";
                } else {
                    echo "<a class='btn btn-outline-primary' href='blog-halaman-".$setelah."'><i class='icon-chevron-right'></i> Old</a>";
                }
              } else if($halaman==$jum_halaman) {
                if (isset($_GET['kategori'])) {
                  echo "<a class='btn btn-outline-primary' href='blog_kategori-".$_GET['kategori']."-halaman-".$sebelum."'><i class='icon-chevron-left'></i> New</a>";
                } elseif(isset($_GET['bulan']) && isset($_GET['tahun'])) {
                  echo "<a class='btn btn-outline-primary' href='blog_bulan-".$_GET['bulan']."-tahun-".$_GET['tahun']."-halaman-".$sebelum."'><i class='icon-chevron-left'></i> New</a>";
                } else {
                    echo "<a class='btn btn-outline-primary' href='blog-halaman-".$sebelum."'> <i class='icon-chevron-left'></i> New </a>";
                }
              } elseif($halaman>1 && $halaman<$jum_halaman) {
                if (isset($_GET['kategori'])) {
                  echo "<a class='btn btn-outline-primary' href='blog_kategori-".$_GET['kategori']."-halaman-".$sebelum."'><i class='icon-chevron-left'></i> New</a>";
                  echo "<a class='btn btn-outline-primary' href='blog_kategori-".$_GET['kategori']."-halaman-".$setelah."'><i class='icon-chevron-right'></i> Old</a>";
                } elseif(isset($_GET['bulan']) && isset($_GET['tahun'])) {
                  echo "<a class='btn btn-outline-primary' href='blog_bulan-".$_GET['bulan']."-tahun-".$_GET['tahun']."-halaman-".$sebelum."'><i class='icon-chevron-left'></i> New</a>";
                  echo "<a class='btn btn-outline-primary' href='blog_bulan-".$_GET['bulan']."-tahun-".$_GET['tahun']."-halaman-".$setelah."'><i class='icon-chevron-right'></i> Old</a>";
                } else {
                    echo "<a class='btn btn-outline-primary' href='blog-halaman-".$sebelum."'> <i class='icon-chevron-left'></i> New </a>";
                    echo "<a class='btn btn-outline-primary' href='blog-halaman-".$setelah."'><i class='icon-chevron-right'></i> Old</a>";
                }
              }
            }
            ?>
        
            </nav>
      
          </div><!-- /.blog-main -->
      
          <aside class="col-md-3 blog-sidebar">
      
            <div class="p-4">
              <h4 class="font-italic">Categories</h4>
              <ol class="list-unstyled mb-0">
                <?php
                $sql_kategori_blog = "select kategori_blog.*
                from blog 
                INNER JOIN kategori_blog ON blog.id_kategori_blog = kategori_blog.id_kategori_blog 
                INNER JOIN user ON blog.id_user = user.id_user";
                $data_kategori_blog = getDataUser($koneksi, $sql_kategori_blog);
                $data_kat_array = array();
                foreach ($data_kategori_blog as $key => $value){
                  if(!in_array($value, $data_kat_array))
                    $data_kat_array[$key]=$value;
                }
                foreach ($data_kat_array as $kategori_blog) {
                    ?>
                    <li><a href="blog_kategori-<?= $kategori_blog['kategori_blog'] ?>"><?= $kategori_blog['kategori_blog'] ?></a></li>
                <?php
                } ?>
                </ol>
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
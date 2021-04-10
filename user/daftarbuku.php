<?php
          $batas = 12;
          $sql_jum = "select * 
                  from buku 
                  INNER JOIN kategori_buku ON buku.id_kategori_buku = kategori_buku.id_kategori_buku";
          if (isset($_GET['kategori'])) {
            $kategori_blog = $_GET['kategori'];
            $sql_id_kategori_blog = "select id_kategori_blog from kategori_blog where kategori_blog='$kategori_blog'";
            $id_kategori_blog = getDataUser($koneksi, $sql_id_kategori_blog);
            if ($id_kategori_blog) {
                $sql_jum .= " WHERE blog.id_kategori_blog=".$id_kategori_blog[0]['id_kategori_blog'];
            }
          } elseif(isset($_GET['tag'])) {
            // $bulan = $_GET['bulan'];
            // $tahun = $_GET['tahun'];
            // $sql_jum .= " WHERE YEAR(blog.tanggal) = '$tahun' AND MONTH(blog.tanggal) = '$bulan'";
          }

          $sql_jum .= " order by `judul`";
          $query_jum = mysqli_query($koneksi, $sql_jum);
          $jum_data = mysqli_num_rows($query_jum);
          $jum_halaman = ceil($jum_data/$batas);

          if (!isset($_GET['halaman'])) {
              $posisi = 0;
              $halaman = 1;
          } else {
              $halaman = $_GET['halaman'];
              $posisi = ($halaman-1) * $batas;
          }
          $sql = "select buku.*, kategori_buku.*, penerbit.*
          from buku 
          INNER JOIN kategori_buku ON buku.id_kategori_buku = kategori_buku.id_kategori_buku
          INNER JOIN penerbit ON buku.id_penerbit = penerbit.id_penerbit";
          if(isset($_GET['kategori'])) {
            $sql .=" where buku.id_kategori_buku=".$_GET['kategori'];
          } else if(isset($_GET['tag'])) {
            $sql_cari_id_buku = "select id_buku from tag_buku where id_tag='".$_GET['tag']."'";
            $id_buku = getDataUser($koneksi, $sql_cari_id_buku);
            $sql .=" where";
            for ($i=0; $i < count($id_buku) - 1; $i++) { 
              $sql .=" buku.id_buku=".$id_buku[$i]['id_buku']." OR";
            }
            $sql .=" buku.id_buku=".$id_buku[count($id_buku) - 1]['id_buku'];
          }
          $sql .=" ORDER BY `judul` limit $posisi, $batas";
          $data_buku = getDataUser($koneksi, $sql);
          ?>
    <section id="blog-header">
      <div class="container">
        <h1 class="text-white">DAFTAR BUKU</h1>
      </div>
    </section><br><br>
    
    <section id="katalog-item">
      <main role="main" class="container">
        <h2 class="text-primary"><?php if(isset($_GET['kategori'])) {
          $sql_kategori = "select * from kategori_buku where id_kategori_buku='".$_GET['kategori']."'";
          $kategori = getDataUser($koneksi, $sql_kategori);
          echo "CATEGORIES: ".$kategori[0]['kategori_buku'];
        } else if(isset($_GET['tag'])) {
          $sql_tag = "select * from tag where id_tag='".$_GET['tag']."'";
          $tag = getDataUser($koneksi, $sql_tag);
          echo "TAGS: ".$tag[0]['tag'];
        } else if(isset($_SESSION['search'])) {
          echo "Hasil Pencari: ".$_SESSION['search'];
        } else {
          echo "";
        } ?></h2><br><br>
        <div class="row">
          <div class="col-md-9 katalog-main">
          <div class="row">
          <?php
              foreach ($data_buku as $buku) {
              ?>
              <div class="col-md-4">
                <div class="card mb-4 shadow-sm">
                  <img src="admin/cover/<?= $buku['cover'] ?>" class="img-fluid" alt="Books Collection" title="<?= $buku['judul'] ?>" style="width: 250px; height: 300px;">
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
            <div class="col-sm-12">
                <nav aria-label="Page navigation">
                    <ul class="pagination">
                    <?php
              if ($jum_halaman==0) {
                  //tidak ada halaman
              } elseif ($jum_halaman==1) {
                  echo "<li class='page-item'><a class='page-link'>1</a></li>";
              } else {
                  $sebelum = $halaman-1;
                  $setelah = $halaman+1;
                  if (isset($_SESSION["katakunci"])) {
                      $katakunci_kategori = $_SESSION["katakunci"];
                      if ($halaman!=1) {
                          echo "<li class='page-item'>
              <a class='page-link'
              href='daftar-buku-halaman-1'>First</a></li>";
                          echo "<li class='page-item'><a class='page-link'
              href='daftar-buku-halaman-$sebelum'>
              «</a></li>";
                      }
                      for ($i=1; $i<=$jum_halaman; $i++) {
                          if ($i!=$halaman) {
                              echo "<li class='page-item'><a class='page-link'
              href='daftar-buku-halaman-$i'>$i</a></li>";
                          } else {
                              echo "<li class='page-item'>
              <a class='page-link'>$i</a></li>";
                          }
                      }
                      if ($halaman!=$jum_halaman) {
                          echo "<li class='page-item'>
              <a class='page-link'
              href='daftar-buku-halaman-$setelah'>»</a></li>";
                          echo "<li class='page-item'><a class='page-link'
              href='daftar-buku-halaman-$jum_halaman'>
              Last</a></li>";
                      }
                  } else {
                      if ($halaman!=1) {
                          echo "<li class='page-item'><a class='page-link'
              href='daftar-buku-halaman-1'>First</a></li>";
                          echo "<li class='page-item'><a class='page-link'
              href='daftar-buku-halaman-$sebelum'>«</a></li>";
                      }
                      for ($i=1; $i<=$jum_halaman; $i++) {
                          if ($i!=$halaman) {
                              echo "<li class='page-item'><a class='page-link'
              href='daftar-buku-halaman-$i'>$i</a></li>";
                          } else {
                              echo "<li class='page-item'><a class='page-link'>$i</a></li>";
                          }
                      }
                      if ($halaman!=$jum_halaman) {
                          echo "<li class='page-item'><a class='page-link'
              href='daftar-buku-halaman-$setelah'>
              »</a></li>";
                          echo "<li class='page-item'><a class='page-link'
              href='daftar-buku-halaman-$jum_halaman'>Last</a></li>";
                      }
                  }
              }?>
                  </ul>
                </nav>
            </div>  

            </div><!-- .row-->
          </div><!-- /.katalog-main -->
      
          <aside class="col-md-3 katalog-sidebar">
      
            <div class="pl-4 pb-4">
              <h4 class="font-italic">Kategori</h4>
              <ol class="list-unstyled mb-0">
              <?php
                $sql_kategori_buku = "select kategori_buku.*
                from buku 
                INNER JOIN kategori_buku ON buku.id_kategori_buku = kategori_buku.id_kategori_buku
                INNER JOIN penerbit ON buku.id_penerbit = penerbit.id_penerbit";
                $data_kategori_buku = getDataUser($koneksi, $sql_kategori_buku);
                $result = array();
                foreach ($data_kategori_buku as $key => $value){
                  if(!in_array($value, $result))
                    $result[$key]=$value;
                }
                foreach ($result as $kategori_buku) {
                    ?>
                    <li><a href="daftar-buku_kategori-<?= $kategori_buku['id_kategori_buku'] ?>"><?= $kategori_buku['kategori_buku'] ?></a></li>
                <?php
                } ?>
                </ol>
            </div>
      
            <div class="p-4">
              <h4 class="font-italic">Tag</h4>
              <ol class="list-unstyled">
              <?php
                $sql_tag = "select tag.* from tag_buku
                INNER JOIN tag ON tag_buku.id_tag = tag.id_tag";
                $data_tag = getDataUser($koneksi, $sql_tag);
                $data_tag_array = array();
                foreach ($data_tag as $key => $value){
                  if(!in_array($value, $data_tag_array))
                    $data_tag_array[$key]=$value;
                }
                foreach ($data_tag_array as $tag) {
                    ?>
                    <li><a href="daftar-buku_tag-<?= $tag['id_tag'] ?>"><?= $tag['tag'] ?></a></li>
                <?php
                } ?>
              </ol>
            </div>
          </aside> <!-- /.katalog-sidebar -->
      
        </div><!-- /.row -->
      </main><!-- /.container -->
    </section><br><br>
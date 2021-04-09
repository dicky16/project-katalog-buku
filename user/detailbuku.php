    <section id="blog-header">
      <div class="container">
        <h1 class="text-white">DETAIL KATALOG</h1>
      </div>
    </section><br><br>
    <section id="katalog-wrapper">
      <main role="main" class="container">
        <div class="row">
        <?php 
            $sql = "select buku.*, kategori_buku.kategori_buku, penerbit.penerbit
            from `buku` 
            INNER JOIN kategori_buku ON buku.id_kategori_buku = kategori_buku.id_kategori_buku 
            INNER JOIN penerbit ON buku.id_penerbit = penerbit.id_penerbit
            WHERE id_buku='".$_GET['id']."'";
            $data_detailbuku = getDataUser($koneksi, $sql); ?>
          <div class="col-md-9 katalog-detail">
            <div class="table-responsive">
              <table class="table table-bordered">
                <tr>
                  <td width="40%" rowspan="6"><img src="admin/cover/<?= $data_detailbuku[0]['cover'] ?>" class="img-fluid" alt="Books Collection" title="Books"></td>
                  <td colspan="2"><?= $data_detailbuku[0]['judul'] ?></td>
                </tr>
                <tr>
                  <td width="17%"><strong>Penulis</strong></td>
                  <td width="43%"><?= $data_detailbuku[0]['pengarang'] ?></td>
                </tr>
                <tr>
                  <td><strong>Penerbit</strong></td>
                  <td><?= $data_detailbuku[0]['penerbit'] ?></td>
                </tr>
                <tr>
                  <td><strong>Tahun Terbit</strong></td>
                  <td><?= $data_detailbuku[0]['tahun_terbit'] ?></td>
                </tr>
                <tr>
                  <td><strong>Kategori Buku</strong></td>
                  <td><?= $data_detailbuku[0]['kategori_buku'] ?></td>
                </tr>
                <tr>
                
                  <td><strong>Tag</strong></td>
                  <td>
                  <?php $sql_tag="select tag.tag from tag_buku inner join tag on tag_buku.id_tag = tag.id_tag
                where tag_buku.id_buku='".$_GET['id']."'";
                $data_tag= getDataUser($koneksi, $sql_tag);
                foreach ($data_tag as $tag) {?>
                  <a href="#"><?= $tag['tag'] ?>,</a>
                <?php }
                ?>
                  
                  </td>
                </tr>
                <tr>
                  <td colspan="3">
                    <h5>Sinopsis</h5>
                    <?= $data_detailbuku[0]['sinopsis'] ?>
                  </td>
                </tr>
              </table>
            </div><!-- .table-responsive --> 
          </div><!-- /.blog-main -->
          <aside class="col-md-3 katalog-sidebar">
      
            
           <div class="pl-4 pb-4">
              <h4 class="font-italic">Buku Terkait</h4>
              <ol class="list-unstyled mb-0">
                <li><a href="#">Data Mining</a></li>
                <li><a href="#">Implementasi Neural Network</a></li>
                <li><a href="#">Deep Learning untuk Machine Learning</a></li>
                <li><a href="#">Python untuk Machine Learning</a></li>
              </ol>
            </div>

            <div class="pl-4 pb-4">
              <h4 class="font-italic">Categories</h4>
              <ol class="list-unstyled mb-0">
                <li><a href="#">Umum</a></li>
                <li><a href="#">PHP</a></li>
                <li><a href="#">Java</a></li>
                <li><a href="#">Database</a></li>
                <li><a href="#">Techno</a></li>
            </div>
      
            <div class="p-4">
              <h4 class="font-italic">Tag</h4>
              <ol class="list-unstyled">
                <li><a href="#">PHP</a></li>
                <li><a href="#">MySQL</a></li>
                <li><a href="#">Javascript</a></li>
              </ol>
            </div>
          </aside><!-- /.blog-sidebar -->
      
        </div><!-- /.row -->
        
      </main><!-- /.container -->
    </section><br><br>
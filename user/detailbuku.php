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
                  <?php $sql_tag="select tag.* from tag_buku inner join tag on tag_buku.id_tag = tag.id_tag
                where tag_buku.id_buku='".$_GET['id']."'";
                $data_tag= getDataUser($koneksi, $sql_tag);
                foreach ($data_tag as $tag) {?>
                  <a href="daftar-buku_tag-<?= $tag['id_tag'] ?>"><?= $tag['tag'] ?>,</a>
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
              <?php 
              $sql_tag_buku="select id_buku from tag_buku inner join tag on tag_buku.id_tag = tag.id_tag";
              $sql_tag_buku .=" where";
              for ($i=0; $i < count($data_tag) - 1; $i++) { 
                $sql_tag_buku .=" tag_buku.id_tag=".$data_tag[$i]['id_tag']." OR";
              }
              $sql_tag_buku .=" tag_buku.id_tag=".$data_tag[count($data_tag) - 1]['id_tag'];
              $id_buku= getDataUser($koneksi, $sql_tag_buku);
              // var_dump($id_buku); die;
              $sql_buku_terkait = "select buku.*, kategori_buku.kategori_buku, penerbit.penerbit
              from `buku` 
              INNER JOIN kategori_buku ON buku.id_kategori_buku = kategori_buku.id_kategori_buku 
              INNER JOIN penerbit ON buku.id_penerbit = penerbit.id_penerbit";
              $data_buku_terkait = getDataUser($koneksi, $sql_buku_terkait);
              $sql_buku_terkait .=" where";
              for ($i=0; $i < count($id_buku) - 1; $i++) { 
                $sql_buku_terkait .=" buku.id_buku=".$id_buku[$i]['id_buku']." OR";
              }
              $sql_buku_terkait .=" buku.id_buku=".$id_buku[count($id_buku) - 1]['id_buku'];
              $sql_buku_terkait .=" ORDER BY `judul` limit 6";
              $data_buku_terkait = getDataUser($koneksi, $sql_buku_terkait);
              // var_dump($data_buku_terkait); die;
              foreach ($data_buku_terkait as $buku_terkait) {
                if (isset($_GET['id'])) {
                    if ($_GET['id'] == $buku_terkait['id_buku']) {
                    } else {
                        ?>
                  <li><a href="detail-buku-id-<?= $buku_terkait['id_buku'] ?>"><?= $buku_terkait['judul'] ?></a></li>
              <?php
                    }
                }
              }  ?>
              </ol>
            </div>

            <div class="pl-4 pb-4">
              <h4 class="font-italic">Categories</h4>
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
          </aside><!-- /.blog-sidebar -->
      
        </div><!-- /.row -->
        
      </main><!-- /.container -->
    </section><br><br>
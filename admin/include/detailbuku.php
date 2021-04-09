<!DOCTYPE html>
<html>
<head>
<?php include("includes/head.php") ?> 
<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "select `id_buku`, `kategori_buku`, `judul`, `pengarang`, `penerbit`, `tahun_terbit`, `sinopsis`, `cover` 
                  from `buku` 
                  INNER JOIN kategori_buku ON buku.id_kategori_buku = kategori_buku.id_kategori_buku 
                  INNER JOIN penerbit ON buku.id_penerbit = penerbit.id_penerbit
                  WHERE `id_buku`='$id'";
    $query_d = mysqli_query($koneksi, $sql);
    while ($data_d = mysqli_fetch_row($query_d)) {
        $data[] = $data_d;
    }
$tag = null;
    $select = "SELECT `tag` FROM `tag_buku` `tb`
    INNER JOIN tag t ON tb.id_tag = t.id_tag
    WHERE `id_buku`='$id' order by `tag`";
    $query_tag = mysqli_query($koneksi, $select);
    while ($data_tag = mysqli_fetch_row($query_tag)) {
        $tag[] = $data_tag;
    }
}

?>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
<?php include("includes/header.php") ?>

  <?php include("includes/sidebar.php") ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3><i class="fas fa-user-tie"></i> Detail Data Buku</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="profil">Home</a></li>
              <li class="breadcrumb-item"><a href="buku">Data Buku</a></li>
              <li class="breadcrumb-item active">Detail Data Buku</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
            <div class="card">
              <div class="card-header">
                <div class="card-tools">
                  <a href="buku" class="btn btn-sm btn-warning float-right">
                  <i class="fas fa-arrow-alt-circle-left"></i> Kembali</a>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                    <tbody>                      
                      <tr>
                        <td><strong>Cover Buku<strong></td>
                        <td><img src="cover/<?= $data[0][7] ?>" class="img-fluid" width="200px;"></td>
                      </tr>               
                      <tr>
                        <td width="20%"><strong>Kategori Buku<strong></td>
                        <td width="80%"><?= $data[0][1] ?></td>
                      </tr>                 
                      <tr>
                        <td width="20%"><strong>Judul<strong></td>
                        <td width="80%"><?= $data[0][2] ?></td>
                      </tr>                 
                      <tr>
                        <td width="20%"><strong>Pengarang<strong></td>
                        <td width="80%"><?= $data[0][3] ?></td>
                      </tr>
                      <tr>
                        <td width="20%"><strong>Tahun Terbit<strong></td>
                        <td width="80%"><?= $data[0][5] ?></td>
                      </tr>
                      <tr>
                        <td><strong>Tag<strong></td>
                        <td>
                          <ul>
                          <?php
                          if ($tag) {
                              for ($i=0; $i < count($tag); $i++) { ?>
                            <li><?= $tag[$i][0] ?></li>
                          <?php
                          }
                          } else { ?>
                            <li>Tidak ada tag</li>
                          <?php }
                          ?>
                          </ul>
                        </td>
                      </tr>
                      <tr>
                        <td width="20%"><strong>Sinopsis<strong></td>
                        <td width="80%">Lorem Ipsum is simply dummy text of the printing and typesetting 
                        industry. Lorem Ipsum has been the industry's standard dummy text ever since the 
                        1500s, when an unknown printer took a galley of type and scrambled it to make 
                        a type specimen book. It has survived not only five centuries, but also the 
                        leap into electronic typesetting, remaining essentially unchanged. It was popularised 
                        in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, 
                        and more recently with desktop publishing software like Aldus PageMaker including
                         versions of Lorem Ipsum.</td>
                      </tr> 
                    </tbody>
                  </table>  
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">&nbsp;</div>
            </div>
            <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include("includes/footer.php") ?>

</div>
<!-- ./wrapper -->

<?php include("includes/script.php") ?>
</body>
</html>

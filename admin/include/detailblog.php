<!DOCTYPE html>
<html>
<head>
<?php include("../koneksi/koneksi.php");
 $sql_blog = "select id_blog, kategori_blog.kategori_blog, `judul`, `isi`, `tanggal`, user.nama 
 from blog 
 INNER JOIN kategori_blog ON blog.id_kategori_blog = kategori_blog.id_kategori_blog 
 INNER JOIN user ON blog.id_user = user.id_user
 where id_blog='".$_GET['id']."' ";
 $query_blog = mysqli_query($koneksi, $sql_blog);
 while ($data_blog = mysqli_fetch_row($query_blog)) {
     $data_blog_detail = $data_blog;
 }
 ?>
<?php include("includes/head.php") ?> 
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
            <h3><i class="fas fa-user-tie"></i> Detail Data Blog</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="blog">Data Blog</a></li>
              <li class="breadcrumb-item active">Detail Data Blog</li>
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
                  <a href="blog" class="btn btn-sm btn-warning float-right">
                  <i class="fas fa-arrow-alt-circle-left"></i> Kembali</a>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                    <tbody>                 
                      <tr>
                        <td width="20%"><strong>Tanggal<strong></td>
                        <td width="80%"><?= $data_blog_detail[4] ?></td>
                      </tr>              
                      <tr>
                        <td width="20%"><strong>Kategori Blog<strong></td>
                        <td width="80%"><?= $data_blog_detail[1] ?></td>
                      </tr>                 
                      <tr>
                        <td width="20%"><strong>Judul<strong></td>
                        <td width="80%"><?= $data_blog_detail[2] ?></td>
                      </tr> 
                      <tr>
                        <td width="20%"><strong>Penulis<strong></td>
                        <td width="80%"><?= $data_blog_detail[5] ?></td>
                      </tr>
                      <tr>
                        <td width="20%"><strong>Isi<strong></td>
                        <td width="80%"><?= $data_blog_detail[3] ?></td>
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

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
     $data_blog_edit = $data_blog;
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
            <h3><i class="fas fa-edit"></i> Edit Data Blog</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="blog.php">Data Blog</a></li>
              <li class="breadcrumb-item active">Edit Data Blog</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title"style="margin-top:5px;"><i class="far fa-list-alt"></i> Form Edit Data Blog</h3>
        <div class="card-tools">
          <a href="blog.php" class="btn btn-sm btn-warning float-right">
          <i class="fas fa-arrow-alt-circle-left"></i> Kembali</a>
        </div>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      </br></br>
      <div class="col-sm-10">
      <?php if ((!empty($_GET['notif']))&&(!empty($_GET['jenis']))) {?>
      <?php if ($_GET['notif']=="editkosong") {?>
      <div class="alert alert-danger" role="alert">Maaf data
      <?php echo $_GET['jenis'];?> wajib di isi</div>
      <?php }?>
      <?php }?>
      </div>
      <form class="form-horizontal">
        <div class="card-body">
          
        <div class="form-group row">
            <label for="kategori" class="col-sm-3 col-form-label">Kategori Blog</label>
            <div class="col-sm-7">
              <select class="form-control" id="kategori">
                <option value="0">- Pilih Kategori -</option>
                <?php
              $check_kategori = '';
              $sql_kategori_blog = "select `id_kategori_blog`,`kategori_blog` from `kategori_blog`";
              $query_kategori_blog = mysqli_query($koneksi, $sql_kategori_blog);
              while ($data_kategori_blog = mysqli_fetch_row($query_kategori_blog)) {
                  if (isset($_SESSION['id_kategori'])) {
                      if ($_SESSION['id_kategori'] == $data_kategori_blog[0]) {
                          $check_kategori = 'selected';
                      }
                  } elseif (!empty($data_blog_edit[0][0])) {
                      if ($data_blog_edit[0]==$data_kategori_blog[0]) {
                          $check_kategori = 'selected';
                      }
                  } ?>
                <option value="<?= $data_kategori_blog[0] ?>" <?= $check_kategori ?> ><?= $data_kategori_blog[1] ?></option>
                <?php
                $check_kategori = '';
              } ?>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="nim" class="col-sm-3 col-form-label">Judul</label>
            <div class="col-sm-7">
              <input type="text" class="form-control" name="nim" id="nim" value="<?= $data_blog_edit[2] ?>">
            </div>
          </div>
          <div class="form-group row">
            <label for="isi" class="col-sm-3 col-form-label">Isi</label>
            <div class="col-sm-7">
              <textarea class="form-control" name="isi" id="editor1" rows="12"><?= $data_blog_edit[3] ?></textarea>
            </div>
          </div>

          </div>
        </div>

      </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <div class="col-sm-12">
            <button type="submit" class="btn btn-info float-right" name="updateblog"><i class="fas fa-save"></i> Simpan</button>
          </div>  
        </div>
        <!-- /.card-footer -->
      </form>
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

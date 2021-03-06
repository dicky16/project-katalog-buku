<!DOCTYPE html>
<html>
<head>
<?php include("includes/head.php") ?> 
<?php 
include("../koneksi/koneksi.php");
if(isset($_GET['id'])) {
  if(is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    $sql_d = "select `kategori_blog` from `kategori_blog` where `id_kategori_blog`='$id'";
    $query_d = mysqli_query($koneksi,$sql_d);
    while($data_d = mysqli_fetch_row($query_d)){
      $kategori = $data_d[0];
    }
  } else {
    echo "Hayo mau ngapain :D"; die;
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
            <h3><i class="fas fa-edit"></i> Edit Kategori Blog</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="katgoriblog.php">Kategori Blog</a></li>
              <li class="breadcrumb-item active">Edit Kategori Blog</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title"style="margin-top:5px;"><i class="far fa-list-alt"></i> Form Edit Kategori Blog</h3>
        <div class="card-tools">
          <a href="kategoriblog.php" class="btn btn-sm btn-warning float-right">
          <i class="fas fa-arrow-alt-circle-left"></i> Kembali</a>
        </div>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      </br>
      <div class="col-sm-10">
      <?php if(isset($_GET['notif'])) {
        if($_GET['notif'] == "editkosong") { ?>
          <div class="alert alert-danger" role="alert">Maaf data kategori blog wajib di isi</div>
          <?php }} ?>
      </div>
      <form class="form-horizontal" method="POST" action="konfirmasikategoriblog.php?id=<?= $id ?>">
        <div class="card-body">
          <div class="form-group row">
            <label for="Kategori Blog" class="col-sm-3 col-form-label">Kategori Blog</label>
            <div class="col-sm-7">
              <input type="text" class="form-control" name="kategoriblog" value="<?= $kategori ?>">
            </div>
          </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <div class="col-sm-10">
            <button type="submit" class="btn btn-info float-right" name="updatekategoriblog"><i class="fas fa-save"></i> Simpan</button>
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

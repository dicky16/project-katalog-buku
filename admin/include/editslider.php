<?php
if(isset($_GET['id'])) {
    $sql = "select * from slider where id = '".$_GET['id']."'";
    $data = getDataUser($koneksi, $sql);
}

?>
<!DOCTYPE html>
<html>
<head>
<?php
include("includes/head.php");
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
            <h3><i class="fas fa-plus"></i> Edit Slider</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="slide">Data Slider</a></li>
              <li class="breadcrumb-item active">Edit Slider</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title"style="margin-top:5px;"><i class="far fa-list-alt"></i> Form Edit Data Slider</h3>
        <div class="card-tools">
          <a href="slide" class="btn btn-sm btn-warning float-right">
          <i class="fas fa-arrow-alt-circle-left"></i> Kembali</a>
        </div>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      </br></br>
      <div class="col-sm-10">
      <?php if ((!empty($_SESSION['notif']))&&(!empty($_SESSION['jenis']))) {?>
      <?php if ($_SESSION['notif']=="tambahkosong") {?>
      <div class="alert alert-danger" role="alert">Maaf data
      <?php echo $_SESSION['jenis'];?> wajib di isi</div>
      <?php }?>
      <?php }?>
      </div>
      <form class="form-horizontal" method="POST" action="konfirmasi-slide-id-<?= $data[0]['id'] ?>" enctype="multipart/form-data">
        <div class="card-body">
          
          <div class="form-group row">
            <label for="foto" class="col-sm-3 col-form-label">Gambar Slider </label>
            <div class="col-sm-7">
              <div class="custom-file">
                <input type="file" class="custom-file-input" name="gambar" id="customFile">
                <label class="custom-file-label" for="customFile">Choose file</label>
              </div>  
            </div>
          </div>
          
          <div class="form-group row">
            <label for="nim" class="col-sm-3 col-form-label">Label</label>
            <div class="col-sm-7">
              <input type="text" class="form-control" name="label" id="nim" value="<?php echo isset($_SESSION['label']) ? $_SESSION['label'] : $data[0]['label']; ?>">
            </div>
          </div>
          <div class="form-group row">
            <label for="sinopsis" class="col-sm-3 col-form-label">Isi</label>
            <div class="col-sm-7">
              <textarea class="form-control" name="isi" id="editor1" rows="12"><?= isset($_SESSION['isi']) ? $_SESSION['isi'] : $data[0]['isi'] ?></textarea>
            </div>
          </div>          
          </div>
        </div>

      </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <div class="col-sm-12">
            <button type="submit" class="btn btn-info float-right" name="updateslider"><i class="fas fa-plus"></i> Update</button>
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
<?php
unset($_SESSION['notif']);
unset($_SESSION['jenis']);
?>
<?php include("includes/script.php") ?>
</body>
</html>

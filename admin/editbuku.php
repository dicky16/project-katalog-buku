<!DOCTYPE html>
<html>
<head>
<?php include("../koneksi/koneksi.php");
 $sql_buku = "select `id_buku`, `id_kategori_buku`,`kategori_buku`, `judul`, `pengarang`, `penerbit`, `tahun_terbit`, `sinopsis`, `cover` 
 from `buku` 
 INNER JOIN kategori_buku ON buku.id_kategori_buku = kategori_buku.id_kategori_buku 
 INNER JOIN penerbit ON buku.id_penerbit = penerbit.id_penerbit
 where id_buku='".$_GET['id']."' ";
 $query_buku = mysqli_query($koneksi, $sql_buku);
 while($data_buku = mysqli_fetch_row($query_buku)) {
   $data_buku= $data_buku;
   //var_dump($data_buku[1]);
   //die;
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
            <h3><i class="fas fa-edit"></i> Edit Data Buku</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="buku.php">Data Buku</a></li>
              <li class="breadcrumb-item active">Edit Data Buku</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title"style="margin-top:5px;"><i class="far fa-list-alt"></i> Form Edit Data Buku</h3>
        <div class="card-tools">
          <a href="buku.php" class="btn btn-sm btn-warning float-right">
          <i class="fas fa-arrow-alt-circle-left"></i> Kembali</a>
        </div>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      </br></br>
      <div class="col-sm-10">
          <div class="alert alert-danger" role="alert">Maaf judul wajib di isi</div>
      </div>
      <form class="form-horizontal" method="POST" action="konfirmasibuku.php" enctype="multipart/form-data">
        <div class="card-body">
          
        <div class="form-group row">
            <label for="foto" class="col-sm-3 col-form-label">Cover Buku </label>
            <div class="col-sm-7">
              <div class="custom-file">
                <input type="file" class="custom-file-input" name="cover" id="customFile">
                <label class="custom-file-label" for="customFile">Choose file</label>
              </div>  
            </div>
          </div>
          <div class="form-group row">
            <label for="kategori" class="col-sm-3 col-form-label">Kategori Buku</label>
            <div class="col-sm-7">
              <select class="form-control" id="kategori">
                <option value="0">- Pilih Kategori -</option>
                <?php
              $check_kategori = '';
              $sql_kategori_buku = "select `id_kategori_buku`,`kategori_buku` from `kategori_buku`";
              $query_kategori_buku = mysqli_query($koneksi, $sql_kategori_buku);
              while ($data_kategori_buku = mysqli_fetch_row($query_kategori_buku)) {
                //var_dump($data_buku[0][1]);
                //die;

                if ($data_buku[1]==$data_kategori_buku[0]){
                  $check_kategori = 'selected';
                }  
                if (isset($_SESSION['id_kategori'])) {
                      if ($_SESSION['id_kategori'] == $data_kategori_buku[0]) {
                          $check_kategori = 'selected';
                      }
                  } ?>
                <option value="<?= $data_kategori_buku[0] ?>" <?= $check_kategori ?> ><?= $data_kategori_buku[1] ?></option>
                <?php
                $check_kategori = '';
              } ?>
                            </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="nim" class="col-sm-3 col-form-label">Judul</label>
            <div class="col-sm-7">
              <input type="text" class="form-control" name="nim" id="nim" value="PHP7">
            </div>
          </div>
          <div class="form-group row">
            <label for="pengarang" class="col-sm-3 col-form-label">Pengarang</label>
            <div class="col-sm-7">
              <input type="text" class="form-control" name="pengarang" id="pengarang" value="Berta">
            </div>
          </div>
          <div class="form-group row">
            <label for="kategori" class="col-sm-3 col-form-label">Penerbit</label>
            <div class="col-sm-7">
              <select class="form-control" id="kategori">
                <option value="0">- Pilih penerbit -</option>
                <option value="Andi" selected>Andi</option>
                <option value="Lokomedia">Lokomedia</option>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="tahun_terbit" class="col-sm-3 col-form-label">Tahun Terbit</label>
            <div class="col-sm-7">
              <input type="number" class="form-control" name="tahun_terbit" id="tahun_terbit" value="2019">
            </div>
          </div>
          <div class="form-group row">
            <label for="sinopsis" class="col-sm-3 col-form-label">Sinopsis</label>
            <div class="col-sm-7">
              <textarea class="form-control" name="sinopsis" id="editor1" rows="12">Lorem Ipsum</textarea>
            </div>
          </div>          
          <div class="form-group row">
            <label for="hobi" class="col-sm-3 col-form-label">Tag</label>
            <div class="col-sm-7">
              <input type="checkbox"  name="PHP"> PHP </br>
              <input type="checkbox"  name="MySQL" checked> MySQL
            </div>
          </div>

          </div>
        </div>

      </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <div class="col-sm-12">
            <button type="submit" class="btn btn-info float-right" name="updatebuku"><i class="fas fa-save"></i> Simpan</button>
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

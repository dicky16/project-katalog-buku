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
            <h3><i class="fas fa-plus"></i> Tambah Buku</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="buku">Data Buku</a></li>
              <li class="breadcrumb-item active">Tambah Buku</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title"style="margin-top:5px;"><i class="far fa-list-alt"></i> Form Tambah Data Buku</h3>
        <div class="card-tools">
          <a href="buku" class="btn btn-sm btn-warning float-right">
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
      <form class="form-horizontal" method="POST" action="konfirmasi-buku" enctype="multipart/form-data">
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
              <select class="form-control" name="kategori_buku">
              <option value="0">- Pilih Kategori Buku -</option>
              <?php
              $check_kategori = '';
              $sql_kategori_buku = "select `id_kategori_buku`,`kategori_buku` from `kategori_buku`";
              $query_kategori_buku = mysqli_query($koneksi, $sql_kategori_buku);
              while ($data_kategori_buku = mysqli_fetch_row($query_kategori_buku)) {
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
              <input type="text" class="form-control" name="judul" id="nim" value="<?php echo isset($_SESSION['judul']) ? $_SESSION['judul'] : ''; ?>">
            </div>
          </div>
          <div class="form-group row">
            <label for="pengarang" class="col-sm-3 col-form-label">Pengarang</label>
            <div class="col-sm-7">
              <input type="text" class="form-control" name="pengarang" id="pengarang" value="<?php echo isset($_SESSION['pengarang']) ? $_SESSION['pengarang'] : ''; ?>">
            </div>
          </div>
          <div class="form-group row">
            <label for="kategori" class="col-sm-3 col-form-label">Penerbit</label>
            <div class="col-sm-7">
              <select class="form-control" name="penerbit">
              <option value="0">- Pilih penerbit -</option>
              <?php
              $check_penerbit = '';
              $sql_penerbit = "select `id_penerbit`,`penerbit` from `penerbit`";
              $query_penerbit = mysqli_query($koneksi, $sql_penerbit);
              while ($data_penerbit = mysqli_fetch_row($query_penerbit)) {
                  if (isset($_SESSION['penerbit'])) {
                      if ($_SESSION['penerbit'] == $data_penerbit[0]) {
                          $check_penerbit = 'selected';
                      }
                  } ?>
                <option value="<?= $data_penerbit[0] ?>" <?= $check_penerbit ?> ><?= $data_penerbit[1] ?></option>
                <?php
                $check_penerbit = '';
              } ?>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="tanggal" class="col-sm-3 col-form-label">Tahun Terbit</label>
            <div class="col-sm-7">
              <div class="input-group date">
                <input type="text" class="form-control" name="tahun" id="datepicker-year"  autocomplete="off"
                value="<?php echo isset($_SESSION['tahun_terbit']) ? $_SESSION['tahun_terbit'] : ''; ?>">
                  <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                  </div>
              </div>
            </div>
          </div>
          <div class="form-group row">
            <label for="sinopsis" class="col-sm-3 col-form-label">Sinopsis</label>
            <div class="col-sm-7">
              <textarea class="form-control" name="sinopsis" id="editor1" rows="12"><?= isset($_SESSION['sinopsis']) ? $_SESSION['sinopsis'] : '' ?></textarea>
            </div>
          </div>          
          <div class="form-group row">
            <label for="hobi" class="col-sm-3 col-form-label">Tag</label>
            <div class="col-sm-7">
            <table>
            <tr>
            <?php
              $kolom = 3;
              $i = 0;
              $check = '';
              $sql_tag = "select `id_tag`,`tag` from `tag`";
                $query_tag = mysqli_query($koneksi, $sql_tag);
                while ($data_tag = mysqli_fetch_row($query_tag)) {
                    if ($i >= $kolom) {
                        echo "<tr></tr>";
                        $i = 0;
                    }
                    $i++;
                    if (isset($_SESSION['tag'])) {
                        for ($k=0; $k < count($_SESSION['tag']); $k++) {
                            if ($_SESSION['tag'][$k] == $data_tag[0]) {
                                $check = 'checked';
                            }
                        }
                    } ?>
                  <td><input type="checkbox"  name="tag[]" value="<?= $data_tag[0] ?>" <?= $check ?>> <?= $data_tag[1] ?></td>
              <?php
                $check = '';
                }
              ?>
            </tr>
            </table>
            </div>
          </div>

          </div>
        </div>

      </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <div class="col-sm-12">
            <button type="submit" class="btn btn-info float-right" name="tambahbuku"><i class="fas fa-plus"></i> Tambah</button>
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

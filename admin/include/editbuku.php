<!DOCTYPE html>
<html>
<head>
<?php 
 $sql_buku = "select `id_buku`, `kategori_buku`, `judul`, `pengarang`, `penerbit`, `tahun_terbit`, `sinopsis`, `cover` 
 from `buku` 
 INNER JOIN kategori_buku ON buku.id_kategori_buku = kategori_buku.id_kategori_buku 
 INNER JOIN penerbit ON buku.id_penerbit = penerbit.id_penerbit
 where id_buku='".$_GET['id']."' ";
 $query_buku = mysqli_query($koneksi, $sql_buku);
 while ($data_buku = mysqli_fetch_row($query_buku)) {
     $data_buku_edit = $data_buku;
 }
 $sql_tag_edit = "select `id_buku`, tag_buku.id_tag, `tag` FROM `tag_buku`
 INNER JOIN tag ON tag_buku.id_tag = tag.id_tag 
 where tag_buku.id_buku='".$_GET['id']."'";
 $query_tag_edit = mysqli_query($koneksi, $sql_tag_edit);
 while ($data_tag_e = mysqli_fetch_row($query_tag_edit)) {
     $data_tag_edit[] = $data_tag_e;
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
              <li class="breadcrumb-item"><a href="buku">Data Buku</a></li>
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
          <a href="buku" class="btn btn-sm btn-warning float-right">
          <i class="fas fa-arrow-alt-circle-left"></i> Kembali</a>
        </div>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      </br></br>
      <div class="col-sm-10">
      <?php if ((!empty($_SESSION['notif']))&&(!empty($_SESSION['jenis']))) {?>
      <?php if ($_SESSION['notif']=="editkosong") {?>
      <div class="alert alert-danger" role="alert">Maaf data
      <?php echo $_SESSION['jenis'];?> wajib di isi</div>
      <?php }?>
      <?php }?>
      </div>
      <form class="form-horizontal" method="POST" action="konfirmasi-buku-id-<?= $_GET['id'] ?>" enctype="multipart/form-data">
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
              <select class="form-control" id="kategori" name="kategori_buku">
                <option value="0">- Pilih Kategori -</option>
                <?php
              $check_kategori = '';
              $sql_kategori_buku = "select `id_kategori_buku`,`kategori_buku` from `kategori_buku`";
              $query_kategori_buku = mysqli_query($koneksi, $sql_kategori_buku);
              while ($data_kategori_buku = mysqli_fetch_row($query_kategori_buku)) {
                  if (isset($_SESSION['id_kategori'])) {
                      if ($_SESSION['id_kategori'] == $data_kategori_buku[0]) {
                          $check_kategori = 'selected';
                      }
                  } elseif (isset($_GET['id'])) {
                      if ($data_buku_edit[1]==$data_kategori_buku[1]) {
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
              <input type="text" class="form-control" name="judul" id="nim" value="<?php echo isset($_SESSION['judul']) ? $_SESSION['judul'] : $data_buku_edit[2]; ?>">
            </div>
          </div>
          <div class="form-group row">
            <label for="pengarang" class="col-sm-3 col-form-label">Pengarang</label>
            <div class="col-sm-7">
              <input type="text" class="form-control" name="pengarang" id="pengarang" value="<?php echo isset($_SESSION['pengarang']) ? $_SESSION['pengarang'] : $data_buku_edit[3]; ?>">
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
                  } elseif (isset($_GET['id'])) {
                      if ($data_buku_edit[4]==$data_penerbit[1]) {
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
            <label for="tahun_terbit" class="col-sm-3 col-form-label">Tahun Terbit</label>
            <div class="col-sm-7">
              <input type="number" class="form-control" name="tahun" id="tahun_terbit" value="<?php echo isset($_SESSION['tahun_terbit']) ? $_SESSION['tahun_terbit'] : $data_buku_edit[5]; ?>">
            </div>
          </div>
          <div class="form-group row">
            <label for="sinopsis" class="col-sm-3 col-form-label">Sinopsis</label>
            <div class="col-sm-7">
              <textarea class="form-control" name="sinopsis" id="editor1" rows="12"><?php echo isset($_SESSION['sinopsis']) ? $_SESSION['sinopsis'] : $data_buku_edit[6]; ?></textarea>
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
                    } elseif (isset($_GET['id'])) {
                        for ($t=0; $t < count($data_tag_edit); $t++) {
                            if ($data_tag_edit[$t][2] == $data_tag[1]) {
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
<?php
unset($_SESSION['notif']);
unset($_SESSION['jenis']);
?>
<?php include("includes/script.php") ?>
</body>
</html>

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
            <h3><i class="fas fa-address-book"></i> Kategori Buku</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active"> Kategori Buku</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title" style="margin-top:5px;"><i class="fas fa-list-ul"></i> Daftar  Kategori Buku</h3>
                <div class="card-tools">
                  <a href="tambah-kategori-buku" class="btn btn-sm btn-info float-right"><i class="fas fa-plus"></i> Tambah  Kategori Buku</a>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <div class="col-md-12">
                  <form method="POST" action="set-session">
                    <div class="row">
                        <div class="col-md-4 bottom-10">
                          <input type="hidden" name="tujuan" value="kategori-buku">
                          <input type="text" class="form-control" name="katakunci">
                        </div>
                        <div class="col-md-5 bottom-10">
                          <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i>&nbsp; Search</button>
                        </div>
                    </div><!-- .row -->
                  </form>
                </div><br>
              <div class="col-sm-12">
              <?php if (isset($_SESSION['notif'])) {
              if ($_SESSION['notif'] == "tambahberhasil") { ?>
                <div class="alert alert-success" role="alert">Data Berhasil Ditambahkan</div>
                <?php } elseif ($_SESSION['notif'] == "editberhasil") { ?>
                  <div class="alert alert-success" role="alert">Data Berhasil Diubah</div>
                  <?php }
              } ?>
              </div>
                <table class="table table-bordered">
                  <thead>                  
                    <tr>
                      <th width="5%">No</th>
                      <th width="80%">Kategori Buku</th>
                      <th width="15%"><center>Aksi</center></th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                  $batas = 5;
                  if (!isset($_GET['halaman'])) {
                      $posisi = 0;
                      $halaman = 1;
                  } else {
                      $halaman = $_GET['halaman'];
                      $posisi = ($halaman-1) * $batas;
                  }
                  //hitung jumlah semua data
                  $sql_jum = "select `id_kategori_buku`, `kategori_buku` from
                  `kategori_buku` ";
                  if (isset($_SESSION["katakunci"])) {
                      $katakunci_kategori = $_SESSION["katakunci"];
                      $sql_jum .= " where `kategori_buku` LIKE '%$katakunci_kategori%'";
                  }
                  $sql_jum .= " order by `kategori_buku`";
                  $query_jum = mysqli_query($koneksi, $sql_jum);
                  $jum_data = mysqli_num_rows($query_jum);
                  $jum_halaman = ceil($jum_data/$batas);
                  // pagination
                  $sql_k = "SELECT `id_kategori_buku`,`kategori_buku` FROM
                  `kategori_buku` ";
                  if (isset($_SESSION["katakunci"])) {
                      $katakunci_kategori = $_SESSION["katakunci"];
                      $sql_k .= " where `kategori_buku` LIKE
                  '%$katakunci_kategori%'";
                  }
                  $sql_k .= " ORDER BY `kategori_buku` limit $posisi, $batas ";
                  $query_d = mysqli_query($koneksi, $sql_k);
                  while ($data_d = mysqli_fetch_row($query_d)) {
                      $data[] = $data_d;
                  }
                  $no = $posisi + 1;
                  //display data to table
                  if (!empty($data)) {
                      for ($i=0; $i < count($data); $i++) {
                          ?>
                    <tr>
                      <td><?= $no ?></td>
                      <td><?= $data[$i][1] ?></td>
                      <td align="center">
                        <a href="edit-kategori-buku-id-<?= $data[$i][0] ?>" class="btn btn-xs btn-info"><i class="fas fa-edit"></i> Edit</a>
                        <a href="#" class="btn btn-xs btn-warning hapus-kategori-buku" data-id="<?= $data[$i][0] ?>"><i class="fas fa-trash"></i> Hapus</a>
                      </td>
                    </tr>
                    <?php
                    $no++;
                      } ?>
                      </tbody>
                </table>
                <?php
                  } else {?>
                  </tbody>
                </table>
                <center>Tidak ada data!</center>
                <?php
                   }?>
              </div>
              <!-- /.card-body -->
              <!-- mulai paginasi FE -->
              <div class="card-footer clearfix">
              <ul class="pagination pagination-sm m-0 float-right">
              <?php
              if ($jum_halaman==0) {
                  //tidak ada halaman
              } elseif ($jum_halaman==1) {
                  echo "<li class='page-item'><a class='page-link'>1</a></li>";
              } else {
                  $sebelum = $halaman-1;
                  $setelah = $halaman+1;
                  if (isset($_SESSION["katakunci"])) {
                      $katakunci_kategori = $_SESSION["katakunci"];
                      if ($halaman!=1) {
                          echo "<li class='page-item'>
              <a class='page-link'
              href='kategori-buku-halaman-1'>First</a></li>";
                          echo "<li class='page-item'><a class='page-link'
              href='kategori-buku-halaman-$sebelum'>
              «</a></li>";
                      }
                      for ($i=1; $i<=$jum_halaman; $i++) {
                          if ($i!=$halaman) {
                              echo "<li class='page-item'><a class='page-link'
              href='kategori-buku-halaman-$i'>$i</a></li>";
                          } else {
                              echo "<li class='page-item'>
              <a class='page-link'>$i</a></li>";
                          }
                      }
                      if ($halaman!=$jum_halaman) {
                          echo "<li class='page-item'>
              <a class='page-link'
              href='kategori-buku-halaman-$setelah'>»</a></li>";
                          echo "<li class='page-item'><a class='page-link'
              href='kategori-buku-halaman-$jum_halaman'>
              Last</a></li>";
                      }
                  } else {
                      if ($halaman!=1) {
                          echo "<li class='page-item'><a class='page-link'
              href='kategori-buku-halaman-1'>First</a></li>";
                          echo "<li class='page-item'><a class='page-link'
              href='kategori-buku-halaman-$sebelum'>«</a></li>";
                      }
                      for ($i=1; $i<=$jum_halaman; $i++) {
                          if ($i!=$halaman) {
                              echo "<li class='page-item'><a class='page-link'
              href='kategori-buku-halaman-$i'>$i</a></li>";
                          } else {
                              echo "<li class='page-item'><a class='page-link'>$i</a></li>";
                          }
                      }
                      if ($halaman!=$jum_halaman) {
                          echo "<li class='page-item'><a class='page-link'
              href='kategori-buku-halaman-$setelah'>
              »</a></li>";
                          echo "<li class='page-item'><a class='page-link'
              href='kategori-buku-halaman-$jum_halaman'>Last</a></li>";
                      }
                  }
              }?>
              </ul>
              </div>
              <!-- end paginasi FE -->
            </div>
            <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include("includes/footer.php") ?>
  <?php
  unset($_SESSION['notif']);
  ?>

</div>
<!-- ./wrapper -->

<?php include("includes/script.php") ?>
<script>
$(document).ready(function () {
  $( ".hapus-kategori-buku" ).click(function() {
    hapus(this, "hapus-kategori-buku");
  });
});
</script>
</body>
</html>

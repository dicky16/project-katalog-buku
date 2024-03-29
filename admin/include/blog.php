<!DOCTYPE html>
<html>
<head>
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
            <h3><i class="fab fa-blogger"></i> Blog</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active"> Blog</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title" style="margin-top:5px;"><i class="fas fa-list-ul"></i> Daftar  Blog</h3>
                <div class="card-tools">
                  <a href="tambah-blog" class="btn btn-sm btn-info float-right">
                  <i class="fas fa-plus"></i> Tambah  Blog</a>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <div class="col-md-12">
                  <form method="POST" action="set-session">
                    <div class="row">
                        <div class="col-md-4 bottom-10">
                          <input type="text" class="form-control" id="kata_kunci" name="katakunci">
                          <input type="hidden" name="tujuan" value="blog">
                        </div>
                        <div class="col-md-5 bottom-10">
                          <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i>&nbsp; Search</button>
                        </div>
                    </div><!-- .row -->
                  </form>
                </div><br>
              <div class="col-sm-12">
              <?php if(isset($_SESSION['notif'])) { ?>
              <?php if($_SESSION['notif'] == "tambahberhasil") { ?>
                  <div class="alert alert-success" role="alert">Data Berhasil Ditambahkan</div>
                  <?php } else if($_SESSION['notif'] == "editberhasil") { ?>
                  <div class="alert alert-success" role="alert">Data Berhasil Diubah</div>
                  <?php } } ?>
              </div>
              <table class="table table-bordered">
                    <thead>                  
                      <tr>
                        <th width="5%">No</th>
                        <th width="30%">Kategori</th>
                        <th width="30%">Judul</th>
                        <th width="20%">Tanggal</th>
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
                  $sql_jum = "select id_blog, kategori_blog.kategori_blog, `judul`, `tanggal`, user.nama 
                  from blog 
                  INNER JOIN kategori_blog ON blog.id_kategori_blog = kategori_blog.id_kategori_blog 
                  INNER JOIN user ON blog.id_user = user.id_user";
                  if (isset($_SESSION["katakunci"])) {
                      $katakunci_kategori = $_SESSION["katakunci"];
                      $sql_jum .= " where blog.judul LIKE '%$katakunci_kategori%'";
                  }
                  $sql_jum .= " order by `judul`";
                  $query_jum = mysqli_query($koneksi, $sql_jum);
                  $jum_data = mysqli_num_rows($query_jum);
                  $jum_halaman = ceil($jum_data/$batas);
                  // pagination
                  $sql_k = "select id_blog, kategori_blog.kategori_blog, `judul`, `tanggal`, user.nama 
                  from blog 
                  INNER JOIN kategori_blog ON blog.id_kategori_blog = kategori_blog.id_kategori_blog 
                  INNER JOIN user ON blog.id_user = user.id_user";
                  if (isset($_SESSION["katakunci"])) {
                      $katakunci_kategori = $_SESSION["katakunci"];
                      $sql_k .= " where blog.judul LIKE
                  '%$katakunci_kategori%'";
                  }
                  $sql_k .= " ORDER BY `judul` limit $posisi, $batas ";
                  $query_d = mysqli_query($koneksi, $sql_k);
                  while ($data_d = mysqli_fetch_row($query_d)) {
                      $data[] = $data_d;
                  }
                  // var_dump($data); die;
                  $no = $posisi + 1;
                  //display data to table
                  if (!empty($data)) {
                      for ($i=0; $i < count($data); $i++) {
                          ?>
                      <tr>
                        <td><?= $no ?></td>
                        <td><?= $data[$i][1] ?></td>
                        <td><?= $data[$i][2] ?></td>
                        <td><?= $data[$i][3] ?></td>
                        <td align="center">
                          <a href="edit-blog-id-<?= $data[$i][0] ?>" class="btn btn-xs btn-info" title="Edit"><i class="fas fa-edit"></i></a>
                          <a href="detail-blog-id-<?= $data[$i][0] ?>" class="btn btn-xs btn-info" title="Detail"><i class="fas fa-eye"></i></a>
                          <a href="#" class="btn btn-xs btn-warning hapus-blog" data-id="<?= $data[$i][0] ?>"><i class="fas fa-trash" title="Hapus"></i></a>                         
                        </td>
                      </tr>
                      <?php
                    $no++;
                      }
                      ?>
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
              href='blog-halaman-1'>First</a></li>";
                          echo "<li class='page-item'><a class='page-link'
              href='blog-halaman-$sebelum'>
              «</a></li>";
                      }
                      for ($i=1; $i<=$jum_halaman; $i++) {
                          if ($i!=$halaman) {
                              echo "<li class='page-item'><a class='page-link'
              href='blog-halaman-$i'>$i</a></li>";
                          } else {
                              echo "<li class='page-item'>
              <a class='page-link'>$i</a></li>";
                          }
                      }
                      if ($halaman!=$jum_halaman) {
                          echo "<li class='page-item'>
              <a class='page-link'
              href='blog-halaman-$setelah'>»</a></li>";
                          echo "<li class='page-item'><a class='page-link'
              href='blog-halaman-$jum_halaman'>
              Last</a></li>";
                      }
                  } else {
                      if ($halaman!=1) {
                          echo "<li class='page-item'><a class='page-link'
              href='blog-halaman-1'>First</a></li>";
                          echo "<li class='page-item'><a class='page-link'
              href='blog-halaman-$sebelum'>«</a></li>";
                      }
                      for ($i=1; $i<=$jum_halaman; $i++) {
                          if ($i!=$halaman) {
                              echo "<li class='page-item'><a class='page-link'
              href='blog-halaman-$i'>$i</a></li>";
                          } else {
                              echo "<li class='page-item'><a class='page-link'>$i</a></li>";
                          }
                      }
                      if ($halaman!=$jum_halaman) {
                          echo "<li class='page-item'><a class='page-link'
              href='blog-halaman-$setelah'>
              »</a></li>";
                          echo "<li class='page-item'><a class='page-link'
              href='blog-halaman-$jum_halaman'>Last</a></li>";
                      }
                  }
              }?>
                </ul>
              </div>
            </div>
            <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include("includes/footer.php") ?>

</div>
<!-- ./wrapper -->
<?php unset($_SESSION['notif']); ?>
<?php include("includes/script.php") ?>
<script>
$(document).ready(function () {
  $( ".hapus-blog" ).click(function() {
    hapus(this, "hapus-blog");
  });
});
</script>
</body>
</html>

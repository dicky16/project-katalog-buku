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
            <h3><i class="fas fa-file-alt"></i> Konten</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active"> Konten</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title" style="margin-top:5px;"><i class="fas fa-list-ul"></i> Daftar  Konten</h3>
               
                
               
                
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <div class="col-sm-12">
              <?php if(isset($_SESSION['notif'])) {
              if($_SESSION['notif'] == "editberhasil") { ?>
                <div class="alert alert-success" role="alert">Data Berhasil Diubah</div>
                <?php } } ?>
              </div>
                <table class="table table-bordered">
                  <thead>                  
                    <tr>
                      <th width="5%">No</th>
                      <th width="50%">Judul</th>
                      <th width="30%">Tanggal</th>
                      <th width="15%"><center>Aksi</center></th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                  $sql = "SELECT * FROM `konten` order by `judul`";
                  $query_d = mysqli_query($koneksi, $sql);
                  while ($data_d = mysqli_fetch_row($query_d)) {
                      $data[] = $data_d;
                  }
                  $no = 1;
                  //display data to table
                  if (!empty($data)) {
                      for ($i=0; $i < count($data); $i++) {
                          ?>
                    <tr>
                      <td><?= $no ?></td>
                      <td><?= $data[$i][1] ?></td>
                      <td><?= $data[$i][3] ?></td>
                      <td align="center">
                        <a href="edit-konten-id-<?= $data[$i][0] ?>" class="btn btn-xs btn-info"><i class="fas fa-edit"></i></a>
                        <a href="detail-konten-id-<?= $data[$i][0] ?>" class="btn btn-xs btn-info" title="Detail"><i class="fas fa-eye"></i></a>
                           
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

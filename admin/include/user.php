<?php 
// session_start();
?>
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
            <h3><i class="fas fa-user-tie"></i> Data User</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Data User</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title" style="margin-top:5px;"><i class="fas fa-list-ul"></i> Data User</h3>
                <div class="card-tools">
                  <a href="tambah-user" class="btn btn-sm btn-info float-right"><i class="fas fa-plus"></i> Tambah User</a>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <?php if((!empty($_SESSION['notif']))){?>
                <?php if($_SESSION['notif']=='tambahberhasil') { ?>
                    <div class="alert alert-success" role="alert">Data Berhasil Ditambahkan</div>
                <?php } else if($_SESSION['notif']=='editberhasil') { ?>
                    <div class="alert alert-success" role="alert">Data Berhasil Diubah</div>
                <?php } ?>
                <?php } ?>
                </div>
                <table class="table table-bordered" id="tabel-user">
                    <thead>                  
                      <tr>
                        <th width="5%">No</th>
                        <th width="30%">Nama</th>
                        <th width="30%">Email</th>
                        <th width="20%">Level</th>
                        <th width="15%"><center>Aksi</center></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $no=1;
                        $employee = mysqli_query($koneksi,"select * from user");
                        while($row = mysqli_fetch_array($employee))
                        {
                          // var_dump($row['id_user']); die;
                            echo "<tr>
                            <td>".$no."</td>
                            <td>".$row['nama']."</td>
                            <td>".$row['email']."</td>
                            <td>".$row['level']."</td>
                            <td align='center'>
                              <a href='edit-user-id-".$row['id_user']."' class='btn btn-xs btn-info' title='Edit'><i class='fas fa-edit'></i></a>
                              <a href='detail-user-id-".$row['id_user']."' class='btn btn-xs btn-info' title='Detail'><i class='fas fa-eye'></i></a>
                              <a href='#' class='btn btn-xs btn-warning hapususer' data-id='".$row['id_user']."'><i class='fas fa-trash' title='Hapus'></i></a>                         
                            </td>
                        </tr>";
                        $no++;
                        }
                      ?>
                    </tbody>
                  </table>  
              </div>

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
<script>
$(document).ready(function () {
  //datatable
  $.noConflict();
    var table = $('#tabel-user').DataTable();
  
  $( ".hapususer" ).click(function() {
    hapus(this, "hapus-user");
  });
});
</script>
</body>
</html>

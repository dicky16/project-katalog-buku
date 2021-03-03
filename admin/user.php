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
                  <a href="tambahuser.php" class="btn btn-sm btn-info float-right"><i class="fas fa-plus"></i> Tambah User</a>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <!-- <div class="col-md-12">
                  <form method="post" action="#">
                    <div class="row">
                        <div class="col-md-4 bottom-10">
                          <input type="text" class="form-control" id="kata_kunci" name="kunci2">
                        </div>
                        <div class="col-md-5 bottom-10">
                          <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i>&nbsp; Search</button>
                        </div>
                    </div>
                  </form>
                </div><br> -->
                <?php if((!empty($_GET['notif']))){?>
                <?php if($_GET['notif']=='tambahberhasil') { ?>
                    <div class="alert alert-success" role="alert">Data Berhasil Ditambahkan</div>
                <?php } else if($_GET['notif']=='editberhasil') { ?>
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
                        include '../koneksi/koneksi.php';
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
                              <a href='edituser.php?id=".$row['id_user']."' class='btn btn-xs btn-info' title='Edit'><i class='fas fa-edit'></i></a>
                              <a href='detailuser.php?id=".$row['id_user']."' class='btn btn-xs btn-info' title='Detail'><i class='fas fa-eye'></i></a>
                              <a href='#' class='btn btn-xs btn-warning'><i class='fas fa-trash' title='Hapus'></i></a>                         
                            </td>
                        </tr>";
                        $no++;
                        }
                      ?>
                    </tbody>
                  </table>  
              </div>
              <!-- /.card-body -->
              <!-- <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                  <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                  <li class="page-item"><a class="page-link" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                </ul>
              </div>
            </div> -->
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

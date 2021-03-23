<?php
include('../koneksi/koneksi.php');
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    if(is_numeric($id)) {
        $sql = "DELETE from  `penerbit` where `id_penerbit`='$id'";
        mysqli_query($koneksi,$sql);
        header("Location:penerbit.php");
    }
}
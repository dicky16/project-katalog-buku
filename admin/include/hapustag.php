<?php
include('../koneksi/koneksi.php');
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    if(is_numeric($id)) {
        $sql = "DELETE from  `tag` where `id_tag`='$id'";
        mysqli_query($koneksi,$sql);
        header("Location:tag.php");
    }
}
<?php
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    if(is_numeric($id)) {
        $sql = "DELETE from  `user` where `id_user`='$id'";
        mysqli_query($koneksi,$sql);
        header("Location:user");
    }
}
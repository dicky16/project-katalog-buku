<?php
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    if(is_numeric($id)) {
        $sql = "DELETE from  `slider` where `id`='$id'";
        mysqli_query($koneksi,$sql);
        header("Location:slide");
    }
}
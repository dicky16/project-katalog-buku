<?php
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    if(is_numeric($id)) {
        $sql_gambar = "select * from  `slider` where `id`='$id'";
        $data_gambar = getDataUser($koneksi, $sql_gambar);
        unlink("slider/".$data_gambar[0]['gambar']);
        $sql = "DELETE from  `slider` where `id`='$id'";
        mysqli_query($koneksi,$sql);
        header("Location:slide");
    }
}
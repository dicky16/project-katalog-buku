<?php
include("../koneksi/koneksi.php");
if(isset($_POST['tambahtag'])) {
    $tag = $_POST['tag'];
     if(empty($tag)) {
        header("Location:tambahtag.php?notif=tambahkosong");
     } else {
        $sql = "INSERT INTO `tag` (`tag`) VALUES ('$tag');";
        mysqli_query($koneksi,$sql);
        header("Location:tag.php?notif=tambahberhasil");
     }
} else if(isset($_POST['updatetag'])) {
    $id = $_GET['id'];
    $tag = $_POST['tag'];
     if(empty($tag)) {
        header("Location:edittag.php?notif=editkosong");
     } else {
        $sql = "UPDATE `tag` SET `tag`='$tag' where `id_tag`='$id'";
        mysqli_query($koneksi,$sql);
        header("Location:tag.php?notif=editberhasil");
     }
}
<?php
if(isset($_POST['tambahtag'])) {
    $tag = $_POST['tag'];
     if(empty($tag)) {
        $_SESSION['notif'] = 'tambahkosong';
        header("Location:tambah-tag");
     } else {
        $sql = "INSERT INTO `tag` (`tag`) VALUES ('$tag');";
        mysqli_query($koneksi,$sql);
        $_SESSION['notif'] = 'tambahberhasil';
        header("Location:tag");
     }
} else if(isset($_POST['updatetag'])) {
    $id = $_GET['id'];
    $tag = $_POST['tag'];
     if(empty($tag)) {
      $_SESSION['notif'] = 'editkosong';
        header("Location:edit-tag-id-".$id);
     } else {
        $sql = "UPDATE `tag` SET `tag`='$tag' where `id_tag`='$id'";
        mysqli_query($koneksi,$sql);
        $_SESSION['notif'] = 'editberhasil';
        header("Location:tag");
     }
}
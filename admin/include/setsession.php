<?php
if (isset($_POST['katakunci'])) {
    $_SESSION['katakunci'] = $_POST['katakunci'];
    header("Location:".$_POST['tujuan']);
} else {
    header("Location:profil");
}
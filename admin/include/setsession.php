<?php
if (isset($_POST['katakunci'])) {
    if($_POST['katakunci'] == "") {
        unset($_SESSION['katakunci']);
    }
    $_SESSION['katakunci'] = $_POST['katakunci'];
    header("Location:".$_POST['tujuan']);
} else {
    header("Location:profil");
}
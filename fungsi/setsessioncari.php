<?php
if (isset($_POST['search'])) {
    if($_POST['search'] == "") {
        unset($_SESSION['search']);
    }
    $_SESSION['search'] = $_POST['search'];
    header("Location:daftar-buku");
}
<?php 
function getDataById ($id, $koneksi) {
    $sql_d = "select * from `user`
    where `id_user` = '$id'";
    $query_d = mysqli_query($koneksi, $sql_d);
    $data = "";
    while ($data_d = mysqli_fetch_row($query_d)) {
        // print_r($data_d); die;
        $data = $data_d;
        // $nama = $data_d[1];
        // $email = $data_d[2];
        // $username = $data_d[3];
        // $password = $data_d[4];
        // $rule = $data_d[5];
        // $foto = $data_d[6];
    }
    return $data;
}
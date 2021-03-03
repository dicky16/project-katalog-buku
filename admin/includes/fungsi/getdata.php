<?php 
function getData ($koneksi, $table) {
    $sql_d = "select * from `$table`";
    $query_d = mysqli_query($koneksi, $sql_d);
    $data;
    while ($data_d = mysqli_fetch_row($query_d)) {
        $data[] = $data_d;
    }
    return $data;
}
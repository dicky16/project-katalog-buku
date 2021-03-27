<?php
//data kategori blog
$sql_kategori_buku = "select * from kategori_buku order by kategori_buku";
$query_kategori_buku = mysqli_query($koneksi, $sql_kategori_buku);
while ($data_k = mysqli_fetch_assoc($query_kategori_buku)) {
    $data_kategori_buku[] = $data_k;
}
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
        <a class="navbar-brand" href="#">Katalog Buku</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample07" aria-controls="navbarsExample07" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    
        <div class="collapse navbar-collapse" id="navbarsExample07">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="beranda">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about-us">About Us</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown07" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Kategori</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown07">
                    <?php foreach ($data_kategori_buku as $kategori_buku) { ?>
                    <a class="dropdown-item" href="daftarbuku.php"><?= $kategori_buku['kategori_buku'] ?></a>
                    <?php } ?>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="blog">Blog</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact-us">Contact Us</a>
                </li>
            </ul>
            <form class="form-inline mt-2 mt-md-0">
              <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
        </div>
    </nav>
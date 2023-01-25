<?php 
session_start();
include("inc_koneksi.php");
if(!isset($_SESSION['admin_username'])) {
    header("location:login.php");
}
// include("inc_header.php");
if(!in_array("user", $_SESSION['admin_akses'])) {
    echo "Kamu tidak punya Akses";
    include("inc_footer.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DRA's DRINK SHOP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
<div id="app2">
    <nav>
        <ul>
            <li><a href="admin_depan.php"> Home </a></li>
            <?php if(in_array("kasir", $_SESSION['admin_akses'])) { ?>
                <li><a href="kasir.php"> Halaman Pegawai </a></li>
            <?php } ?>
            <?php if(in_array("user", $_SESSION['admin_akses'])) { ?>
                <li><a href="user.php"> Halaman Pelanggan </a></li>
            <?php } ?>
            <li class="keluar"><a href="logout.php"> Logout >> </a></li>
        </ul>
    </nav>
    
<h1>Halaman Pelanggan</h1>
<p class="dash">Silakan pilih minuman</p>
<section class="konten">
    </section>
    <div class="container">
        <div class="card-header bg-primary text-white">
            <h3>Daftar Minuman Terlaris</h3>
        </div>
        <br><br>
        <div class="row">
            
            <div class="col-md-3">
                <div class="thumbnail">
                    <img src="foto/pepsi.png" alt="" width="300px">
                    <div class="caption">
                        <h3>Pepsi</h3>
                        <h5>Rp. 4500/pcs</h5>
                        <a href="beli_produk.php" class="btn btn-primary">Beli Produk</a>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="thumbnail">
                    <img src="foto/Fanta.png" alt="" width="300px">
                    <div class="caption">
                        <h3>Fanta</h3>
                        <h5>Rp. 5000/pcs</h5>
                        <a href="beli_produk.php" class="btn btn-primary">Beli Produk</a>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="thumbnail">
                    <img src="foto/Sprite.png" alt="" width="210px">
                    <div class="caption">
                        <h3>Sprite</h3>
                        <h5>Rp. 4000/pcs</h5>
                        <a href="beli_produk.php" class="btn btn-primary">Beli Produk</a>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="thumbnail">
                    <img src="foto/Cola.png" alt="" width="210px">
                    <div class="caption">
                        <h3>Coca-cola</h3>
                        <h5>Rp. 5000/pcs</h5>
                        <a href="beli_produk.php" class="btn btn-primary">Beli Produk</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <br>
    <br>
    <div class="container">
        <div class="card-header bg-primary text-white">
            <h3>Daftar Minuman Lainnya</h3>
        </div>
        <br><br>
        <div class="row">
            
            <div class="col-md-3">
                <div class="thumbnail">
                    <img src="foto/pokari.png" alt="" width="250px">
                    <div class="caption">
                        <h3>Pocari Sweat</h3>
                        <h5>Rp. 4000/pcs</h5>
                        <a href="beli_produk.php" class="btn btn-primary">Beli Produk</a>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="thumbnail">
                    <img src="foto/lemonwtr.jpg" alt="" width="300px">
                    <div class="caption">
                        <h3>Lemon Water</h3>
                        <h5>Rp. 4000/pcs</h5>
                        <a href="beli_produk.php" class="btn btn-primary">Beli Produk</a>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="thumbnail">
                    <img src="foto/bintang.png" alt="" width="300px">
                    <div class="caption">
                        <h3>Bintang Radler</h3>
                        <h5>Rp. 4000/pcs</h5>
                        <a href="beli_produk.php" class="btn btn-primary">Beli Produk</a>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="thumbnail">
                    <img src="foto/utmilk.jfif" alt="" width="300px">
                    <div class="caption">
                        <h3>Ultra Milk (Plain)</h3>
                        <h5>Rp. 5000/pcs</h5>
                        <a href="beli_produk.php" class="btn btn-primary">Beli Produk</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
<?php
include("inc_footer.php");
?>
<?php 
session_start();
include("inc_koneksi.php");
if(!isset($_SESSION['admin_username'])) {
    header("location:login.php");
}
// include("inc_header.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Swalayan Jaya Abadi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
<div id="app2">
    <nav>
        <ul>
            <li><a href="admin_depan.php"> Halaman Depan </a></li>
            <?php if(in_array("kasir", $_SESSION['admin_akses'])) { ?>
                <li><a href="kasir.php"> Halaman Pegawai </a></li>
            <?php } ?>
            <?php if(in_array("user", $_SESSION['admin_akses'])) { ?>
                <li><a href="user.php"> Halaman Pelanggan </a></li>
            <?php } ?>
            <li class="keluar"><a href="logout.php"> Logout >> </a></li>
        </ul>
    </nav>
    
<h1>DRA's DRINK SHOP</h1>
<p class="dash" font_type="bolt" >Selamat Datang</p>
<img src="foto/member.png" class="rounded" alt="" width="400px" >
<img src="foto/comingsoon.png" class="rounded float-start" alt="" width="520px" >
<img src="foto/loker.png" class="rounded float-end" alt="" width="440px" >
<br> <br> 
<?php
include("inc_footer.php");
?>
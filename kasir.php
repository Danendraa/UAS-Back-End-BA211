<?php
session_start();
include("inc_koneksi.php");
if(!isset($_SESSION['admin_username'])) {
    header("location:login.php");
}
// include("inc_header.php");
// if(!in_array("kasir", $_SESSION['admin_akses'])) {
//     echo "Kamu tidak punya Akses";
//     include("inc_footer.php");
//     exit();
// }
$host       = "localhost";
$user       = "root";
$pass       = "";
$db         = "toko";

$koneksi    = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) {
    die("Tidak Bisa Terkoneksi ke Database");
}
$Nama       = "";
$Keterangan = "";
$TglMasuk   = "";
$TglUpdate  = "";
$Status     = "";
$Aktif      = "";
$sukses     = "";
$error      = "";

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}
if ($op == 'delete') {
    $Kode       = $_GET['Kode'];
    $sql1       = "delete from barang where Kode = '$Kode'";
    $q1         = mysqli_query($koneksi, $sql1);
    if ($q1) {
        $sukses = "Berhasil Menghapus Data";
    } else {
        $error  = "Gagal Menghapus Data";
    }
}

if ($op == 'edit') {
    $Kode       = $_GET['Kode'];
    $sql1       = "select * from barang where Kode = '$Kode'";
    $q1         = mysqli_query($koneksi, $sql1);
    $r1         = mysqli_fetch_array($q1);
    $Nama       = $r1['Nama'];
    $Keterangan = $r1['Keterangan'];
    $TglMasuk   = $r1['TglMasuk'];
    $TglUpdate  = $r1['TglUpdate'];
    $Status     = $r1['Status'];
    $Aktif      = $r1['Aktif'];

    if ($Nama == '') {
        $error  = "Data Tidak Ditemukan";
    }
}

if (isset($_POST['simpan'])) {
    $Nama       = $_POST['Nama'];
    $Keterangan = $_POST['Keterangan'];
    $TglMasuk   = $_POST['TglMasuk'];
    $TglUpdate  = $_POST['TglUpdate'];
    $Status     = $_POST['Status'];
    $Aktif      = $_POST['Aktif'];

    if ($Nama && $Keterangan && $TglMasuk && $TglUpdate && $Status && $Aktif) {
        if ($op == 'edit') { //untuk update
            $sql1       = "update barang set Nama = '$Nama',Keterangan = '$Keterangan',TglMasuk = '$TglMasuk',TglUpdate = '$TglUpdate',Status = '$Status',Aktif = '$Aktif' where Kode = '$Kode'";
            $q1         = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses = "Data Berhasil Diupdate";
            } else {
                $error  = "Data Gagal Diupdate";
            }
        } else { //untuk insert
            $sql1   = "insert into barang(Nama,Keterangan,TglMasuk,TglUpdate,Status,Aktif) values ('$Nama','$Keterangan','$TglMasuk','$TglUpdate','$Status','$Aktif')";
            $q1     = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses     = "Berhasil Memasukkan Data Baru";
            } else {
                $error      = "Gagal Memasukkan Data";
            }
        }
    } else {
        $error  = "Silahkan Masukkan Semua Data";
    }
}
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
    
<h1>Halaman Pegawai</h1>
<p class="dash">Selamat Datang di Halaman Pegawai</p>
    <div>
        <nav class="navbar navbar-dark bg-primary mx-auto">
            <div class="container-fluid">
                <a class="navbar-brands" href="kasir.php">
                <i class="bi bi-basket"></i>
                    Swalayan Jaya Abadi
                </a>
            </div>
        </nav>
    </div>
    <br>
    <div class="mx-auto">
        <!-- Untuk Memasukkan Data -->
        <div class="card">
            <div class="card-header bg-primary text-white">
                Buat / Edit Stok Barang
            </div>
            <div class="card-body">
                <?php
                if ($error) {
                ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error ?>
                    </div>
                <?php
                    header("refresh:1;url=kasir.php");
                }
                ?>
                <?php
                if ($sukses) {
                ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $sukses ?>
                    </div>
                <?php
                    header("refresh:1;url=kasir.php");
                }
                ?>
                <form action="" method="POST">
                    <div class="mb-3 row">
                        <label for="Nama" class="col-sm-2 col-form-label">Nama Barang</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="Nama" name="Nama" value="<?php echo $Nama ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="Keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="Keterangan" name="Keterangan" value="<?php echo $Keterangan ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="TglMasuk" class="col-sm-2 col-form-label">Tanggal Masuk</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="TglMasuk" name="TglMasuk" value="<?php echo $TglMasuk ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="TglUpdate" class="col-sm-2 col-form-label">Tanggal Update</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="TglUpdate" name="TglUpdate" value="<?php echo $TglUpdate ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="Status" class="col-sm-2 col-form-label">Status</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="Status" id="Status">
                                <option value="">- Status Barang -</option>
                                <option value="pengemasan" <?php if ($Status == "pengemasan") echo "selected" ?>>Dalam Pengemasan</option>
                                <option value="perjalanan" <?php if ($Status == "perjalanan") echo "selected" ?>>Dalam Perjalanan</option>
                                <option value="di lokasi" <?php if ($Status == "lokasi") echo "selected" ?>>Sudah Sampai di Lokasi</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="Aktif" class="col-sm-2 col-form-label">Aktif</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="Aktif" id="Aktif">
                                <option value="">- Aktif -</option>
                                <option value="1" <?php if ($Aktif == "1") echo "selected" ?>>Aktif</option>
                                <option value="0." <?php if ($Aktif == "0.") echo "selected" ?>>Tidak Aktif</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <input type="submit" name="simpan" value="Simpan Data" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>

        <br><br>

        <!-- Untuk Mengeluarkan Data -->
        <div class="card">
            <div class="card-header text-white bg-secondary">
                Data Barang
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Kode</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Keterangan</th>
                            <th scope="col">Tanggal Masuk</th>
                            <th scope="col">Tanggal Update</th>
                            <th scope="col">Status</th>
                            <th scope="col">Aktif</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    <tbody>
                        <?php
                        $sql2   = "select * from barang order by Kode asc";
                        $q2     = mysqli_query($koneksi, $sql2);
                        $urut   = 1;
                        while ($r2 = mysqli_fetch_array($q2)) {
                            $Kode   = $r2['Kode'];
                            $Nama   = $r2['Nama'];
                            $Keterangan = $r2['Keterangan'];
                            $TglMasuk   = $r2['TglMasuk'];
                            $TglUpdate  = $r2['TglUpdate'];
                            $Status     = $r2['Status'];
                            $Aktif      = $r2['Aktif'];

                        ?>
                            <tr>
                                <th scope="row"><?php echo $urut++ ?></th>
                                <td scope="row"><?php echo $Nama ?></td>
                                <td scope="row"><?php echo $Keterangan ?></td>
                                <td scope="row"><?php echo $TglMasuk ?></td>
                                <td scope="row"><?php echo $TglUpdate ?></td>
                                <td scope="row"><?php echo $Status ?></td>
                                <td scope="row"><?php echo $Aktif ?></td>
                                <td scope="row">
                                    <a href="kasir.php?op=edit&Kode=<?php echo $Kode ?>"><button type="button" class="btn btn-warning">Edit</button></a>
                                    <a href="kasir.php?op=delete&Kode=<?php echo $Kode ?>" onclick="return confirm('Yakin Ingin Menghapus Data?')"><button type="button" class="btn btn-danger">Delete</button></a>
                                </td>
                            </tr>

                        <?php
                        }

                        ?>
                    </tbody>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <br><br><br>






<?php
include("inc_footer.php");
?>
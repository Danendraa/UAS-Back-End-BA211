<?php
// include("kasir.php");
include("inc_koneksi.php");
// include("pesanan.php");


$host       = "localhost";
$user       = "root";
$pass       = "";
$db         = "produk";

$koneksi    = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) {
    die("Tidak Bisa Terkoneksi ke Database");
}
$id_produk  = "";
$nama       = "";
$jumlah     = "";
$bayar      = "";
$sukses     = "";
$error      = "";


if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}
if ($op == 'delete') {
    $id_produk  = $_GET['id_produk'];
    $sql1       = "delete from makanan where id_produk = '$id_produk'";
    $q1         = mysqli_query($koneksi, $sql1);
    if ($q1) {
        $sukses = "Berhasil Menghapus Data";
    } else {
        $error  = "Gagal Menghapus Data";
    }
}

if ($op == 'edit') {
    $id_produk  = $_GET['id_produk'];
    $sql1       = "select * from makanan where id_produk = '$id_produk'";
    $q1         = mysqli_query($koneksi, $sql1);
    $r1         = mysqli_fetch_array($q1);
    $nama       = $r1['nama'];
    $jumlah     = $r1['jumlah'];
    $bayar      = $r1['bayar'];

    if ($nama == '') {
        $error  = "Data Tidak Ditemukan";
    }
}

if (isset($_POST['simpan'])) {
    $nama       = $_POST['nama'];
    $jumlah     = $_POST['jumlah'];
    $bayar      = $_POST['bayar'];

    if ($nama && $jumlah && $bayar) {
        if ($op == 'edit') { //untuk update
            $sql1       = "update makanan set nama = '$nama',jumlah = '$jumlah',bayar = '$bayar'";
            $q1         = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses = "Data Berhasil Diupdate";
            } else {
                $error  = "Data Gagal Diupdate";
            }
        } else { //untuk insert
            $sql1   = "insert into makanan(nama,jumlah,bayar) values ('$nama','$jumlah','$bayar')";
            $q1     = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses     = "Produk Telah Berhasil di Pesan";
            } else {
                $error      = "Masukkan Nama Produk yang Benar";
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
<!-- <div id="app2">
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
    </nav> -->
    <div>
        <nav>
            <ul>
                <li class="backs">
                    <a href="user.php"> << Kembali</a>
                </li>
            </ul>
        </nav>
    </div>
<br>
<div>
        <nav class="navbar navbar-dark bg-primary mx-auto">
            <div class="container-fluid">
                <a class="navbar-brands" href="beli_produk.php">
                <i class="bi bi-basket"></i>
                    Beli Produk
                </a>
            </div>
        </nav>
    </div>
    <br>
    <div class="mx-auto">
        <!-- Untuk Memasukkan Data -->
        <div class="card">
            <div class="card-header bg-primary text-white">
            Silahkan Masukkan Data Produk yang anda Beli
            </div>
            <div class="card-body">
                <?php
                if ($error) {
                ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error ?>
                    </div>
                <?php
                    header("refresh:1;url=beli_produk.php");
                }
                ?>
                <?php
                if ($sukses) {
                ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $sukses ?>
                    </div>
                <?php
                    header("refresh:1;url=beli_produk.php");
                }
                ?>
                <form action="" method="POST">
                    <div class="mb-3 row">
                        <label for="nama" class="col-sm-2 col-form-label">Nama Produk</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $nama ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="jumlah" class="col-sm-2 col-form-label">Jumlah Pesanan</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="jumlah" name="jumlah" value="<?php echo $jumlah ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="bayar" class="col-sm-2 col-form-label">Metode Pembayaran</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="bayar" id="bayar">
                                <option value="">- Pilih Metode Pembayaran -</option>
                                <option value="Transfer" <?php if ($bayar == "Transfer") echo "selected" ?>>Transfer</option>
                                <option value="QRIS" <?php if ($bayar == "QRIS") echo "selected" ?>>QRIS</option>
                                <option value="Cash" <?php if ($bayar == "Cash") echo "selected" ?>>Cash</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <input type="submit" name="simpan" value="Pesan Sekarang" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>

        <br><br>

        <div class="card mx-auto">
            <div class="card-header text-white bg-secondary text-center fw-bold">
                Riwayat Pesanan Anda
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID Pesanan</th>
                            <th scope="col">Nama Barang</th>
                            <th scope="col">Jumlah Pesanan</th>
                            <th scope="col">Metode Pembayaran</th>
                        </tr>
                    <tbody>
                        <?php
                        $sql2   = "select * from makanan order by id_produk asc";
                        $q2     = mysqli_query($koneksi, $sql2);
                        $urut   = 1;
                        while ($r2 = mysqli_fetch_array($q2)) {
                            $id_produk = $r2['id_produk'];
                            $nama       = $r2['nama'];
                            $jumlah     = $r2['jumlah'];
                            $bayar      = $r2['bayar'];

                        ?>
                            <tr>
                                <th scope="row"><?php echo $urut++ ?></th>
                                <td scope="row"><?php echo $nama ?></td>
                                <td scope="row"><?php echo $jumlah ?></td>
                                <td scope="row"><?php echo $bayar ?></td>
                                <td scope="row">
                                    <a href="beli_produk.php?op=edit&id_produk=<?php echo $id_produk ?>"><button type="button" class="btn btn-warning">Edit</button></a>
                                    <a href="beli_produk.php?op=delete&id_produk=<?php echo $id_produk ?>" onclick="return confirm('Yakin Ingin Menghapus Data?')"><button type="button" class="btn btn-danger">Batalkan</button></a>
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

<?php
include("inc_footer.php");
?>

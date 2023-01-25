<?php
session_start();
if (isset($_SESSION['admin_username'])) {
    header("location:admin_depan.php");
}
include("inc_koneksi.php");
$username   = "";
$password   = "";
$err        = "";
if (isset($_POST['login'])){
    $username   = $_POST['username'];
    $password   = $_POST['password'];
    if ($username == '' or $password == '') {
        $err    .= "<li>Silahkan Masukkan Username dan Password</li>";
    }
    if (empty($err)){
        $sql1   = "select * from admin where username = '$username' ";
        $q1     = mysqli_query($koneksi, $sql1);
        $r1     = mysqli_fetch_array($q1);
        if ($r1['password'] != md5($password)) {
            $err    .= "<li>Akun Tidak Ditemukan</li>";
        }
    }
    if (empty($err)) {
        $login_id   = $r1['login_id'];
        $sql1   = "select * from admin_akses where login_id = '$login_id'";
        $q1     = mysqli_query($koneksi, $sql1);
        while($r1 = mysqli_fetch_array($q1)) {
            $akses[] = $r1['akses_id']; //kasir, user
        }
        if(empty($akses)) {
            $err    .= "<li>Kamu tidak punya akses ke halaman Admin</li>";
        }
    }
    if(empty($err)){
        $_SESSION['admin_username'] = $username;
        $_SESSION['admin_akses'] = $akses;
        header("location:admin_depan.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div id="app">
        <h1>Silakan Login terlebih dahulu</h1>
        <?php
        if ($err) {
            echo "<ul>$err</ul>";
        }
        ?>
        <form action="" method="post">
            <input type="text" value="<?php echo $username ?>" name="username" class="input" placeholder="Masukkan peran anda dalam situs ini..."><br><br>
            <input type="password" name="password" class="input" placeholder="Masukkan Password"><br>
            <p class="teks_bawah"> note: jika anda pembeli, masuklah sebagai user </p>
            <input type="submit" name="login" value="Masuk ke Situs" class="tombol_login">
        </form>
    </div>
</body>
</html>
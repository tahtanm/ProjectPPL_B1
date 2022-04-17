<?php
session_start();

include 'koneksi.php';

$username = $_POST['username'];
$password = $_POST['password'];

$q = mysqli_query($conn, "SELECT * FROM pegawai WHERE username='$username' and password='$password'");
$r = mysqli_fetch_array ($q);

$q2 = mysqli_query($conn, "SELECT * FROM pelanggan WHERE username='$username' and password='$password'");
$row = mysqli_fetch_array ($q2);

$q3 = mysqli_query($conn, "SELECT * FROM pemilik WHERE username='$username' and password='$password'");
$row = mysqli_fetch_array ($q3);

if (mysqli_num_rows($q) == 1) {
    $_SESSION['username'] = $r['username'];
    $_SESSION['password'] = $r['password'];
    $_SESSION['level'] = 'pegawai';
    header('location:pegawai/index.php');
}elseif(mysqli_num_rows($q2) == 1){
    $_SESSION['id'] = $row['id'];
    $_SESSION['username'] = $r['username'];
    $_SESSION['password'] = $r['password'];
    $_SESSION['level'] = 'pelanggan';
    header('location:pelanggan/index.php');
}elseif (mysqli_num_rows($q3) == 1) {
    $_SESSION['username'] = $r['username'];
    $_SESSION['password'] = $r['password'];
    $_SESSION['level'] = 'pemilik';
    header('location:pemilik/index.php');
}else {
    //echo "Login Gagal";
    echo "<script>alert('Maaf anda gagal login');window.location='login.php';</script>";
}
?>
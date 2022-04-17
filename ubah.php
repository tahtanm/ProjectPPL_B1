<?php
// session_start();

// if(!isset($_SESSION["login"])) {
//     header("Location: index.php");
//     exit;
// }

// require 'functions.php';

// // mengambil data di url
// $id = $_GET["id"];

// // query data mahasiswa berdasarkan id 
// $mhs = query("SELECT * FROM pelanggan WHERE id = $id")[0];

// // cek apakah tombol submit sudah ditekan atau belum
// if (isset($_POST["submit"])) {

//     // cek apakah data berhasil diubah atau tidak menggunakan function
//     if (ubah($_POST) > 0 ) {
//         echo "
//             <script>
//                 alert('Data Berhasil Diubah!');
//                 document.location.href = 'akun.php';
//             </script>
//         ";

//     } else {
//         echo "
//             <script>
//                 alert('Data Gagal Diubah!');
//                 document.location.href = 'akun.php';
//             </script>
//         ";

//         echo mysqli_error($conn); // untuk menampilkan pesan error nya
//     }
// }
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Akun</title>
</head>
<body>
    <h1>Ubah Akun</h1>
    <form action="" method="post">
        <input type="hidden" name="id" value="<?= $pelanggan["id"]; ?>">
        <div class="mb-3">
            <label for="nama" class="zmdi zmdi-account material-icons-name">Nama Lengkap</label>
            <input type="text" class="form-control" id="nama" value="<?= $pelanggan["nama lengkap"]; ?>">
        </div>
        <div class="mb-3">
            <label for="tempat lahir" class="zmdi zmdi-account material-icons-name">Tempat lahir</label>
            <input type="text" class="form-control" id="tempat lahir" value="<?= $pelanggan["tempat lahir"]; ?>">
        </div>
        <div class="mb-3">
            <label for="tanggal lahir" class="zmdi zmdi-account material-icons-name">Tanggal Lahir</label>
            <input type="date" class="form-control" id="tanggal lahir" value="<?= $pelanggan["tanggal lahir"]; ?>">                            </div>
        </div>    
        <div class="mb-3">
            <label for="jenis kelamin" class="zmdi zmdi-account material-icons-name">Jenis Kelamin</label>
            <input type="text" class="form-control" id="jenis kelamin" value="<?= $pelanggan["jenis kelamin"]; ?>">
        </div>
        <div class="mb-3">
            <label for="alamat" class="zmdi zmdi-account material-icons-name">Alamat</label>
            <input type="text" class="form-control" id="alamat" value="<?= $pelanggan["alamat"]; ?>">                            
        </div>
        <div class="mb-3">
            <label for="no hp" class="zmdi zmdi-account material-icons-name">No HP</label>
            <input type="text" class="form-control" id="no hp" value="<?= $pelanggan["no hp"]; ?>">
        </div>
        <div class="mb-3">
            <label for="email" class="zmdi zmdi-account material-icons-name">Email</label>
            <input type="text" class="form-control" id="email" value="<?= $pelanggan["email"]; ?>">
        </div>
        <div class="mb-3">
            <label for="username" class="zmdi zmdi-account material-icons-name">Username</label>
            <input type="text" class="form-control" id="username" value="<?= $pelanggan["username"]; ?>">
        </div>
        <div class="mb-3">
            <label for="password" class="zmdi zmdi-account material-icons-name">Password</label>
            <input type="password" class="form-control" id="password" value="<?= $pelanggan["password"]; ?>">
        </div>

        <button type="submit" name="submit">Ubah Data!</button>
    </form>
</body>
</html>
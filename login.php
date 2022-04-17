<?php 
session_start();

if(isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
}

require 'functions.php'; 

if(isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $x = mysqli_query($conn, "SELECT * FROM pelanggan WHERE username = '$username'");
    $y = mysqli_query($conn, "SELECT * FROM pegawai WHERE username = '$username'");
    $z = mysqli_query($conn, "SELECT * FROM pemilik WHERE username = '$username'");
    
    // cek username
    if(mysqli_num_rows($x) === 1 ){
        // cek password 
        $row = mysqli_fetch_assoc($x);
        if(password_verify($password, $row["password"]) ) {
            // set session 
            $_SESSION["login"] = true;

            header("Location:pelanggan/index.php");
            exit;
        }
    } elseif(mysqli_num_rows($y) === 1 ){
        // cek password 
        $row = mysqli_fetch_assoc($y);
        if(password_verify($password, $row["password"]) ) {
            // set session 
            $_SESSION["login"] = true;

            header("Location:pegawai/index.php");
            exit;
        }
    } elseif(mysqli_fetch_assoc($z) === 1){
       // cek password 
       $row = mysqli_fetch_assoc($z);
       if(password_verify($password, $row["password"]) ) {
           // set session 
           $_SESSION["login"] = true;

           header("Location:pemilik/index.php");
           exit;
       } 
    }
    $error = true;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <!-- Sing in  Form -->
    <section class="sign-in">
        <div class="container my-5">
            <div class="signin-content">
                <div class="signin-image">
                    <figure><img src="images/signin-image.jpg" alt="sing up image"></figure>
                    <a href="registrasi.php" class="signup-image-link">Buat akun</a>
                </div>

                <div class="signin-form">
                    <h2 class="form-title">Masuk</h2>

                    <?php if(isset($error)) : ?>
                        <p style="color: red; font-style: italic">username / password salah!</p>
                    <?php endif; ?>

                    <form method="POST" class="login-form" id="login-form">
                        <div class="form-group">
                            <label for="username"><i class="zmdi zmdi-account material-icons-name"></i></label>
                            <input type="text" name="username" id="username" placeholder="Username" required/>
                        </div>
                        <div class="form-group">
                            <label for="your_pass"><i class="zmdi zmdi-lock"></i></label>
                            <input type="password" name="password" id="password" placeholder="Password" required/>
                        </div>
                        <div class="form-group form-button">
                            <input type="submit" name="signin" id="signin" class="form-submit" href="index.php" value="Masuk"/>
                            header
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
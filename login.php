<?php 
// // session_start();

// if(isset($_SESSION["login"])) {
//     header("Location: index.php");
//     exit;
// }

// require 'functions.php'; 

// if(isset($_POST["login"])) {
//     $username = $_POST["username"];
//     $password = $_POST["password"];

//     $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

//     // cek username
//     if(mysqli_num_rows($result) === 1 ){
//         // cek password 
//         $row = mysqli_fetch_assoc($result);
//         if(password_verify($password, $row["password"]) ) {
//             // set session 
//             $_SESSION["login"] = true;

//             header("Location: index.php");
//             exit;
//         }
//     }

//     $error = true;

// }
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

                    <form method="POST" class="register-form" id="login-form">
                        <div class="form-group">
                            <label for="nama"><i class="zmdi zmdi-account material-icons-name"></i></label>
                            <input type="text" name="nama" id="nama" placeholder="Nama Lengkap" required/>
                        </div>
                        <div class="form-group">
                            <label for="your_pass"><i class="zmdi zmdi-lock"></i></label>
                            <input type="password" name="password" id="password" placeholder="Password" required/>
                        </div>
                        <div class="form-group form-button">
                            <input type="submit" name="signin" id="signin" class="form-submit" value="Masuk"/>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
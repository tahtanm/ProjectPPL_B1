<?php 
// menghubungkan file functions dengan index

$conn = mysqli_connect("localhost", "root", "", "kres.co");

if(mysqli_connect_error()){
    echo "Koneksi gagal : " .mysqli_connect_error();
}

function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
    return $rows;
}

function ubah($data) {
    global $conn;

    // ambil data dari tiap elemen form
    // agar tag html tidak ter-eksekusi
    $id = $data["id"];
    $namaLengkap = htmlspecialchars($data["nama lengkap"]);
    $tempatLahir = htmlspecialchars($data["tempat lahir"]);
    $tanggalLahir = $data["tanggal lahir"];
    $jenisKelamin = htmlspecialchars($data["jenis kelamin"]);
    $alamat = htmlspecialchars($data["alamat"]);
    $noHP = htmlspecialchars($data["no hp"]);
    $email = htmlspecialchars($data["email"]);
    $username = $data["username"];
    $password = $data["password"]; 

    // query update data 
    $query = "UPDATE pelanggan SET 
                nama lengkap = '$namaLengkap',
                tempat lahir = '$tempatLahir',
                tanggal lahir = $tanggalLahir,
                jenis kelamin = '$jenisKelamin',
                alamat = '$alamat',
                no hp = '$noHP',
                email = '$email',
                username = '$username',
                password = '$password'
            WHERE id = $id
                ";
    
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function registrasi($data) {
    global $conn;

    $namaLengkap = $data(["nama lengkap"]);
    $tempatLahir = $data(["tempat lahir"]);
    $tanggalLahir = $data(["tanggal lahir"]);
    $jenisKelamin = $data(["jenis kelamin"]);
    $alamat = $data(["alamat"]);
    $noHP = $data(["no hp"]);
    $email = $data(["email"]);
    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);

    // cek username sudah ada atau belum
    $result = mysqli_query($conn, "SELECT username FROM pelanggan WHERE username = '$username'");
    if (mysqli_fetch_assoc($result)) {
        echo "
            <script>
                alert('Username sudah terdaftar!');
            </script>
            ";
            return false;
    } else 

    // cek konfirmasi password 
    if($password !== $password2) {
        echo "
            <script>
                alert('Konfirmasi password tidak sesuai!');
            </script>
            ";
        return false;
    } 

    // enkripsi password 
    // $password = password_hash($password, PASSWORD_DEFAULT);

    // tambah password kedalam database
    mysqli_query($conn, "INSERT INTO pelanggan VALUES('', '$namaLengkap', '$tempatLahir', '$tanggalLahir', '$jenisKelamin', '$alamat', '$noHP', '$email', '$username', '$password')");
    
    return mysqli_affected_rows($conn);
}
?>
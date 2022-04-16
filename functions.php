<?php 
// menghubungkan file functions dengan index

$conn = mysqli_connect("localhost", "root", "", "kres.co");

function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
    return $rows;
}


function tambah($data) {
    global $conn;
    // ambil data dari tiap elemen form
    // agar tag html tidak ter-eksekusi
    $nim = htmlspecialchars($data["nim"]);
    $nama = htmlspecialchars($data["nama"]);
    $email = htmlspecialchars($data["email"]);
    $jurusan = htmlspecialchars($data["jurusan"]);

    // upload gambar dulu 
    $gambar = upload();
    if(!$gambar) {
        return false;
    } 

    // query insert data
    $query = "INSERT INTO mahasiswa VALUES ('', '$nama', '$nim', '$email', '$jurusan', '$gambar')";
   
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function upload() {
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // cek apakah tidak ada gambar yang di upload 
    if($error === 4) {
        echo "
            <script>
                alert('Pilih Gambar Terlebih Dahulu!');
            </script>";
        return false;
    }

    // apakah yang diupload gambar atau bukan
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile); 
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if(!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "
            <script>
                alert('Yang Anda Upload Bukan Gambar!');
            </script>";
        return false;
    }

    // cek ukuran terlalu besar
    if($ukuranFile > 2000000) {
        echo "
            <script>
                alert('Ukuran Gambar Terlalu Besar!');
            </script>";
        return false;
    }

    // lolos ppengecekan & diupload
    // generate nama file gambar baru
    $namaFileBaru = uniqid();
    $namaFileBaru.='.';
    $namaFileBaru.= $ekstensiGambar;

    move_uploaded_file($tmpName, 'img/'.$namaFileBaru);
    return $namaFileBaru;
}


function hapus($id) {
    global $conn;

    // query delete data
    $query = "DELETE FROM mahasiswa WHERE id = $id";

    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function ubah($data) {
    global $conn;

    // ambil data dari tiap elemen form
    // agar tag html tidak ter-eksekusi
    $id = $data["id"];
    $nim = htmlspecialchars($data["nim"]);
    $nama = htmlspecialchars($data["nama"]);
    $email = htmlspecialchars($data["email"]);
    $jurusan = htmlspecialchars($data["jurusan"]);
    
    $gambarLama = htmlspecialchars($data["gambarLama"]);

    // cek apakah user memilih gambar baru atau tidak
    if($_FILES['gambar']['error'] === 4 ) {
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
    }

    // query update data 
    $query = "UPDATE mahasiswa SET 
                nama = '$nama',
                nim = '$nim',
                email = '$email',
                jurusan = '$jurusan',
                gambar = '$gambar'
            WHERE id = $id
                ";
    
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function cari($keyword) {
    $query = "SELECT * FROM mahasiswa WHERE nama LIKE '%$keyword%'
                OR nim = '%$keyword%'
                OR jurusan = '%$keyword%'";

    return query($query);
}

function registrasi($data) {
    global $conn;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);

    // cek username sudah ada atau belum
    $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");
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
    $password = password_hash($password, PASSWORD_DEFAULT);

    // tambah password kedalam database
    mysqli_query($conn, "INSERT INTO user VALUES('', '$username', '$password')");
    
    return mysqli_affected_rows($conn);
}
?>
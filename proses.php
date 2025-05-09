<?php
$koneksi = new mysqli("localhost", "root", "", "uji_sql");

if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

$username = $_POST['username'];
$password = $_POST['password'];

// Daftar pola karakter berbahaya
$pola_berbahaya = ["'", "\"", "--", "UNION", "SELECT", "OR", "AND", "#", ";"];

// Cek apakah input mengandung pola mencurigakan
foreach ($pola_berbahaya as $pola) {
    if (stripos($username, $pola) !== false || stripos($password, $pola) !== false) {
        die("Masukan tidak valid, terdeteksi karakter mencurigakan.");
    }
}

// Query SQL rentan (untuk keperluan simulasi)
$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
$hasil = $koneksi->query($query);

if ($hasil->num_rows > 0) {
    echo "Login berhasil!";
} else {
    echo "Login gagal!";
}

$koneksi->close();
?>

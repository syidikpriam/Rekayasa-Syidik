<?php
// Fungsi untuk koneksi ke database
function connectToDB() {
    $servername = "localhost"; // Ganti sesuai dengan server database Anda
    $username = "root"; // Ganti sesuai dengan username database Anda
    $password = ""; // Ganti sesuai dengan password database Anda
    $dbname = "rekayasa"; // Ganti sesuai dengan nama database Anda

    // Buat koneksi
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Periksa koneksi
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    return $conn;
}
?>

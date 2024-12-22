<?php
session_start();

// Koneksi ke database
$host = "localhost";
$user = "root";
$password = "";
$database = "poliklinikbk";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Cek jika form login dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $passwordDokter = $_POST['passwordDokter'];

    // Query untuk mencocokkan data pasien
    $sql = "SELECT * FROM dokter WHERE nama = ? AND passwordDokter = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $nama, $passwordDokter);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Login berhasil, set session
        $_SESSION['nama'] = $nama;
        header("Location: Dashboard-Dokter.html"); // Redirect ke halaman dashboard
        exit;
    } else {
        // Login gagal
        echo "<script>alert('Nama atau password salah!'); window.location.href = 'Login-Dokter.php';</script>"; // Redirect ke halaman login
    }
    

    $stmt->close();
}

$conn->close();
?>

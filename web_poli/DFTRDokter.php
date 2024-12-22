<?php
// Konfigurasi database
$servername = "localhost";
$username = "root"; // Ganti dengan username database kamu
$password = ""; // Ganti dengan password database kamu
$dbname = "poliklinikbk"; // Ganti dengan nama database kamu

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Mendapatkan data dari form
$nama = $_POST['nama'];
$passwordDokter = $_POST['passwordDokter'];
$alamat = $_POST['alamat'];
$no_hp = $_POST['no_hp'];
$id_poli = $_POST['id_poli'];

// Menyiapkan SQL untuk memasukkan data
$sql = "INSERT INTO dokter (nama, passwordDokter, alamat, no_hp, id_poli) VALUES ('$nama', '$passwordDokter','$alamat', '$no_hp', '$id_poli')";

if ($conn->query($sql) === TRUE) {
    echo "Data berhasil disimpan!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Menutup koneksi
$conn->close();
?>

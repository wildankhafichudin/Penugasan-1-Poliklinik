<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Poliklinik - Edit Dokter</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            display: flex;
            min-height: 100vh;
            background-color: #f4f4f9;
            color: #333;
        }

        .sidebar {
            width: 250px;
            background-color:rgb(0, 56, 115);
            color: #fff;
            display: flex;
            flex-direction: column;
            padding: 20px;
        }

        .sidebar h2 {
            padding-top: 5px;
            text-align: left;
            margin-bottom: 30px;
        }

        .sidebar a {
            text-decoration: none;
            color: #fff;
            margin: 10px 0;
            padding: 5px;
            border-radius: 5px;
            display: block;
            transition: background-color 0.3s;
        }

        .sidebar a:hover {
            background-color: #007bff;
        }

        .main-content {
            flex-grow: 1;
            padding: 20px;
        }

        .main-content h1 {
            margin-bottom: 20px;
        }

        .form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            width: 100%;
            margin: 20px auto;
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-container form {
            display: flex;
            flex-direction: column;
        }

        .form-container label {
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-container input,
        .form-container select {
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .button-container {
            display: flex;
            justify-content: space-between;
        }

        .btn-update {
            background-color: #0056b3;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 10%;
        }

        .btn-update:hover {
            background-color: #007bff;
        }

        .btn-delete {
            background-color: #b30000;
            margin-right: auto;
            margin-left: 10px;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 10%;
        }

        .btn-delete:hover {
            background-color: #ff0000; /* Merah cerah */
        }

        .table-container {
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        table, th, td {
            border: 1px solid #ccc;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        tr:hover {
            background-color:rgb(255, 255, 255);
            cursor: pointer;
        }
    </style>
    <script>
        function populateForm(id, nama_obat, kemasan, harga) {
            document.getElementById("id").value = id;
            document.getElementById("nama_obat").value = nama_obat;
            document.getElementById("kemasan").value = kemasan;
            document.getElementById("harga").value = harga;
        }
    </script>
</head>
<body>
    <div class="sidebar">
        <h2>Project Poliklinik</h2>
        <a href="Dashboard-Admin.html">Dashboard</a>
        <a href="Dokter.php">Dokter</a>
        <a href="Poli.php">Poli</a>
        <a href="Pasien.php">Pasien</a>
        <a href="Obat.php">Obat</a>
        <a href="#logout">Logout</a>
    </div>
    <div class="main-content">
        <h1>Kelola Data Obat</h1>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Obat</th>
                        <th>Kemasan</th>
                        <th>Harga</th>
                    </tr>
                </thead>
                <tbody>
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

                    // Mengambil data dari tabel obat
                    $sql = "SELECT id, nama_obat, kemasan, harga FROM obat";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // Output data setiap baris
                        while($row = $result->fetch_assoc()) {
                            echo "<tr onclick=\"populateForm('".$row['id']."', '".$row['nama_obat']."', '".$row['kemasan']."', '".$row['harga']."')\">
                                    <td>".$row["id"]."</td>
                                    <td>".$row["nama_obat"]."</td>
                                    <td>".$row["kemasan"]."</td>
                                    <td>".$row["harga"]."</td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>Tidak ada data</td></tr>";
                    }

                    // Menutup koneksi
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
        <div class="form-container">
            <form action="EDTObat.php" method="POST">
                <label for="id">ID:</label>
                <input type="text" id="id" name="id" placeholder="ID" readonly>

                <label for="nama_obat">Nama Obat:</label>
                <input type="text" id="nama_obat" name="nama_obat" placeholder="Masukkan Nama Obat" required>

                <label for="kemasan">Kemasan:</label>
                <select id="kemasan" name="kemasan" required>
                    <option value="" disabled selected>Pilih Jenis Kemasan</option>
                    <option value="Ampul">Ampul</option>
                    <option value="Blister">Blister</option>
                    <option value="Botol">Botol</option>
                    <option value="Sachet">Sachet</option>
                    <option value="Strip">Strip</option>
                    <option value="Vial">Vial</option>
                </select>

                <label for="harga">Harga:</label>
                <input type="text" id="harga" name="harga" placeholder="Masukkan Harga Obat" required>

                <div class="button-container">
                    <button type="submit" class="btn-update" name="update" value="update">Update</button>
                    <button type="submit" class="btn-delete" name="delete" value="delete">Delete</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
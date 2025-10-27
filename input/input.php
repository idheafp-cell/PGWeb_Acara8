<?php 
$kecamatan = $_POST['kecamatan']; 
$longitude = $_POST['longitude']; 
$latitude = $_POST['latitude'];
$luas = $_POST['luas']; 
$jumlah_penduduk = $_POST['jumlah_penduduk'];

// Sesuaikan dengan setting MySQL 
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "pgweb_acara8"; 

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname); 

// Cek koneksi
if ($conn->connect_error) { 
    die("Connection failed: " . $conn->connect_error); 
} 

$sql = "INSERT INTO data_kecamatan (kecamatan, longitude, latitude, luas, jumlah_penduduk) 
VALUES ('$kecamatan', $longitude, $latitude, $luas, $jumlah_penduduk)"; 

// Menyimpan data dan memeriksa apakah berhasil
if ($conn->query($sql) === TRUE) { 
    $massage = "Rekord berhasil ditambahkan"; 
} else { 
    $massage = "Error: " . $sql . "<br>" . $conn->error; 
} 

// Menutup koneksi
$conn->close(); 


header("Location: ../index.php"); 
?> 
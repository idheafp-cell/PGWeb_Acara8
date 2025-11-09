<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Kecamatan</title>

    <style>
        body {
            background: #e8f5e4;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding: 10px;
        }

        .container {
            background: #ffffff;
            width: 60%;
            max-width: 300px;
            padding: 40px;
            border-radius: 18px;
        }

        h2 {
            text-align: center;
            color: #2d5f2e;
            font-size: 20px;
            margin-bottom: 20px;
            font-weight: 700;
        }

        .form-group {
            margin-bottom: 10px;
            text-align: center;
        }

        label {
            display: block;
            font-size: 16px;
            font-weight: 600;
            color: #285728;
            margin-bottom: 3px;
        }

        .form-control {
            width: 100%;
            max-width: 300px;
            margin: 0 auto;
            display: block;
            padding: 12px;
            border-radius: 10px;
            border: 1px solid #cddfcf;
            font-size: 16px;
            box-sizing: border-box;
        }

        .form-control:focus {
            border-color: #5aa85a;
            outline: none;
        }

        .submit-btn {
            width: 100%;
            max-width: 300px;
            margin-top: 20px;
            padding: 14px;
            background: #58b45b;
            color: #ffffff;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            display: block;
        }

        .submit-btn:hover {
            background: #4ca54e;
        }
    </style>
</head>

<body>

<?php
$id = $_GET['id'];

$conn = new mysqli("localhost", "root", "", "pgweb_acara8");
$sql = "SELECT * FROM data_kecamatan WHERE id = $id";
$result = $conn->query($sql);
$data = $result->fetch_assoc();
?>

<div class="container">
    <h2>Edit Data Kecamatan</h2>

    <form action="edit.php" method="post">

        <input type="hidden" name="id" value="<?= $data['id'] ?>">

        <div class="form-group">
            <label>Kecamatan</label>
            <input type="text" name="kecamatan" class="form-control" value="<?= $data['kecamatan'] ?>" required>
        </div>

        <div class="form-group">
            <label>Longitude</label>
            <input type="text" name="longitude" class="form-control" value="<?= $data['longitude'] ?>" required>
        </div>

        <div class="form-group">
            <label>Latitude</label>
            <input type="text" name="latitude" class="form-control" value="<?= $data['latitude'] ?>" required>
        </div>

        <div class="form-group">
            <label>Luas</label>
            <input type="number" name="luas" class="form-control" value="<?= $data['luas'] ?>" required>
        </div>

        <div class="form-group">
            <label>Jumlah Penduduk</label>
            <input type="number" name="jumlah_penduduk" class="form-control" value="<?= $data['jumlah_penduduk'] ?>" required>
        </div>

        <button type="submit" class="submit-btn">Simpan Perubahan</button>
    </form>
</div>

</body>
</html>

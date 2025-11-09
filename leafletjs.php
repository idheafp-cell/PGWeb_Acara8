<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Web Map</title>

  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

  <style>
    html, body {
      height: 100%;
      width: 100%;
      margin: 0;
      background-color: #edf7e7;
    }

    /* Judul */
    h1 {
      text-align: center;
      margin: 20px;
      padding-bottom: 12px;
      font-size: 26px;
      color: #2f5530;
      border-bottom: 2px solid #cfe6c6;
      letter-spacing: 0.5px;
    }

    /* Layout */
    .container {
      display: flex;
      height: calc(100vh - 90px);
      padding: 0 20px 20px;
      gap: 20px;
      box-sizing: border-box;
    }

    /* Area tabel */
    .table-container {
      width: 50%;
      background: white;
      padding: 20px;
      border-radius: 12px;
      border: 1px solid #d6e7d2;
      overflow-y: auto;
    }

    .table-container h2 {
      margin-top: 0;
      font-size: 20px;
      color: #2f5530;
      font-weight: 600;
    }

    /* Tabel */
    table {
      width: 100%;
      border-collapse: collapse;
      font-size: 14px;
    }

    th {
      background-color: #a9d9a3;
      color: #1d321f;
      padding: 10px;
      font-weight: bold;
      border: 1px solid #9dc596;
    }

    td {
      padding: 10px;
      border: 1px solid #d0e4c8;
      background-color: white;
    }


    /* Tombol */
    .btn {
      padding: 6px 10px;
      font-size: 12px;
      cursor: pointer;
      border: none;
      border-radius: 6px;
      color: white;
      transition: 0.25s;
    }

    .btn-edit {
      background-color: #4e8d51;
    }

    .btn-edit:hover {
      background-color: #3d7041;
    }

    .btn-delete {
      background-color: #d9534f;
    }

    .btn-delete:hover {
      background-color: #b33e3b;
    }

    /* Tombol Input Data */
    .input-button-wrapper {
      margin-top: 15px;
      text-align: right;
    }

    .btn-input {
      background-color: #63b567;
      color: white;
      padding: 8px 14px;
      font-size: 14px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      transition: 0.25s;
      font-weight: 600;
    }

    .btn-input:hover {
      background-color: #4a8f4d;
    }

    /* Peta */
    #map {
      width: 50%;
      height: 100%;
      border-radius: 12px;
      border: 1px solid #bcdcb4;
      box-shadow: 0 4px 12px rgba(0,0,0,0.12);
    }
  </style>
</head>

<body>

<h1>PETA KABUPATEN SLEMAN</h1>

<div class="container">

  <!-- TABEL -->
  <div class="table-container">
    <h2>Data Kecamatan</h2>

    <table>
      <thead>
        <tr>
          <th>No</th>
          <th>Kecamatan</th>
          <th>Longitude</th>
          <th>Latitude</th>
          <th>Luas</th>
          <th>Jumlah Penduduk</th>
          <th colspan='2'>Aksi</th>
        </tr>
      </thead>

      <tbody>
        <?php
        $conn = new mysqli("localhost", "root", "", "pgweb_acara8");
        if ($conn->connect_error) die("Koneksi gagal: ".$conn->connect_error);

        $sql = "SELECT * FROM data_kecamatan";
        $result = $conn->query($sql);

        $locations = [];
        $no = 1;

        if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>".$no++."</td>";
            echo "<td>".$row['kecamatan']."</td>";
            echo "<td>".$row['longitude']."</td>";
            echo "<td>".$row['latitude']."</td>";
            echo "<td>".$row['luas']."</td>";
            echo "<td>".$row['jumlah_penduduk']."</td>";
            echo "<td><button class='btn btn-edit' onclick=\"window.location='edit/index.php?id=".$row['id']."'\">Edit</button></td>";
            echo "<td><button class='btn btn-delete' onclick=\"if(confirm('Hapus data ini?')) window.location='delete.php?id=".$row['id']."'\">Hapus</button></td>";

            echo "</tr>";

            $locations[] = [
              'nama' => $row['kecamatan'],
              'lat' => floatval($row['latitude']),
              'lng' => floatval($row['longitude'])
            ];
          }
        }
        ?>
      </tbody>
    </table>

    <!-- TOMBOL INPUT DATA -->
    <div class="input-button-wrapper">
      <button class="btn-input" onclick="window.location='input/index.html'">
        + Input Data
      </button>
    </div>

    <?php
      echo "<script>var dataKecamatan = ".json_encode($locations).";</script>";
      $conn->close();
    ?>

  </div>

  <!-- MAP -->
  <div id="map"></div>

</div>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
  var map = L.map("map").setView([-7.7560352625, 110.2964378373], 12);

  L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
    attribution: '© OpenStreetMap'
  }).addTo(map);

  dataKecamatan.forEach(function(loc) {
    L.marker([loc.lat, loc.lng]).addTo(map)
      .bindPopup("<b>" + loc.nama + "</b>");
  });
</script>

</body>
</html>

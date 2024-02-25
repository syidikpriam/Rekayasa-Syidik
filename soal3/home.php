<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Home</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .home-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
            position: relative;
        }
        h2 {
            text-align: center;
        }
        .prayer-times {
            text-align: center;
        }
        .logout-btn {
            position: absolute;
            top: 20px;
            left: 20px;
        }
    </style>
</head>
<body>

<div class="logout-btn">
<?php 
include 'sidebar.php'; ?>
</div>

<div class="home-container">
    <h2>Selamat Datang di Halaman Home</h2>
    <div class="prayer-times">
        <?php
        // Ganti koordinat latitude dan longitude sesuai lokasi Anda
        $latitude = "-6.19533371362355";
        $longitude = "106.82492055097316";
        $method = "2"; // Metode perhitungan waktu sholat: 2 (ISNA)

        $url = "https://api.aladhan.com/v1/calendar?latitude=$latitude&longitude=$longitude&method=$method";
        $response = file_get_contents($url);

        if ($response !== false) {
            $data = json_decode($response, true);
            $prayer_times = $data['data'][date('j') - 1]['timings']; // Mengambil waktu sholat hari ini

            echo "<h3>Waktu Sholat Hari Ini:</h3>";
            echo "<p>Subuh: " . $prayer_times['Fajr'] . "</p>";
            echo "<p>Zuhur: " . $prayer_times['Dhuhr'] . "</p>";
            echo "<p>Asar: " . $prayer_times['Asr'] . "</p>";
            echo "<p>Maghrib: " . $prayer_times['Maghrib'] . "</p>";
            echo "<p>Isya: " . $prayer_times['Isha'] . "</p>";
        } else {
            echo "Error: Gagal mendapatkan data waktu sholat.";
        }
        ?>
    </div>
</div>

</body>
</html>

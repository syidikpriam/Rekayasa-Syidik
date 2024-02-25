<!DOCTYPE html>
<html>
<head>
    <title>Menampilkan Bilangan Tanpa Angka Tertentu</title>
</head>
<body>
    <h2>Menampilkan Bilangan Tanpa Angka Tertentu</h2>
    <form method="post">
        <label for="start">Bilangan awal:</label><br>
        <input type="text" id="start" name="start"><br>
        <label for="end">Bilangan akhir:</label><br>
        <input type="text" id="end" name="end"><br>
        <label for="forbidden">Angka yang tidak tampil (0-9):</label><br>
        <input type="text" id="forbidden" name="forbidden"><br><br>
        <input type="submit" value="Generate">
    </form>
    <br>

    <?php
    function containsForbiddenDigit($number, $forbiddenDigit) {
        $digits = str_split((string) $number);
        foreach ($digits as $digit) {
            if ($digit == $forbiddenDigit) {
                return true;
            }
        }
        return false;
    }

    function generateNumbers($start, $end, $forbiddenDigit) {
        $result = array();
        for ($i = $start; $i <= $end; $i++) {
            if (!containsForbiddenDigit($i, $forbiddenDigit)) {
                $result[] = $i;
            }
        }
        return $result;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $start = $_POST['start'];
        $end = $_POST['end'];
        $forbiddenDigit = $_POST['forbidden'];

        $numbers = generateNumbers($start, $end, $forbiddenDigit);

        echo "<h2>Hasil:</h2>";
        echo implode(" ", $numbers);
    }
    ?>
</body>
</html>

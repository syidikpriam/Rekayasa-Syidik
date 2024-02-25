<!DOCTYPE html>
<html>
<head>
    <title>Urutan Fibonacci</title>
</head>
<body>
    <h2>Membuat Urutan Fibonacci</h2>
    <form method="post">
        <label for="input">Masukkan jumlah urutan Fibonacci:</label><br>
        <input type="text" id="input" name="input"><br><br>
        <input type="submit" value="Generate">
    </form>
    <br>

    <?php
    function fibonacci($n) {
        $fib = [0, 1];
        for ($i = 2; $i <= $n; $i++) {
            $fib[$i] = $fib[$i - 1] + $fib[$i - 2];
        }
        return $fib;
    }

    function isEven($num) {
        return $num % 2 == 0 ? 'Genap' : 'Ganjil';
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $input = $_POST['input'];
        $sequence = fibonacci($input);

        echo "<h2>Hasil:</h2>";
        for ($i = 0; $i < $input; $i++) {
            echo "F$i = {$sequence[$i]} (" . isEven($sequence[$i]) . ")" . "<br>";
        }
    }
    ?>
</body>
</html>

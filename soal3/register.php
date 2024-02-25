<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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
        .register-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"],
        input[type="password"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .error {
            color: red;
            margin-top: -10px;
            margin-bottom: 10px;
            text-align: center;
        }
        .success {
            color: green;
            margin-top: -10px;
            margin-bottom: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h2>Register</h2>
        <form method="post">
            <label for="name">Nama:</label>
            <input type="text" id="name" name="name">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username">
            <label for="email">Email:</label>
            <input type="text" id="email" name="email">
            <label for="phone">Nomor HP:</label>
            <input type="text" id="phone" name="phone">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password">
            <input type="submit" value="Register">
        </form>
        <?php include 'db_connection.php';

 
        function registerUser($conn, $name, $username, $email, $phone, $password) {
            $sql = "INSERT INTO users (name, username, email, phone, password) VALUES ('$name', '$username', '$email', '$phone', '$password')";
            if ($conn->query($sql) === TRUE) {
                return true; 
            } else {
                return false; 
            }
        }


        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $_POST['name'];
            $username = $_POST['username'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $password = $_POST['password'];

            $conn = connectToDB();

            if (registerUser($conn, $name, $username, $email, $phone, $password)) {
                echo "<p class='success'>Registrasi berhasil! Silakan <a href='index.php'>login</a>.</p>";
            } else {
                echo "<p class='error'>Registrasi gagal. Silakan coba lagi.</p>";
            }


            $conn->close();
        }
        ?>
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar</title>
    <link rel="stylesheet" href="style.css"> <!-- Panggil file style.css -->
    <style>
        .sidebar {
            height: 100%;
            width: 0;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #f4f4f4;
            overflow-x: hidden;
            transition: 0.5s;
            padding-top: 60px;
        }

        .sidebar a {
            padding: 10px;
            text-decoration: none;
            display: block;
            color: #333;
            transition: 0.3s;
        }

        .sidebar a:hover {
            background-color: #ddd;
        }

        .sidebar .closebtn {
            position: absolute;
            top: 10px;
            left: 10px; /* Posisikan di pojok kiri atas */
            font-size: 36px;
            margin-left: 50px;
        }

        #main-content {
            transition: margin-left 0.5s;
            padding: 16px;
        }
    </style>
</head>
<body>
    <div class="sidebar" id="sidebar">
        <!-- Tautan menu -->
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <a href="tasks.php">Tasks</a>
        <a href="home.php">Home</a>
        <a href="index.php">Logout</a>
    </div>

    <div id="main-content">
        <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; </span>
    </div>

    <script>
        function openNav() {
            document.getElementById("sidebar").style.width = "250px";
            document.getElementById("main-content").style.marginLeft = "250px";
        }

        function closeNav() {
            document.getElementById("sidebar").style.width = "0";
            document.getElementById("main-content").style.marginLeft= "0";
        }
    </script>
</body>
</html>

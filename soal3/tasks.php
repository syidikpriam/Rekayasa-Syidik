<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Kegiatan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        h2 {
            margin-bottom: 20px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        form {
            margin-bottom: 20px;
        }
        form label {
            display: block;
            margin-bottom: 5px;
        }
        form input[type="text"],
        form select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        form input[type="submit"] {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #4caf50;
            color: #fff;
            cursor: pointer;
        }
        form input[type="submit"]:hover {
            background-color: #45a049;
        }
        .edit-delete-links a {
            text-decoration: none;
            margin-right: 5px;
            color: #333;
        }
        .edit-delete-links a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<?php
include 'sidebar.php';

$servername = "localhost"; 
$username = "root";
$password = ""; 
$dbname = "rekayasa"; 


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}


function clean_input($data) {
    global $conn;
    return mysqli_real_escape_string($conn, htmlspecialchars($data));
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['create'])) {
    $title = clean_input($_POST['title']);
    $status = clean_input($_POST['status']);

    $sql_insert_data = "INSERT INTO tasks (title, status) VALUES ('$title', '$status')";
    if ($conn->query($sql_insert_data) === TRUE) {
        echo "<p>Data berhasil ditambahkan.</p>";
    } else {
        echo "<p>Error: " . $sql_insert_data . "<br>" . $conn->error . "</p>";
    }
}

// Read
$sql_select_tasks = "SELECT * FROM tasks";
$result = $conn->query($sql_select_tasks);

if ($result->num_rows > 0) {
    echo "<h2>Daftar Task Kegiatan</h2>";
    echo "<table>";
    echo "<tr><th>Title</th><th>Status</th><th>Action</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["title"] . "</td><td>" . $row["status"] . "</td><td class='edit-delete-links'><a href='?edit=".$row["id"]."'>Edit</a> | <a href='?delete=".$row["id"]."' onclick=\"return confirm('Apakah Anda yakin ingin menghapus data ini?')\">Delete</a></td></tr>";
    }
    echo "</table>";
} else {
    echo "Tidak ada data task kegiatan.";
}

// Update
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $id = clean_input($_POST['id']);
    $title = clean_input($_POST['title']);
    $status = clean_input($_POST['status']);

    $sql_update_data = "UPDATE tasks SET title='$title', status='$status' WHERE id=$id";
    if ($conn->query($sql_update_data) === TRUE) {
        echo "<p>Data berhasil diperbarui.</p>";
    } else {
        echo "<p>Error: " . $sql_update_data . "<br>" . $conn->error . "</p>";
    }
}

// Edit
if (isset($_GET['edit'])) {
    $edit_id = $_GET['edit'];
    $sql_edit_data = "SELECT * FROM tasks WHERE id=$edit_id";
    $result = $conn->query($sql_edit_data);
    $row = $result->fetch_assoc();
    ?>
    <h2>Edit Task</h2>
    <form method="post">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <label>Title:</label>
        <input type="text" name="title" value="<?php echo $row['title']; ?>"><br>
        <label>Status:</label>
        <select name="status">
            <option value="Open" <?php if ($row['status'] == 'Open') echo 'selected'; ?>>Open</option>
            <option value="On Progress" <?php if ($row['status'] == 'On Progress') echo 'selected'; ?>>On Progress</option>
            <option value="Done" <?php if ($row['status'] == 'Done') echo 'selected'; ?>>Done</option>
            <option value="Canceled" <?php if ($row['status'] == 'Canceled') echo 'selected'; ?>>Canceled</option>
        </select><br><br>
        <input type="submit" name="update" value="Update">
    </form>
<?php
}

// Delete
if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $sql_delete_data = "DELETE FROM tasks WHERE id=$delete_id";
    if ($conn->query($sql_delete_data) === TRUE) {
        echo "<p>Data berhasil dihapus.</p>";
    } else {
        echo "<p>Error: " . $sql_delete_data . "<br>" . $conn->error . "</p>";
    }
}


$conn->close();
?>
<h2>Tambah Task Baru</h2>
<form method="post">
    <label>Title:</label>
    <input type="text" name="title"><br>
    <label>Status:</label>
    <select name="status">
        <option value="Open">Open</option>
        <option value="On Progress">On Progress</option>
        <option value="Done">Done</option>
        <option value="Canceled">Canceled</option>
    </select><br><br>
    <input type="submit" name="create" value="Create">
</form>

</body>
</html>

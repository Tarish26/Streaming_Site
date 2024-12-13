<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: index.php"); 
    exit;
}

if ($_SESSION['Email'] !== 'tarishsharma@skiff.com') {
    header("Location: index.php");
    exit;
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ltanime";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    $imgPath = 'Image/' . basename($_FILES['imgPath']['name']);
    $videoPath = 'videos/' . basename($_FILES['videoPath']['name']);
    $subtitlePath = 'subtitles/' . basename($_FILES['subtitlePath']['name']);

    if (move_uploaded_file($_FILES['imgPath']['tmp_name'], $imgPath) &&
        move_uploaded_file($_FILES['videoPath']['tmp_name'], $videoPath) &&
        move_uploaded_file($_FILES['subtitlePath']['tmp_name'], $subtitlePath)) {

        $sql = "INSERT INTO movie (Name, Description, ImgPath, VidPath, SubPath)
                VALUES ('$name', '$description', '$imgPath', '$videoPath', '$subtitlePath')";

        if (mysqli_query($conn, $sql)) {
            echo "New movie added successfully";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } else {
        echo "Error uploading files.";
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Movie</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 50%;
            margin: auto;
            overflow: hidden;
        }
        #main-header {
            background-color: #333;
            color: #fff;
            padding-top: 30px;
            min-height: 70px;
            border-bottom: #77aaff 3px solid;
        }
        #main-header h1 {
            text-align: center;
            text-transform: uppercase;
            margin: 0;
            font-size: 24px;
        }
        #main-form {
            background: #fff;
            padding: 20px;
            margin-top: 20px;
            border: 1px solid #ccc;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
        }
        .form-group button {
            display: block;
            width: 100%;
            padding: 10px;
            background: #333;
            color: #fff;
            border: none;
        }
        .form-group button:hover {
            background: #77aaff;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <header id="main-header">
        <div class="container">
            <h1>Add New Movie</h1>
        </div>
    </header>
    <div class="container">
        <form id="main-form" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Movie Name</label>
                <input type="text" name="name" id="name" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" rows="5" required></textarea>
            </div>
            <div class="form-group">
                <label for="imgPath">Image</label>
                <input type="file" name="imgPath" id="imgPath" required>
            </div>
            <div class="form-group">
                <label for="videoPath">Video</label>
                <input type="file" name="videoPath" id="videoPath" required>
            </div>
            <div class="form-group">
                <label for="subtitlePath">Subtitles</label>
                <input type="file" name="subtitlePath" id="subtitlePath" required>
            </div>
            <div class="form-group">
                <button type="submit">Add Movie</button>
            </div>
        </form>
    </div>
</body>
</html>

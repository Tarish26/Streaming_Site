<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "ltanime";

    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if (isset($_POST["submit"]) && isset($_POST["Name"]) && isset($_POST["Email"]) && isset($_POST["Password"])) {
        $name = mysqli_real_escape_string($conn, $_POST["Name"]);
        $email = mysqli_real_escape_string($conn, $_POST["Email"]);
        $password = mysqli_real_escape_string($conn, $_POST["Password"]);
       

        $sql = "INSERT INTO user (Name, Email, Password) VALUES ('$name', '$email', '$password')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            header("Location:index.php");
            echo"registration sucessful";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }

    mysqli_close($conn);
?>

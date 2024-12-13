<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ltanime";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$fileid = isset($_GET['fileid']) ? htmlspecialchars($_GET['fileid']) : null;

if ($fileid !== null) {
    $stmt = $conn->prepare("SELECT * FROM movie WHERE Id = ?");
    $stmt->bind_param("s", $fileid);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($row['VidPath']) {
            $filepath = 'videos/' . htmlspecialchars($row['VidPath']);
            $subpath = 'subtitles/' . htmlspecialchars($row['SubPath']);
 
            header('Content-Type: text/html');

            echo '<video id="player" width="100%" height="100%" controls>';
            echo '<source src="' . $filepath . '" type="video/mp4" />';
            
            if (!empty($row['SubPath']) && file_exists($subpath)) {
                echo '<track src="' . $subpath . '" kind="subtitles" srclang="en" label="English" default>';
            }
            echo '</video>';
        } else {
            echo 'Invalid filename.';
        }
    } else {
        echo 'No record found for the given file ID.';
    }

    $stmt->close();
} else {
    echo 'File ID is not specified.';
}

$conn->close();
?>

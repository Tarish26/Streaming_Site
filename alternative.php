<?php
session_start(); 


if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
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

$user_email = $_SESSION['Email'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SoloWatch</title>

    <link
  rel="stylesheet"
  href="https://unpkg.com/swiper@7/swiper-bundle.min.css"
/>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


    <link rel="stylesheet" href="alternative.css">

</head>
<body>


    <header>
        <a href="#" class="logo">SoloWatch</a>
        <nav class="navbar">
             <a href="alternative.php">Home</a>
             <a href="#anime">Anime</a>
             <a href="#action">Most Popular</a>
             <a href="#family">Top Airing</a>
        </nav>
        <div class="icons">
            <i class="fas fa-bars" id="menu-bars"></i>
            <i class="fas fa-search" id="search-icon"></i>
            <a href="#" class="fas fa-heart"></a>
            <a href="logout.php" class="fa-solid fa-right-to-bracket"></a>
            <?php
           
                if ($user_email === 'tarishsharma@skiff.com') {
                    echo '<a href="add.php" class="fa-solid fa-pen-to-square"></a>';
                }
            ?>
        </div>
    </header>



<section class="home" id="home">

  

        <div class="swiper-wrapper">

            <div class="swiper-slide">
                <div class="box " style="background: url(image/yourname.jpg) no-repeat;background-size: cover;">
                    <div class="content">
                        <h3>Your Name</h3>
                        <p>Two teenagers share a profound, magical connection upon discovering they are swapping bodies. 
                            Things manage to become even more complicated when the boy and girl decide to meet in person.</p>
                     
                        <a href="stream.php?fileid=1" class="btn">Stream</a>
                    </div>
                </div>
            </div>

       
    </div>

</section>



<section class="anime" id="anime">
    <h1 class="heading">Anime</h1>
    <div class="swiper anime-slider">
        <div class="swiper-wrapper">
                 <?php
                   
                    $sql = "SELECT * FROM movie";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_array($result)) {
                            echo'<div class="swiper-slide">';
                                echo'<div class="box" style="background: url('.$row['ImgPath'].') no-repeat;background-size: cover;"></div>';
                                echo'<div class="content">';
                                    echo "<h3>" . $row['Name'] . "</h3>";
                                    echo "<p>" . $row['Description'] . "</p>";
                                    echo '<a href="stream.php?fileid=' . $row['Id'] . '" class="btn">Stream</a>';
                                echo"</div>";
                            echo"</div>";
                        }
                    }
                ?>

            
        </div>
    </div>
</section>

<div class="copyright container">
    <a href="#" class="logo">SoloWatch</a>
    <p>&#169; SoloWatch. All rights reserved.</p>
</div>


 <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js" defer data-deferred="1"></script>  <script src="main.js" defer data-deferred="1"></script> </body>
</html>
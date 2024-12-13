<?php
    session_start();
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "ltanime";

    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
        header("Location: alternative.php");
    exit;
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="index.css">
    <title>SoloWatch</title>
</head>

<body>

    <div class="container" id="container">
        <div class="form-container sign-up">
            <form action="signup.php" method="post">
                <h1>Create Account</h1>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
                <span>or use your email for registeration</span>
                <input type="text" name="Name" placeholder="Name" required>
                <input type="email" name="Email" placeholder="Email" required>
                <input type="password" name="Password" placeholder="Password" required>
                <input type="submit" name="submit" value="Sign Up">
            </form>
        </div>
        <div class="form-container sign-in">
            <form action="index.php" method="post">
                <h1>Sign In</h1>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
                <span>or use your email password</span>
                <input type="email" name="Email" placeholder="Email" required>
                <input type="password" name="Password" placeholder="Password" required>
                <a href="#">Forget Your Password?</a>
                <?php
                       if (isset($_POST["submit"]) && isset($_POST["Email"]) && isset($_POST["Password"])) {
                            $email = mysqli_real_escape_string($conn, $_POST["Email"]);
                            $password = mysqli_real_escape_string($conn, $_POST["Password"]);
                            $sql = "SELECT * FROM user WHERE Email='$email' && Password='$password'";
                            $result = mysqli_query($conn, $sql);
                    
                            if ($result && mysqli_num_rows($result)>0) {
                                $_SESSION['loggedin'] = true;
                                $_SESSION['Email']=$email;
                                header("Location:alternative.php");
                            } else {
                                echo"<span>Invalid Email or Password</span>";
                            }
                        }
            
                    mysqli_close($conn);
                ?>

                <input type="submit" name="submit" value="Sign in">
                
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>SoloWatch</h1>
                    <p>Register with your personal details to use all of site features</p>
                    <button class="hidden" id="login">Sign In</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>SoloWatch</h1>
                    <p>Enter your personal details to use all of site features</p>
                    <button class="hidden" id="register">Sign Up</button>
                </div>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
</body>

</html>
<?php

/*
Functionality: This file handles user authentication and allows users
 to log in to the system. It verifies the provided credentials
 and generates a session token to authenticate subsequent requests.

*/

?>

<!DOCTYPE html>
<html>
<head>
    <title>User Login</title>
    <link rel="stylesheet" type="text/css" href="../css/register.css">
</head>
<body>
    <img src="../images/Login-amico.png" alt="">
    <marquee behavior="" direction="" id="marquee"><h1>Agric. Extension Services</h1></marquee>
    <div class="container">
        <h2>User Login</h2>
        <form action="login.php" method="POST">
           
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Enter Username" required>
            </div>
            
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter Password" required>
            </div>
            
          
            <button type="submit" class="btn">Login</button>
            <p>Don't Have an Account? Register <a href="register.php">Here</a></p>
            <p>Forgot Password? Click<a href="forgot_password.php">Here</a></p>
        </form>
    </div>
</body>
</html>

<?php
/*
Functionality: This file allows users (extension officers, farmers,
 and administrators) to register their accounts by providing necessary 
 information such as full_name, username, email, password, and user type. It 
validates the input data and creates a new user record in the database.
*/
// Include the database connection
require_once '../includes/connection.php';

// Function to sanitize user input
function sanitize($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve user input and sanitize it
    $full_name = sanitize($_POST['full_name']);
    $username = sanitize($_POST['username']);
    $email = sanitize($_POST['email']);
    $password = sanitize($_POST['password']);
    $confirm_password = sanitize($_POST['confirm_password']);
    $role = sanitize($_POST['role']);

    // Perform input validation
    if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
        // Handle empty fields error
        $error = "All fields are required.";
    } elseif ($password !== $confirm_password) {
        // Handle password mismatch error
        $error = "Passwords do not match.";
    } else {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert user data into the database
        $query = "INSERT INTO users (`full_name`, `username`, `email`, `password`, `role`) VALUES ('$full_name', '$username', '$email', '$hashed_password', '$role')";
        $result = mysqli_query($conn, $query);

        if ($result) {
            // User registration successful
            $success = "User registered successfully. You can now Login";
        } else {
            // Handle database error
            $error = "Error: " . mysqli_error($connection);
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>User Registration</title>
    <link rel="stylesheet" type="text/css" href="../css/register.css">
</head>
<body>
    <img src="../images/farm_tractor.png" alt="">
    <marquee behavior="" direction="" id="marquee"><h1>Agric. Extension Services</h1></marquee>
    <div class="container">
        <h2>User Registration</h2>
        <?php if (isset($error)): ?>
            <div class="error" style="color:red;"><?php echo $error; ?></div>
        <?php endif; ?>
        <?php if (isset($success)): ?>
            <div class="success" style="color:green;"><?php echo $success; ?></div>
        <?php endif; ?>
        <form action="register.php" method="POST">
            <div class="form-group">
                <label for="fullname">Full_Name</label>
                <input type="text" id="full_name" name="full_name" placeholder="Enter Full Name" required>
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Enter Username" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Enter Email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter Password" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" required>
            </div>
            <div class="form-group">
                <select name="role" id="role" class="form-control">
                    <option value="">Select User Role</option>
                    <option value="admin">Administrator</option>
                    <option value="extension">Extension Worker</option>
                    <option value="farmer">Farmer</option>
                </select>
            </div>
            <button type="submit" class="btn">Register</button>
            <p>Already Have an Account? Login <a href="login.php">Here</a></p>
        </form>
    </div>
</body>
</html>

<?php
/*
Functionality: This file allows users to change their password. 
It verifies the user's current password and updates it with a
 new password.
*/

?>
<?php
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
    $user_id = sanitize($_POST['user_id']);
    $current_password = sanitize($_POST['current_password']);
    $new_password = sanitize($_POST['new_password']);
    $confirm_password = sanitize($_POST['confirm_password']);

    // Retrieve the user's current password from the database
    $query = "SELECT password FROM users WHERE id = '$user_id'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $hashed_password = $row['password'];

        // Verify if the current password matches the stored password
        if (password_verify($current_password, $hashed_password)) {
            // Perform input validation
            if ($new_password === $confirm_password) {
                // Hash the new password
                $new_hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

                // Update the user's password in the database
                $query = "UPDATE users SET password = '$new_hashed_password' WHERE id = '$user_id'";
                $result = mysqli_query($conn, $query);

                if ($result) {
                    // Password change successful
                    $success = "Password changed successfully.";
                } else {
                    // Handle database error
                    $error = "Error: " . mysqli_error($conn);
                }
            } else {
                // Handle password mismatch error
                $error = "New password and confirm password do not match.";
            }
        } else {
            // Handle incorrect current password error
            $error = "Incorrect current password.";
        }
    } else {
        // Handle error if user not found
        $error = "User not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Change Password</title>
    <!-- <link rel="stylesheet" type="text/css" href="styles.css"> -->
    <link rel="stylesheet" type="text/css" href="../css/register.css">
</head>
<body>
<img src="../images/Reset-password.png" alt="">

<marquee behavior="" direction="" id="marquee"><h1>Agric. Extension Services</h1></marquee>

    <div class="container">
        <h2>Change Password</h2>
        <?php if (isset($error)): ?>
            <div class="error" style="color:red;"><?php echo $error; ?></div>
        <?php endif; ?>
        <?php if (isset($success)): ?>
            <div class="success" style="color:green;"><?php echo $success; ?></div>
        <?php endif; ?>
        <form action="change_password.php" method="POST">
            <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
            <div class="form-group">
                <label for="current_password">Current Password</label>
                <input type="password" id="current_password" name="current_password" required>
            </div>
            <div class="form-group">
                <label for="new_password">New Password</label>
                <input type="password" id="new_password" name="new_password" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
            </div>
            <button type="submit" class="btn">Change Password</button>
        </form>
    </div>
</body>
</html>

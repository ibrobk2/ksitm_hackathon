<?php
/*
Functionality: This file displays the user's profile information, including 
their name, contact information, and any other relevant details.
 It allows users to update their profile information.
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
    $username = sanitize($_POST['username']);
    $email = sanitize($_POST['email']);

    // Update the user's profile in the database
    $query = "UPDATE users SET username = '$username', email = '$email' WHERE id = '$user_id'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Profile update successful
        $success = "Profile updated successfully.";
    } else {
        // Handle database error
        $error = "Error: " . mysqli_error($conn);
    }
}

// Retrieve user's profile information from the database
$user_id = 2; // Replace with the logged-in user's ID or appropriate logic
$query = "SELECT * FROM users WHERE user_id = '$user_id'";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
} else {
    // Handle error if user not found
    $error = "User not found.";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Profile</title>
    <!-- <link rel="stylesheet" type="text/css" href="styles.css"> -->
    <link rel="stylesheet" type="text/css" href="../css/register.css">
</head>
<body>
    <img src="../images/user-profile.png" alt="">
    <marquee behavior="" direction="" id="marquee"><h1>Agric. Extension Services</h1></marquee>

    <div class="container">
        <h2>User Profile</h2>
        <?php if (isset($error)): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>
        <?php if (isset($success)): ?>
            <div class="success"><?php echo $success; ?></div>
        <?php endif; ?>
        <?php if (isset($user)): ?>
            <form action="profile.php" method="POST">
                <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" value="<?php echo $user['username']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="<?php echo $user['email']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="fullname">Full_Name</label>
                    <input type="text" id="full_name" name="full_name" value="<?php echo $user['full_name']; ?>" required>
                </div>
                <button type="submit" class="btn">Update Profile</button>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>

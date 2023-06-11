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
    // Add new user
    if (isset($_POST['add_user'])) {
        // Retrieve user input and sanitize it
        $full_name = sanitize($_POST['full_name']);
        $username = sanitize($_POST['username']);
        $email = sanitize($_POST['email']);
        $password = sanitize($_POST['password']);

        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert the new user into the database
        $query = "INSERT INTO users (full_name, username, email, password) VALUES ('$full_name', '$username', '$email', '$hashed_password')";
        $result = mysqli_query($conn, $query);

        if ($result) {
            // User added successfully
            $success = "User added successfully.";
        } else {
            // Handle database error
            $error = "Error: " . mysqli_error($conn);
        }
    }

    // Delete user
    if (isset($_POST['delete_user'])) {
        // Retrieve user ID from form input
        $user_id = sanitize($_POST['user_id']);

        // Delete the user from the database
        $query = "DELETE FROM users WHERE user_id = '$user_id'";
        $result = mysqli_query($conn, $query);

        if ($result) {
            // User deleted successfully
            $success = "User deleted successfully.";
        } else {
            // Handle database error
            $error = "Error: " . mysqli_error($conn);
        }
    }
}

// Retrieve all users from the database
$query = "SELECT * FROM users";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $users = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    // Handle error if no users found
    $error = "No users found.";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Users</title>
    <!-- <link rel="stylesheet" type="text/css" href="styles.css"> -->
    <link rel="stylesheet" type="text/css" href="../css/register.css">

</head>
<body>
    <img src="../images/add-user.png" alt="">
    <div class="container">
        <h2>Manage Users</h2>
        <?php if (isset($error)): ?>
            <div class="error" style="color:red"><?php echo $error; ?></div>
        <?php endif; ?>
        <?php if (isset($success)): ?>
            <div class="success" style="color:green"><?php echo $success; ?></div>
        <?php endif; ?>
        <h3>Add User</h3>
        <form action="admin_users.php" method="POST">
            <div class="form-group">
                <label for="full_name">Full Name</label>
                <input type="text" id="full_name" name="full_name" required>
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" name="add_user" class="btn">Add User</button>
        </form>
        <h3>Users List</h3>
        <?php if (isset($users)): ?>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Full Name</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?php echo $user['user_id']; ?></td>
                        <td><?php echo $user['full_name']; ?></td>
                        <td><?php echo $user['username']; ?></td>
                        <td><?php echo $user['email']; ?></td>
                        <td>
                            <form action="admin_users.php" method="POST">
                                <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                                <button type="submit" name="delete_user" class="btn">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>
    </div>
</body>
</html>

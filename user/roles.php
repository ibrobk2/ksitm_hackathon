<?php
/*
Functionality: This file manages user roles and permissions. 
It defines the different roles (extension officer, farmer, administrator)
 and their associated permissions. It provides functionality to assign roles to 
users and control access to specific features or data based on roles.
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
    $full_name = sanitize($_POST['full_name']);
    $role = sanitize($_POST['role']);

    // Update the user's role in the database
    $query = "UPDATE users SET role = '$role' WHERE id = '$user_id'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Role assignment successful
        $success = "Role assigned successfully.";
    } else {
        // Handle database error
        $error = "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Roles</title>
    <!-- <link rel="stylesheet" type="text/css" href="styles.css"> -->
    <link rel="stylesheet" type="text/css" href="../css/register.css">
</head>
<body>
<img src="../images/user-roles.png" alt="">
    <marquee behavior="" direction="" id="marquee"><h1>Agric. Extension Services</h1></marquee>
    <div class="container">
        <h2>User Roles</h2>
        <?php if (isset($error)): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>
        <?php if (isset($success)): ?>
            <div class="success"><?php echo $success; ?></div>
        <?php endif; ?>
        <form action="fetch_role_name.php" method="POST">
            <div class="form-group">
                <label for="user_id">User ID</label>
                <input type="text" id="user_id" name="user_id" required>
            </div>
            <div class="form-group">
                <label for="full_name">Full Name</label>
                <input type="text" id="full_name" name="full_name" disabled required>
            </div>
            <div class="form-group">
                <label for="role">Role</label>
                <select id="role" name="role" required>
                    <option value="">Select Role</option>
                    <option value="administrator">Administrator</option>
                    <option value="extension_officer">Extension Officer</option>
                    <option value="farmer">Farmer</option>
                </select>
            </div>
            <button type="submit" class="btn">Assign Role</button>
        </form>
    </div>
<script src="../includes/jquery.js"></script>
    <script>
        $(document).ready(function () {
            $("#user_id").change(function () { 
                
                var user_id = $("#user_id").val(); 
                // alert(user_id);
                $.ajax({
                    type: "POST",
                    url: "fetch_role_name.php",
                    data: {user_id: user_id},
                    dataType: "json",
                    success: function (response) {
                        $("#full_name").val(response.full_name);
                    }
                });
            });
        });
    </script>
</body>
</html>

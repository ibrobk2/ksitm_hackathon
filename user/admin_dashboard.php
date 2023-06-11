<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" type="text/css" href="dashboard-style.css">
</head>
<body>
    <a href="../logout.php"><h2>Logout</h2></a>
    <div class="container">
        <div class="sidebar">
            <h2>Menu</h2>
            <ul>
                <li><a href="#">Dashboard</a></li>
                <li><a href="manage_users.php">Users</a></li>
                <li><a href="#">Assign Farm</a></li>
                <li><a href="report.php">Reports</a></li>
                <li><a href="profile.php">Profile</a></li>
            </ul>
        </div>
        <div class="main-content">
            <h1>Welcome to the Admin Dashboard</h1>
            <p>This is the main content area of the dashboard.</p>
        </div>
    </div>

    <script src="../includes/jquery.js"></script>
    <script>
        $(document).ready(function() {
    // Toggle sidebar menu
    $('.sidebar h2').click(function() {
        $('.sidebar ul').slideToggle();
    });
});

    </script>

</body>
</html>

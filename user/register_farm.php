<?php
// Include the database connection file
include '../includes/connection.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the form data
    $location = $_POST['location'];
    $size = $_POST['size'];
    $extensionOfficer = $_POST['extension_officer'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];

    // Perform form validation

    // Insert the farm data into the database
    $query = "INSERT INTO farms (location, size, extension_officer, latitude, longitude, created_at)
              VALUES ('$location', '$size', '$extensionOfficer', '$latitude', '$longitude', NOW())";
    $result = mysqli_query($conn, $query);

    // Check if the insertion was successful
    if ($result) {
        echo "Farm registered successfully!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Farm Registration</title>
    <link rel="stylesheet" type="text/css" href="../css/register.css">
    <style>
        .container{
            width:80%;
        }
    </style>

</head>
<body>
    <div class="container">
    <h2>Register a Farm</h2>
    <form method="POST" action="">
        <label for="location">Location:</label>
        <input type="text" id="location" name="location" required><br><br>

        <label for="size">Size:</label>
        <input type="text" id="size" name="size" required><br><br>

        <label for="extension_officer">Extension Officer:</label>
        <input type="text" id="extension_officer" name="extension_officer" required><br><br>

        <label for="latitude">Latitude:</label>
        <input type="text" id="latitude" name="latitude" required><br><br>

        <label for="longitude">Longitude:</label>
        <input type="text" id="longitude" name="longitude" required><br><br>

        <input type="submit" value="Register">
    </form>
    </div>
</body>
</html>

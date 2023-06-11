<?php
// Include the database connection
require_once '../includes/connection.php';
require_once '../includes/farm_functions.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form input
    $farm_id = $_POST['farm_id'];
    $extension_officer = $_POST['extension_officer'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];

    // Check-in the visit to the farm
    $result = checkInVisit($farm_id, $extension_officer, $latitude, $longitude);

    if ($result) {
        // Visit checked in successfully
        $success = "Visit checked in successfully.";
    } else {
        // Handle error if check-in fails
        $error = "Error: Visit check-in failed.";
    }
}

// Retrieve all farms from the database
$farms = getAllFarms();

// Retrieve all extension officers from the database
$extension_officers = getAllExtensionOfficers();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Farm Management - Visit Farm</title>
    <!-- <link rel="stylesheet" type="text/css" href="styles.css"> -->
    <link rel="stylesheet" type="text/css" href="../css/register.css">

</head>
<body>
<img src="../images/user-roles.png" alt="">
    <marquee behavior="" direction="" id="marquee"><h1>Agric. Extension Services</h1></marquee>
    <div class="container">
        <h2>Visit Farm</h2>
        <?php if (isset($error)): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>
        <?php if (isset($success)): ?>
            <div class="success"><?php echo $success; ?></div>
        <?php endif; ?>
        <form action="visit_farm.php" method="POST">
            <div class="form-group">
                <label for="farm_id">Select Farm:</label>
                <select id="farm_id" name="farm_id" >
                    <option value="" selected disabled>Select a farm</option>
                    <?php foreach ($farms as $farm): ?>
                        <option value="<?php echo $farm['farm_id']; ?>"><?php echo $farm['location']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="extension_officer">Select Extension Officer:</label>
                <select id="extension_officer" name="extension_officer" >
                    <option value="" selected disabled>Select an extension officer</option>
                    <?php foreach ($extension_officers as $officer): ?>
                        <option value="<?php echo $officer['staff_id']; ?>"><?php echo $officer['full_name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" id="address" name="address" >
            </div>
            <div class="form-group">
                <label for="latitude">Latitude:</label>
                <input type="text" id="latitude" name="latitude">
            </div>
            <div class="form-group">
                <label for="longitude">Longitude:</label>
                <input type="text" id="longitude" name="longitude">
            </div>
            <button type="submit" class="btn">Check-in Visit</button>
        </form>
    </div>
    <script src="../includes/jquery.js"></script>
    <script>
        $(document).ready(function () {
            $("#address").change(function () { 
                
                var address = $("#address").val(); 
                // alert(user_id);
                $.ajax({
                    type: "POST",
                    url: "fetch_address.php",
                    data: {address: address},
                    dataType: "json",
                    success: function (response) {
                        $("#latitude").val(response.coord.lat);
                        $("#longitude").val(response.coord.lon);
                    }
                });
            });
        });
    </script>
</body>
</html>

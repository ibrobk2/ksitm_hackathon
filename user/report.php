<?php
// Include the database connection
require_once '../includes/connection.php';
require_once '../includes/report_functions.php';

// Retrieve data for generating reports
$extensionOfficers = getExtensionOfficers();
$farms = getFarms();
$visits = getVisits();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Farm Management - Reports</title>
    <!-- <link rel="stylesheet" type="text/css" href="styles.css"> -->
    <style>
        /* Body style */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 20px;
    background-color: #f5f5f5;
}

/* Container style */
.container {
    max-width: 800px;
    margin: 0 auto;
    background-color: #fff;
    padding: 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

/* Heading style */
h2 {
    color: #333;
    text-align: center;
}

h3 {
    color: #666;
    margin-top: 30px;
}

/* Table style */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

th, td {
    padding: 10px;
    border: 1px solid #ccc;
}

th {
    background-color: #f0f0f0;
    color: #333;
    font-weight: bold;
}

tr:nth-child(even) {
    background-color: #f9f9f9;
}

/* Responsive styles */
@media (max-width: 600px) {
    table {
        font-size: 12px;
    }
}

    </style>
</head>
<body>
    <div class="container">
        <h2>Reports and Analytics</h2>

        <h3>Extension Officers</h3>
        <table>
            <tr>
                <th>Name</th>
                <th>Total Assigned Farms</th>
            </tr>
            <?php foreach ($extensionOfficers as $officer): ?>
            <tr>
                <td><?php echo $officer['full_name']; ?></td>
                <td><?php echo $officer['total_farms']; ?></td>
            </tr>
            <?php endforeach; ?>
        </table>

        <h3>Farms</h3>
        <table>
            <tr>
                <th>Location</th>
                <th>Assigned Extension Officer</th>
                <th>Total Visits</th>
            </tr>
            <?php 
               $query = "SELECT * FROM farms";
               $result = mysqli_query($conn, $query);
           
               if ($result && mysqli_num_rows($result) > 0) {
                   $visits = array();
           
                   while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?php echo $row['location']; ?></td>
                <td><?php echo $row['extension_officer']; ?></td>
                <td><?php echo $row['total_visits']; ?></td>
            </tr>
            <?php endwhile; ?>
            <?php } ?>
        </table>

        <h3>Visits</h3>
        <table>
            <tr>
                <th>Extension Officer</th>
                <th>Farm</th>
                <th>Visit Date</th>
                <th>Latitude</th>
                <th>Longitude</th>
            </tr>
            <?php    $query = "SELECT * FROM farm_visits";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0){
        //  $visits = array();

        while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?php echo $row['extension_officer']; ?></td>
                <td><?php echo $row['farm']; ?></td>
                <td><?php echo $row['visit_date']; ?></td>
                <td><?php echo $row['latitude']; ?></td>
                <td><?php echo $row['longitude']; ?></td>
            </tr>
            <?php endwhile; ?>
            <?php } ?>
        </table>
    </div>
</body>
</html>

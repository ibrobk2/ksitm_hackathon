<?php
include "connection.php";
// Retrieve all extension officers and the count of assigned farms for each officer
function getExtensionOfficers() {
    global $conn;

    $query = "SELECT * from users";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $extensionOfficers = array();

        while ($row = mysqli_fetch_assoc($result)) {
            $extensionOfficers[] = $row;
        }

        return $extensionOfficers;
    } else {
        return null;
    }
}

// Retrieve all farms with the assigned extension officer and the count of visits for each farm
function getFarms() {
    global $conn;

    $query = "SELECT * FROM farms";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $farms = array();

        while ($row = mysqli_fetch_assoc($result)) {
            $farms[] = $row;
        }

        return $farms;
    } else {
        return null;
    }
}

// Retrieve all visits with the extension officer, farm, visit date, latitude, and longitude
function getVisits() {
    global $conn;

    $query = "SELECT * FROM farm_visits";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $visits = array();

        while ($row = mysqli_fetch_assoc($result)) {
            $visits[] = $row;
        }

        return $visits;
    } else {
        return null;
    }
}
?>

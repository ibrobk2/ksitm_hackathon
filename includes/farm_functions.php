<?php
// Retrieve farm details from the database
function getFarmDetails($farm_id) {
    global $conn;

    $query = "SELECT * FROM farms WHERE id = '$farm_id'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result);
    } else {
        return null;
    }
}

// Retrieve visit history for a farm
function getFarmVisits($farm_id) {
    global $conn;

    $query = "SELECT * FROM farm_visits WHERE farm_id = '$farm_id' ORDER BY timestamp DESC";
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

// Retrieve all farms from the database
function getAllFarms() {
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

// Retrieve all extension officers from the database
function getAllExtensionOfficers() {
    global $conn;

    $query = "SELECT * FROM extension_officers";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $officers = array();

        while ($row = mysqli_fetch_assoc($result)) {
            $officers[] = $row;
        }

        return $officers;
    } else {
        return null;
    }
}

// Assign a farm to an extension officer
function assignFarm($farm_id, $extension_officer) {
    global $conn;

    $query = "UPDATE farms SET extension_officer = '$extension_officer' WHERE id = '$farm_id'";
    $result = mysqli_query($conn, $query);

    return $result;
}

// Check-in a visit to a farm
function checkInVisit($farm_id, $extension_officer, $latitude, $longitude) {
    global $conn;

    $timestamp = date('Y-m-d H:i:s');

    $query = "INSERT INTO farm_visits (farm_id, extension_officer, latitude, longitude, timestamp)
              VALUES ('$farm_id', '$extension_officer', '$latitude', '$longitude', '$timestamp')";
    $result = mysqli_query($conn, $query);

    return $result;
}
?>

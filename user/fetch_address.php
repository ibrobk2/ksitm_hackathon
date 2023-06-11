<?php
include "../includes/connection.php";

if(isset($_POST['address'])){
    $address = $_POST['address'];



// $apiKey = 'YOUR_API_KEY';
$apiUrl = 'https://api.openweathermap.org/data/2.5/weather?q='.$address.'&appid=22f1479849df939033182c87050daa97';

// Initialize cURL session
$curl = curl_init();

//Turn off SSL Checker
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

// Set the API URL
curl_setopt($curl, CURLOPT_URL, $apiUrl);

// Set request method to GET
curl_setopt($curl, CURLOPT_HTTPGET, true);

// Set API key in the request headers
// curl_setopt($curl, CURLOPT_HTTPHEADER, [
//     'Authorization: API-Key ' . $apiKey
// ]);

// Return the response as a string instead of outputting it directly
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

// Execute the cURL request
$response = curl_exec($curl);

// Check for errors
if (curl_errno($curl)) {
    $error = curl_error($curl);
    // Handle the error appropriately
    echo 'cURL Error: ' . $error;
} else {
    // Process the response
    echo $response;
}

// Close cURL session
curl_close($curl);



    
}



?>
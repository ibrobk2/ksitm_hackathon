<?php

$conn = mysqli_connect("localhost", "root", "", "bakori") or die("Failed to connect");

if(!$conn){
    echo "Failed to connect to server";
    exit();
}


?>
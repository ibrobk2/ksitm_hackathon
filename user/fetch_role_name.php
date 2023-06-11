<?php
include "../includes/connection.php";

if(isset($_POST['user_id'])){
    $user_id = $_POST['user_id'];
    // $data = array();
    $sql = "SELECT full_name FROM users WHERE user_id=$user_id";
    $result = mysqli_query($conn, $sql);

    if($result){
    $row = mysqli_fetch_assoc($result);

    $data = array('status' => 'success', 'data' => $row);
        echo json_encode($row);
    }else{
        $data = ["error"=>"Error"];
        echo json_encode($data);
    }
    mysqli_close($conn);
}


?>
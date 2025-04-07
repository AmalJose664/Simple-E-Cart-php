<?php


$conn=new mysqli("localhost","root","", "shopping") ;
if($conn->connect_error){
    $response = [
        'message' => 'mysql connection error',
        'status' => false,
    ];
    echo "Error on connection";
    die(json_encode($response));
    exit();
}else{
   
}

?>
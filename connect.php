<?php 
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'shop';

    $conn = new mysqli($servername, $username, $password, $database);
    if($conn -> connect_error){
        die('connect failed: ' .$conn -> connect_error);
    }else{
        "Connected successfully";
    }
?>
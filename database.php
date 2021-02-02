<?php

$db = "localhost";
$username = "root";
$password = "";
$dbname = "test";

$conn = mysqli_connect($db, $username, $password, $dbname);

if($conn->connect_error) {
    die($conn->connect_errno. ": ".$conn->connect_error);
}

?>
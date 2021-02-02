<?php

$db = "158.39.188.201";
$username = "root";
$password = "";
$dbname = "datasikkerhet_prosjekt";

$conn = mysqli_connect($db, $username, $password, $dbname);

if($conn->connect_error) {
    die($conn->connect_errno. ": ".$conn->connect_error);
}
else{
    echo"connected to server";


$sql = "SELECT * FROM emne";

$results = mysqli_query($conn, $sql);

while($row = mysqli_fetch_array($results)) {
    echo  $row['emnenavn'];
}
}


?>
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

    $showtables= mysqli_query($conn,"SHOW TABLES FROM database_name");

    while($table = mysqli_fetch_array($showtables)) { // go through each row that was returned in $result
        echo($table[0] . "<br>");    // print the table that was returned on that row.
    }
}
}


?>
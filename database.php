<?php

$db = "localhost";
$username = "root";
$password = "";
$dbname = "datasikkerhet_prosjekt";

$conn = mysqli_connect($db, $username, $password, $dbname);

if($conn->connect_error) {
    die($conn->connect_errno. ": ".$conn->connect_error);
}
else{
    echo"connected to server";


    $db_list = mysql_list_dbs($conn);
    while ($db = mysql_fetch_object($db_list)) {
        echo $db->Database . "<br />";
    }
}


?>
<?php

include "../database.php";
$db_conn = new Database();
$db = $db_conn->get_Connection() or die();

$epost = $_POST['epost'];
$passord = $_POST['passord'];
$query = "SELECT BrukerID FROM `brukere` WHERE Epost = '".$epost."' AND Passord = '".password_hash($passord, PASSWORD_DEFAULT)."';";
$result = $db->query($query);
$db_conn->close_Connection();

if($result->num_rows >= 1) {
    $row = $result->fetch_assoc();
    echo $row["BrukerID"];
}
else {
    echo 0;
}
?>
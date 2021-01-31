<?php

include "../database.php";
$db_conn = new Database();
$db = $db_conn->get_Connection() or die();

$epost = /*PLACEHOLDER*/ "test@gmail.com"; //$_POST['epost'];
$passord = /*PLACEHOLDER*/ "drossap"; //$_POST['passord'];
$query = "SELECT BrukerID FROM `brukere` WHERE Epost = '".$epost."' AND Passord = '".$passord."';";
// .password_hash($password, PASSWORD_DEFAULT).
$result = $db->query($query);
$db_conn->close_Connection();

if($result->num_rows >= 1) {
    $row = $result->fetch_assoc();
    echo $row["BrukerID"];
    //brukerid skal stilles som en slags  "cookie" i appen
}
else {
    echo 0;
}
?>
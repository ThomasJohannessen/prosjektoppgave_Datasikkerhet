<?php

include "../database.php";
$db_conn = new Database();
$db = $db_conn->get_Connection() or die();

$epost = $_GET['epost'];
$passord = $_GET['passord'];
$passord_hashed = password_hash($passord, PASSWORD_DEFAULT);
//echo $passord_hashed;
echo $epost;
echo "\n";

//$query = "SELECT BrukerID FROM `brukere` WHERE Epost = '".$epost."' AND Passord = '".password_hash($password, PASSWORD_DEFAULT)."';";
//$query = "SELECT BrukerID FROM `brukere` WHERE Epost = '.$epost.' AND Passord = '.$passord_hashed.'";
$query = "SELECT BrukerID FROM `brukere` WHERE Epost = '.$epost.'";
$result = $db->query($query);
$db_conn->close_Connection();

if($result->num_rows == 0) {
    //innlogging finnes ikke 
    echo 0;
} 
else {
    echo "Brukeren finnes";
    $row = $result->fetch_assoc();
    echo $row["BrukerID"];
    //returnerer brukerid .. Mulig å legeg til flere ting fra db her ved behov
}
?>

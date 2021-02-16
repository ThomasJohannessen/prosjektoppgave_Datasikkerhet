<?php

include "../database.php";
$db_conn = new Database();
$db = $db_conn->get_Connection() or die();

$epost = /*PLACEHOLDER*/ "Pia@hiof.no";//variabel for epost bruker har tastet inn i app
$passord = /*PLACEHOLDER*/ "Nodeland1";//varaibel for passord bruker har tastet inn i app
$passord_hashed = password_hash(passord, PASSWORD_DEFAULT);
echo $passord_hashed;
//$query = "SELECT BrukerID FROM `brukere` WHERE Epost = '".$epost."' AND Passord = '".password_hash($password, PASSWORD_DEFAULT)."';";
$query = "SELECT BrukerID FROM `brukere` WHERE Epost = '.$epost.' AND Passord = '.$passord_hashed.'";
$result = $db->query($query);
$db_conn->close_Connection();

if($result->num_rows == 0) {
    //innlogging finnes ikke 
    echo "DET FINNES INGEN BRUKER DER EPOST ER:'.$epost.' AND Passord = '.$passord_hashed.'";
} 
else {
    $row = $result->fetch_assoc();
    echo $row["BrukerID"];
    //returnerer brukerid .. Mulig å legeg til flere ting fra db her ved behov
}
?>

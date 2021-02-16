<?php
include "../database.php";
$db_conn = new Database();
$db = $db_conn->get_Connection() or die();

$epost = $_GET['epost'];
$passord = $_GET['passord'];
$passord_hashed = password_hash($passord, PASSWORD_DEFAULT);
//echo $passord_hashed;
//echo $epost;
//echo "\n";




//$epost = /*PLACEHOLDER*/ "Pia@hiof.no";//variabel for epost bruker har tastet inn i app
//$passord = /*PLACEHOLDER*/ "Nodeland1";//varaibel for passord bruker har tastet inn i app
//$query = "SELECT BrukerID FROM `brukere` WHERE Epost = '".$epost."' AND Passord = '".password_hash($password, PASSWORD_DEFAULT)."';";


//$query = "SELECT BrukerID FROM `brukere` WHERE Epost = '".$epost."' AND Passord = '".password_hash($password, PASSWORD_DEFAULT)."';";
//$query = "SELECT BrukerID FROM `brukere` WHERE Epost = '.$epost.' AND Passord = '.$passord_hashed.'";
$query = "SELECT BrukerID FROM `brukere` WHERE Epost = '".$epost."' AND Passord = '".$passord_hashed."';";
$result = $db->query($query);
$db_conn->close_Connection();

if($result->num_rows >= 1) {
    $row = $result->fetch_assoc();
    echo $row["BrukerID"];
    //returnerer brukerid .. Mulig å legeg til flere ting fra db her ved behov
}
else {
    echo 0;
}

//$json_array = array();
//if($result->num_rows > 0) {
//    echo "Brukeren finnes";
//    while($row = $result->fetch_assoc()) {
//        array_push($json_array, $row);
//    }
//}
//else {
//    echo 0;
//}
//$json_array = json_encode($json_array);
//echo $json_array;

?>

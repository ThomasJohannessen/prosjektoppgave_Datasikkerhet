<?php
include "../database.php";
$db_conn = new Database();
$db = $db_conn->get_Connection() or die();

$epost = $_GET['epost'];
$passord = $_GET['passord'];
//$passord_hashed = password_hash($passord, PASSWORD_DEFAULT);
//echo $passord;
//echo "\n";
//echo $epost;
//echo "\n";




//$epost = /*PLACEHOLDER*/ "Pia@hiof.no";//variabel for epost bruker har tastet inn i app
//$passord = /*PLACEHOLDER*/ "Nodeland1";//varaibel for passord bruker har tastet inn i app
//$query = "SELECT BrukerID FROM `brukere` WHERE Epost = '".$epost."' AND Passord = '".password_hash($password, PASSWORD_DEFAULT)."';";


//$query = "SELECT BrukerID FROM `brukere` WHERE Epost = '".$epost."' AND Passord = '".password_hash($password, PASSWORD_DEFAULT)."';";
//$query = "SELECT BrukerID FROM `brukere` WHERE Epost = '.$epost.' AND Passord = '.$passord_hashed.'";
//$query = "SELECT BrukerID FROM `brukere` WHERE Epost = '".$epost."' AND Passord = '".$passord_hashed."';";

//$password_query = "SELECT Passord FROM `brukere` WHERE Epost = '".$epost."';";
//$password_result = $db->query($password_query);
//
//$query = "SELECT BrukerID FROM `brukere` WHERE Epost = '".$epost."';";
$query = "SELECT BrukerID, Passord FROM `brukere` WHERE Epost = '".$epost."';";
$result = $db->query($query);
$db_conn->close_Connection();

//if($password_result->num_rows >= 1) {
//    $passord_row = $password_result->fetch_assoc();
//    $password_hash = $passord_row["Passord"];
//}
if($result->num_rows >= 1) {
    $row = $result->fetch_assoc();
    $password_hash = $row["Passord"];
    if (password_verify($passord, $password_hash)) {
        echo 'Password is valid!\n';
        echo $row["BrukerID"];
    } else {
        echo 'Invalid password.';
    }
    
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

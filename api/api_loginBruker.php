<?php

include "../database.php";
$db_conn = new Database();
$db = $db_conn->get_Connection() or die();

$epost = /*PLACEHOLDER*/ "Pia@hiof.no";//variabel for epost bruker har tastet inn i app
$passord = /*PLACEHOLDER*/ "Nodeland1";//varaibel for passord bruker har tastet inn i app
$query = "SELECT BrukerID FROM `brukere` WHERE Epost = '".$epost."' AND Passord = '".password_hash($password, PASSWORD_DEFAULT)."';";
$result = $db->query($query);
$db_conn->close_Connection();

$json_array = array();
if($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        array_push($json_array, $row);
    }
}
else {
    echo 0;
}

$json_array = json_encode($json_array);
echo $json_array;
?>

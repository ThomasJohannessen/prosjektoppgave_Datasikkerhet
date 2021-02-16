<?php
include "../database.php";
$db_conn = new Database();
$db = $db_conn->get_Connection() or die();

$epost = $_GET['epost'];
$passord = $_GET['passord'];

$password_query = "SELECT Passord FROM `brukere` WHERE Epost = '".$epost."';";
$password_result = $db->query($password_query);

$query = "SELECT BrukerID FROM `brukere` WHERE Epost = '".$epost."';";
//$query = "SELECT BrukerID, Passord FROM `brukere` WHERE Epost = '".$epost."';";
$result = $db->query($query);
$db_conn->close_Connection();

$passord_row = $password_result->fetch_assoc();
$password_hash = $passord_row["Passord"];
    
if(($result->num_rows == 1)&&(password_verify($passord, $password_hash))) {
    $json_array = array();
    $row = $result->fetch_assoc())
    array_push($json_array, $row);
    $json_array = json_encode($json_array);
    echo $json_array;
    echo "Fungerte. Riktig passord og 1 svar";   
}
else {
    echo 0;
}
?>

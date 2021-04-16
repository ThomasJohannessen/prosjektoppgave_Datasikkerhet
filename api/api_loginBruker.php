<?php
header('Content-Type: application/json');

include "../database.php";
include "../AppLogger.php";

$db_conn = new Database();

$db = $db_conn->get_Connection("guest") or die();

$epost = $_GET['epost'];
$passord = $_GET['passord'];

$password_query = "CALL LoginGetPassApi('$epost')";
$password_result = $db->query($password_query);

$query = "CALL LoginGetIdApi('$epost')";
$result = $db->query($query);
$db_conn->close_Connection();

$logg = new AppLogger("app");
$logger = $logg->getLogger();

$passord_row = $password_result->fetch_assoc();
$password_hash = $passord_row["Passord"];

if(($result->num_rows == 1)&&(password_verify($passord, $password_hash))) {

    $logger->info("User logged in", ["eMail" => $epost, "password" => $password_hash]);

    $json_array = array();
    $row = $result->fetch_assoc();
    //array_push($json_array, $row);
    echo json_encode($row);
    //echo json_encode($json_array);
    //$json_array = json_encode($json_array);
    //echo $json_array;
}
else {
    $logger->notice("Failed attempt to log in", ["usernameInput" => $epost, "passwordInput" => $passord]);
    echo 0;
}
?>
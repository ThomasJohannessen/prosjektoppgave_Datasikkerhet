<?php

//app-funskjonalitet for å sjekke om bruker er pålogget

header('Content-Type: application/json');

include "../database.php";

$db_conn = new Database("student");

$db = $db_conn->get_Connection() or die();
$brukerid = $_GET['brukerid'];


    $stmt = $db->prepare("CALL GetAskedQuestionsApi(?)");
    $stmt->bind_param("i", $brukerid);
    $stmt->execute();
    $result = $stmt->get_result();

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
$myObj->message = $json_array;
//$json_array = json_encode($json_array);
//echo $json_array;
echo json_encode($myObj);
//$JSON_object = (object) $json_array;
//echo $JSON_object;
?>

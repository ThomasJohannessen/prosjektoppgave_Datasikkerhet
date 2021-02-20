<?php

//app-funskjonalitet for å sjekke om bruker er pålogget

header('Content-Type: application/json');

include "../database.php";

$db_conn = new Database();

$db = $db_conn->get_Connection() or die();
$brukerid = $_GET['brukerid'];
echo $brukerid;
$query = "SELECT emnekode, melding, svar FROM `meldinger` WHERE avsenderID = '".$brukerid."';";
echo $query;
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

//$json_array = json_encode($json_array);
//echo $json_array;
//echo json_encode($json_array);
$JSON_object = (object) $json_array;
echo $JSON_object;
?>

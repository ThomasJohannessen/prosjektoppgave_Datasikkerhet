<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8"); 

include "database.php";

$db = new Database();
$connection = $db->getConnection();

//**************************

$table_name = "emne";

$query = "SELECT * FROM " . $table_name . " p ";

//*****************************

$result = $connection->query($query);

$json_array = array();
  
if($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        extract($row);
        array_push($json_array, $row);
    }
}
else {
        http_response_code(404);
  
        echo json_encode(
            array("message" => "No products found.")
        );
}
echo json_encode($json_array);
?>
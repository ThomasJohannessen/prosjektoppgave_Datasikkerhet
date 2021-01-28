<?php

include "database_right.php";

$db = new Database();

$table_name = "products";

$connection = $db->getConnection();
$query = "SELECT * FROM " . $table_name . " p ";
//$stmt = $db->mysqli->prepare($query);
$result = $connection->query($query);

$json_array = array();
$json_array["records"]=array();
//$num = $stmt->rowCount();
  
if($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        extract($row);
        //print_r(array_values($row));
        //echo "</br>";
        $json_row = array(
            "id" => $id,
            "name" => $name,
            "description" => html_entity_decode($description),
            "price" => $price
        );
        
         
        array_push($json_array["records"], $json_row);
    }
    
}
else {
        // set response code - 404 Not found
        http_response_code(404);
  
        // tell the user no products found
        echo json_encode(
            array("message" => "No products found.")
        );
}
echo json_encode($json_array);

?>
<?php 
header("Content-Type: application/json");
include "database.php";

$db = new Database();
$connection = $db->get_Connection();
$query = 'SELECT * FROM brukere WHERE Navn LIKE "Michal";'; 
$result = $connection->query($query);

$json_array = array();
if($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        //echo "Name = ", $row["name"], ", Age = ", $row["age"], ", Born = ", $row["born"], ", Died = ", $row["died"], "<br>";
        array_push($json_array, $row);
    }
}
else {
    echo "No results found";
}
$json_array = json_encode($json_array);
echo $json_array;
$db->close_Connection();
//echo json_decode($json_array)[1]->name;
?>
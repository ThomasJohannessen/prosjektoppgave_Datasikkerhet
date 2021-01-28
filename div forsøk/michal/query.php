<?php 
header("Content-Type: application/json");
include "database.php";

$db = new Database();
$connection = $db->get_Connection();
$query = 'SELECT * FROM balle;';
$result = $connection->query($query);

$json_array = array();
$json_array["medlemmer"] = array();
if($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        //echo "Name = ", $row["name"], ", Age = ", $row["age"], ", Born = ", $row["born"], ", Died = ", $row["died"], "<br>";
        array_push($json_array["medlemmer"], $row);
    }

}
else {
    echo "No results found";
}
$json_array = json_encode($json_array);
echo $json_array;
//echo json_decode($json_array)[1]->name;
?>
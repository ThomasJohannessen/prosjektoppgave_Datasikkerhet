<?php 
include "database.php";

$db = new Database();
$connection = $db->get_Connection();
$query = 'SELECT * FROM balle;';
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
echo "<br>";
echo json_encode($json_array);
?>
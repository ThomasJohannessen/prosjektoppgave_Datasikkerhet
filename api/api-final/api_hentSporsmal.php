<?php

//Cookie her for å sjekke om bruker er pålogget

include "../database.php";
$db_conn = new Database();
$db = $db_conn->get_Connection() or die();
$brukerid = $_COOKIE['brukerid'];
$query = 'SELECT emnekode, melding FROM meldingersporsmal WHERE avsenderID = '.$brukerid.'';
//$query = 'SELECT emnekode, melding FROM meldingersporsmal';
$result = $db->query($query);
$db_conn->close_Connection();

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
?>
<?php

//app-funskjonalitet for å sjekke om bruker er pålogget

include "../database.php";
$db_conn = new Database();
$db = $db_conn->get_Connection() or die();

$sporsmalid = /*PLACEHOLDER*/ 2;//variabel for uthentet data fra app om hvilket spørsmål det gjeleder

$query = 'SELECT melding, Navn FROM meldinger JOIN brukere ON meldinger.foreleserID = brukere.BrukerID WHERE svarID = '.$sporsmalid.'';

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

$json_array = json_encode($json_array);
echo $json_array;
?>
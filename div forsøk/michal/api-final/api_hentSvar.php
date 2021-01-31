<?php

//Cookie her for å sjekke om bruker er pålogget

include "../database.php";
$db_conn = new Database();
$db = $db_conn->get_Connection() or die();

$sporsmalid = /*PLACEHOLDER*/ 1; ////$_HTMLFORMVALUE['sporsmalid'];

$query = 'SELECT melding, Navn FROM meldingersvar JOIN brukere ON meldingersvar.foreleserID = brukere.BrukerID WHERE svarID = '.$sporsmalid.'';
//$query = 'SELECT melding FROM meldingersvar';

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
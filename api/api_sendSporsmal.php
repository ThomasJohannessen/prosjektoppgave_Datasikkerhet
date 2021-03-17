<?php
include "../database.php";
$db_conn = new Database();
$db = $db_conn->get_Connection() or die();

$sporsmal = $_GET['sporsmal'];
$avsender = $_GET['brukerid'];
$emnekode = $_GET['emnekode'];

$query = 'INSERT INTO meldinger(avsenderID, emnekode, melding)
    VALUES('.$avsender.', "'.$emnekode.'", "'.$sporsmal.'")';

$db->query($query);
$db_conn->close_Connection();
die();
?>

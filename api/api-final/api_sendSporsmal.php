<?php
include "../database.php";
$db_conn = new Database();
$db = $db_conn->get_Connection() or die();

$sporsmal = /*PLACEHOLDER*/ "Dummy spørsmål av Michal"; //$_POST['sporsmal'];
$avsender = /*PLACEHOLDER*/ 4; //$_COOKIE['brukerid'];
$emnekode = /*PLACEHOLDER*/ "ITF012"; //$_POST['emnekode'];

$query = 'INSERT INTO meldingersporsmal(avsenderID, emnekode, melding)
    VALUES('.$avsender.', "'.$emnekode.'", "'.$sporsmal.'")';

$db->query($query);
$db_conn->close_Connection();
header("Location: http://localhost/nett/fetch.php"); //placeholder for testing
die();
?>
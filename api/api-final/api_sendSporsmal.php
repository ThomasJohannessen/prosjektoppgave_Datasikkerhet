<?php
include "../database.php";
$db_conn = new Database();
$db = $db_conn->get_Connection() or die();

$sporsmal = $_POST['sporsmal'];
$avsender = $_COOKIE['brukerid'];
$emnekode = $_POST['emnekode'];

$query = 'INSERT INTO meldingersporsmal(avsenderID, emnekode, melding)
    VALUES('.$avsender.', "'.$emnekode.'", "'.$sporsmal.'")';

$db->query($query);
$db_conn->close_Connection();
header("Location: http://localhost/nett/fetch.php"); //placeholder
die();
?>
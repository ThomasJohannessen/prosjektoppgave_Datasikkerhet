<?php
include "../database.php";
$db_conn = new Database();
$db = $db_conn->get_Connection() or die();

$sporsmal = /*PLACEHOLDER*/ //for tekst i spørsmålet
$avsender = /*PLACEHOLDER*/ //for brukerid på avsender
$emnekode = /*PLACEHOLDER*/ //for fag spørsmåøet sendes til

$query = 'INSERT INTO meldingersporsmal(avsenderID, emnekode, melding)
    VALUES('.$avsender.', "'.$emnekode.'", "'.$sporsmal.'")';

$db->query($query);
$db_conn->close_Connection();
header("Location: http://localhost/nett/fetch.php"); //placeholder for videresending etter sendt melding
die();
?>
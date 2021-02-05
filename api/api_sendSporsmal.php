<?php
include "../database.php";
$db_conn = new Database();
$db = $db_conn->get_Connection() or die();

$sporsmal = /*PLACEHOLDER*/ "Dette er et spørsmål fra API";//for tekst i spørsmålet
$avsender = /*PLACEHOLDER*/ 11;//for brukerid på avsender
$emnekode = /*PLACEHOLDER*/ "ITF887";//for fag spørsmåøet sendes til

$query = 'INSERT INTO meldinger(avsenderID, emnekode, melding)
    VALUES('.$avsender.', "'.$emnekode.'", "'.$sporsmal.'")';

$db->query($query);
$db_conn->close_Connection();
header("Location: http://158.39.188.201/steg1/prosjektoppgave_Datasikkerhet/index.php"); //placeholder for videresending etter sendt melding
die();
?>
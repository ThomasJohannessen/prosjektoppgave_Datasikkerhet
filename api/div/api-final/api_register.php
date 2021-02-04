<?php
include "../database.php";
$db_conn = new Database();
$db = $db_conn->get_Connection() or die();

$query = 'INSERT INTO datasikkerhet_prosjekt.brukere(Navn, Epost, Bilde, Kull, Brukertype, Passord, EmneID, Studieretning)
    VALUES(navnpl, epostpl, kullpl, passordpl, EmneIDpl, studieretningpl)';

$db->query($query);
$db_conn->close_Connection();
header("Location: http://localhost/nett/fetch.php"); //placeholder for testing
die();
?>
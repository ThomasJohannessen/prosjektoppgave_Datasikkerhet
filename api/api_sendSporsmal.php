<?php
include "../database.php";
include "../AppLogger.php";
$db_conn = new Database();
$db = $db_conn->get_Connection() or die();

$sporsmal = $_GET['sporsmal'];
$avsender = $_GET['brukerid'];
$emnekode = $_GET['emnekode'];

$logg = new AppLogger("app");
$logger = $logg->getLogger();
if(empty($sporsmal) || empty($avsender) || empty($emnekode)) {
    $logger->warning("User tried sending a question with an empty field", ["userID" => $avsender, "subjectCode" => $emnekode, "question" => $sporsmal]);
}
else {
    $logger->info("User sent a question", ["userID" => $avsender, "subjectCode" => $emnekode, "question" => $sporsmal]);
}



$query = 'INSERT INTO meldinger(avsenderID, emnekode, melding)
    VALUES('.$avsender.', "'.$emnekode.'", "'.$sporsmal.'")';

$db->query($query);
$db_conn->close_Connection();
die();
?>

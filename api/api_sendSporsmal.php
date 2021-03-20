<?php
include "../database.php";
$db_conn = new Database();
$db = $db_conn->get_Connection("student") or die();

$sporsmal = $_GET['sporsmal'];
$avsender = $_GET['brukerid'];
$emnekode = $_GET['emnekode'];

$query = "CALL SendQuestionStudentApi('$avsender', '$emnekode', '$sporsmal')";

$db->query($query);
$db_conn->close_Connection();
die();
?>

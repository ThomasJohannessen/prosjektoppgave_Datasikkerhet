<?php 

session_start();
include "../database.php";
global $conn;

$avsenderID = $_SESSION['brukerID'];

$melding = $_POST['question'];

if ($melding == ""){
    header("refresh:0.01; url=studentside.php");
    exit();
}
$emnekode = $_POST['emnekode'];

$insert = "INSERT INTO meldinger (avsenderID, melding, emnekode) VALUES ('$avsenderID', '$melding', '$emnekode');";


mysqli_query($conn, $insert);


header("refresh:.01; url=studentside.php");
exit();

?>
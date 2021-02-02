<?php 

session_start();
include "../database.php";

$conn = mysqli_connect($db, $username, $password, $dbname);

if (!$conn) {
    echo "Not connected to server";
}

if(!mysqli_select_db($conn, $dbname)) {
    echo "Database not selected";
}

$avsenderID = $_SESSION['brukerID'];

$melding = $_POST['question'];

if ($melding == ""){
    header("refresh:0.01; url=studentside.php");
    exit();
}
$emnekode = $_POST['emnekode'];

$insert = "INSERT INTO meldingersporsmal (avsenderID, melding, emnekode) VALUES ('$avsenderID', '$melding', '$emnekode');";


mysqli_query($conn, $insert);


header("refresh:.01; url=studentside.php");
exit();

?>
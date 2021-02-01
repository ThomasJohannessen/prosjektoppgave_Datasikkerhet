<?php 

include "database.php";

$conn = mysqli_connect($db, $username, $password, $dbname);

if (!$conn) {
    echo "Not connected to server";
}

if(!mysqli_select_db($conn, $dbname)) {
    echo "Database not selected";
}

$avsenderID = rand(0, 40);
$foreleserID = rand(0,9999);

$melding = $_POST['melding'];

if ($melding == ""){
    header("refresh:0.01; url=studentside.php");
    exit();
}
$emnekode = $_POST['emnekode'];

$insert = "INSERT INTO meldingersporsmal (avsenderID, melding, emnekode, foreleserID) VALUES ('$avsenderID', '$melding', '$emnekode', '$foreleserID');";


mysqli_query($conn, $insert);


header("refresh:0.01; url=studentside.php");

?>
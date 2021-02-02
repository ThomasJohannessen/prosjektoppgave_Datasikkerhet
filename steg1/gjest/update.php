<?php 

include "../database.php";
include "../foreleser/index.php";

$conn = mysqli_connect($db, $username, $password, $dbname);

if (!$conn) {
    echo "Not connected to server";
}

if(!mysqli_select_db($conn, $dbname)) {
    echo "Database not selected";
}

$kommentar = $_POST['comment'];
$sporsmalID = $_POST['messageID'];

if (empty($kommentar)){
    echo $sporsmalID;
    header("refresh:3.01; url=gjestfeed.php");
    exit();
}

else {
$insert = "INSERT INTO kommentarer (sporsmalID, kommentar) VALUES ('$sporsmalID', '$kommentar');";

mysqli_query($conn, $insert);

header("refresh:6; url=gjestfeed.php");

}

?>
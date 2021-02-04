<?php 

include "../database.php";

global $conn;

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

header("refresh:0; url=gjestfeed.php");
exit();

}

?>
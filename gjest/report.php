<?php 

include "../database.php";

$conn = mysqli_connect($db, $username, $password, $dbname);

if (!$conn) {
    echo "Not connected to server";
}

if(!mysqli_select_db($conn, $dbname)) {
    echo "Database not selected";
}

$repcomment = $_POST['repcomment']; 
$sporsmalID = $_POST['sporsmalID'];

if (empty($repcomment)){
    header("refresh:0.01; url=gjestfeed.php");
    exit();
}

else {
    echo $sporsmalID;
    echo $repcomment;

    $insert = "INSERT INTO `rapportering` (`meldingID`, `RapportKommentar`, `behandlingStatus`) values ($sporsmalID, '$repcomment', 3);";

    mysqli_query($conn, $insert);

    //header("refresh:0.01; url=gjestfeed.php");  
    //exit();  

}



?>


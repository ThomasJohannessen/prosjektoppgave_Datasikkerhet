<?php 

include "../database.php";

global $conn;

$repcomment = $_POST['repcomment']; 
$sporsmalID = $_POST['sporsmalID'];

if (empty($repcomment)){
    header("refresh:0.01; url=gjestfeed.php");
    exit();
}

else {

    $insert = "INSERT INTO `rapportering` (`meldingID`, `RapportKommentar`, `behandlingStatus`) values ($sporsmalID, '$repcomment', 3);";

    mysqli_query($conn, $insert);

    header("refresh:0.01; url=gjestfeed.php");  
    exit();  

}



?>


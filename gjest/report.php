<?php 

include "../database.php";

$db = new Database();
$conn = $db->get_Connection("guest");

$repcomment = $conn -> real_escape_string(trim(htmlspecialchars($_POST["repcomment"])));
$sporsmalID = $conn -> real_escape_string(trim(htmlspecialchars($_POST["sporsmalID"])));

if (empty($repcomment)){
    header("refresh:0.01; url=gjestfeed.php");
    exit();
}

else {

    $insert = "CALL ReportAQuestionAsGuest('$sporsmalID', '$repcomment')";

    mysqli_query($conn, $insert);

    header("refresh:0.01; url=gjestfeed.php");  
    exit();  

}

?>


<?php 

session_start();
if($_SESSION['user_type'] == 3){
    include "../database.php";
    $db = new Database();
    $conn = $db->get_Connection();

    $avsenderID = $_SESSION['brukerID'];

    $melding = $_POST['question'];

    if ($melding == ""){
        header("refresh:0.01; url=studentside.php");
        exit();
    }
    $emnekode = $_POST['emnekode'];

    $insert = "INSERT INTO `meldinger` (`avsenderID`, `melding`,`emnekode`) VALUES ('$avsenderID', '$melding', '$emnekode')";


    mysqli_query($conn, $insert);


    header("refresh:.01; url=studentside.php");
    exit();
}
else
    echo "You are not a student!";
?>
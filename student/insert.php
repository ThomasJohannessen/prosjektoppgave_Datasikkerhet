<?php 

session_start();
if($_SESSION['user_type'] == 3){
    include "../database.php";
    include "../AppLogger.php";

    $db = new Database();
    $conn = $db->get_Connection();


    $melding = $_POST['question'];

    if ($melding == ""){
        header("refresh:0.01; url=studentside.php");
        exit();
    }
    $emnekode = $_POST['emnekode'];
    $email = $_SESSION['user_email'];

    $logg = new AppLogger("meldinger");
    $logger = $logg->getLogger();
    $logger->info("User with email: " . $email . " sent question in subject " . $emnekode . ".", ["message" => $melding]);

    $insert = "CALL SendQuestionStudent('$email', '$melding', '$emnekode')";

    mysqli_query($conn, $insert);


    header("refresh:.01; url=studentside.php");
    exit();
}
else
    echo "You are not a student!";
?>

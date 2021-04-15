<?php 

session_start();
if($_SESSION['user_type'] == 3){
    include "../database.php";
    include "../AppLogger.php";

    $db = new Database();
    $conn = $db->get_Connection("student");


    $melding = $conn -> real_escape_string(trim(htmlspecialchars($_POST["question"])));

    if ($melding == ""){
        header("refresh:0.01; url=studentside.php");
        exit();
    }
    $emnekode = $conn -> real_escape_string(trim(htmlspecialchars($_POST["emnekode"])));
    $email = $_SESSION['user_email'];

    $logg = new AppLogger("meldinger");
    $logger = $logg->getLogger();
    $logger->info("User with email: " . $email . " sent question in subject " . $emnekode . ".", ["message" => $melding]);



    $stmt = $conn->prepare("CALL SendQuestionStudent(?, ?, ?)");
    $stmt->bind_param("sss", $email, $melding, $emnekode);
    $stmt->execute();


    header("refresh:.01; url=studentside.php");
    exit();
}
else
    echo "You are not a student!";
?>

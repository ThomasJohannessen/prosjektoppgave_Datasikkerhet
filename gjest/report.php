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

    $insert = "CALL ReportAQuestionAsGuest(?, ?)";

    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($insert, $stmt)) {
        header("location: register.php?error=stmtfailed");
        exit();
    }else {
        mysqli_stmt_bind_param($insert, "ss", $sporsmalID, $repcomment);
        mysqli_stmt_execute($insert);
    }

    mysqli_query($conn, $insert);

    header("refresh:0.01; url=gjestfeed.php");  
    exit();  

}

?>


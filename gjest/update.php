<?php 

include "../database.php";

$db = new Database();
$conn = $db->get_Connection("guest");

$kommentar = $conn -> real_escape_string(trim(htmlspecialchars($_POST["comment"])));
$sporsmalID = $conn -> real_escape_string(trim(htmlspecialchars($_POST["messageID"])));

if (empty($kommentar)){
    echo $sporsmalID;
    header("refresh:3.01; url=gjestfeed.php");
    exit();
}

else {
$insert = "CALL CommentOnQuestionAsGuest(?, ?);";

mysqli_query($conn, $insert);

    if (!mysqli_stmt_prepare($conn, $insert)) {
        header("location: register.php?error=stmtfailed");
        exit();
    } else {
        mysqli_stmt_bind_param($conn, "is", $sporsmalID, $kommentar);
        mysqli_stmt_execute($conn);
    }
header("refresh:0; url=gjestfeed.php");
exit();

}

?>

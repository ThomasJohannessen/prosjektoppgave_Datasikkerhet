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

    $prep = $conn->prepare($insert);
    $prep->bind_param("ss", $sporsmalID,  $kommentar);
    $prep->execute();

    header("refresh:0; url=gjestfeed.php");
    exit();

}

?>

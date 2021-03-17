<?php

session_start();

if (isset($_POST['logout'])){
    include "../functions.php";
    logout();
}

if($_SESSION['user_type'] != 3){
    echo "Du er ikke en student!";
}
else{
include "../database.php";
$db = new Database();
$conn = $db->get_Connection();
$sql = "CALL GetPictureOfEachLecturerOfEachSubject()";

$results = mysqli_query($conn, $sql);
$array = array();
while($row = mysqli_fetch_array($results)) {
    $arrayRow = array();
    array_push($arrayRow, $row["Bilde"], $row["emnekode"]);
    array_push($array, $arrayRow);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Studentside</title>
    <link rel="stylesheet" href="../style.css?v=<?php echo time(); ?>">
    <script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function(event) {
        onChange();
    })

    function onChange() {
        let img = document.getElementById("bilde");
        let select = document.getElementById("emnevalg");
        let test = <?php echo json_encode($array); ?>;
        for(let i = 0; i < test.length; i++) {
            if(test[i][1] == select.value){
                img.src = "http://158.39.188.201/steg1/prosjektoppgave_Datasikkerhet/uploads/" + test[i][0];
                break;
            }
        }
    } 

    </script>
</head>
<body>

<nav ><ul class="navbar"> 
    <li><a href="meldingfeed.php">Feed</a></li>
    <li><a href="../change.php">Change password</a></li>
    <form method="post"> 
        <input type="submit" name="logout" class="button" value="Logout" id="logout"/> 
    </form> 
</ul>
</nav>


    <main>

    <div id="foreleser-spørsmål">

    <form action="insert.php" method="POST" autocomplete="off">

        <select name="emnekode" id="emnevalg" onchange="onChange()">
                <?php
                    $conn = $db->get_Connection();
                    $sql = "CALL GetPictureOfEachLecturerOfEachSubject()";
                    $results = mysqli_query($conn, $sql);
                    while($row = mysqli_fetch_array($results)) {
                        echo "<option name='" . $row["emnekode"] . "'value=\"".$row["emnekode"]."\">" . $row['emnekode'] . " </option>";
                    }
                ?>
        </select>  
                    <br>
                    <img id="bilde" src="" alt="forleser">
                    <br>
                    <input type="text" name="question" placeholder="Question" class="student-input">
                    <br>
                    <input type="submit" value="Send" id="send-question">

    </form>
    </div>

    </main>

</body>
</html>
<?php
}
?>

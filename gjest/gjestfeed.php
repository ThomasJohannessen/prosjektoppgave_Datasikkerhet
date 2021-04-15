<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feed</title>
    <link rel="stylesheet" href="../style.css?v=<?php echo time(); ?>">
</head>
<body>

    <nav><ul class="navbar">
        <li><a href="../login.php">Logg inn</a></li>
        <li><a href="../register.php">Registrer</a></li>
    </nav>

    <h1>Tast inn en firesifret pinkode</h1>

    <form  method='POST'>
        <input type="number" name="pinkode" id="pinkode"  placeholder="PIN" autocomplete="off">
        <input type='submit' value="ENTER" id="sendpin" name="sendbtn">
        <br>
        <br>
    </form>
    
    
    <?php

    include "../database.php" ;

    $db = new Database();
    $conn = $db->get_Connection("guest");


    if (isset($_POST['sendbtn'])){

        $pinkode = $conn -> real_escape_string(trim(htmlspecialchars($_POST["pinkode"])));

        if ($pinkode > 9999 || $pinkode < 1000){
            echo "<h2>Jeg sa firesifret pin....</h2>";
            exit;
        }
  
        
        $sql = "CALL GuestFeedGetSubjectAndLecturer(?)";

        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: register.php?error=stmtfailed");
            exit();
        }else {
            mysqli_stmt_bind_param($stmt, "s", $pinkode);
            mysqli_stmt_execute($stmt);
        }
        
        $result = $conn->query($sql);

        echo "<h2>Dette er siden til faget $pinkode</h2>";


        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                ?>
                <div id="div-feed">
                    <?php
                    echo "<b>Spørmål - </b>" . $row["melding"] . "<br>" . "<b>Svar - </b>" .$row["svar"] . "<br>";
                    echo "<img src=\"http://158.39.188.201/steg1/prosjektoppgave_Datasikkerhet/uploads/" . $row["Bilde"] . "\" alt=\"foreleser\">";
                    ?>
                    <form method="post" action="update.php" name="comment" id="kommentarForm">
                        <input type="text" placeholder="Kommentar" name="comment" autocomplete="off">
                        <input type="hidden" value="<?php echo $row["sporsmalID"]; ?>" name="messageID" require readonly>
                        <input type="submit" value="Send" name="commentbtn">
                    </form>
                
                    <form name="rapporter" action="report.php" method="post" >
                        <input type="submit" value="REPORT" name="rapporterbtn" id="report">
                        <input type="text" placeholder="Kommentar" name="repcomment" autocomplete="off">
                        <input type="hidden" value="<?php echo $row["sporsmalID"]; ?>" name="sporsmalID" require readonly>
                    </form>
                </div>
            <?php
                    
            }
        }
    }    
    ?>
</body>
</html>

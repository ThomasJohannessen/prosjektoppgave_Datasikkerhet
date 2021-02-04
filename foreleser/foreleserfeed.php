<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feed</title>
    <link rel="stylesheet" href="../style.css?v=<?php echo time(); ?>">
</head>
<body>

<nav ><ul class="navbar">
<li><a href="../change.php">Change password</a></li>
    <form method="post"> 
        <input type="submit" name="logout" class="button" value="Logout" id="logout"/> 
</form> 
</ul>
</nav>
    
    <?php

    include "../database.php" ;

    if (isset($_POST['logout'])){
        include "../functions.php";
        logout();
      }

    session_start();
    $emneKode = $_SESSION['subject_id'];
    if($_SESSION['user_type'] == 2){
        global $conn; 

        $sql = "SELECT * FROM meldinger WHERE emnekode = '$emneKode' order by emnekode asc;";
        
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                ?>
                <div id="div-feed">
                    <?php
                    echo "<b>Spørmål - </b>" . $row["melding"] . "<br>" . "<b>Svar - </b>" .$row["svar"] ;
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
    else{
        echo "Begone peasant. Foreleser only!";
    }
    ?>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feed</title>
    <link rel="stylesheet" href="../style.css?v=<?php echo time(); ?>">
</head>
<body>

<nav >
    <ul class="navbar">
        <li><a href="../change.php">Change password</a></li>
        <li><a href="index.php">Answer questions</a></li>
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
    $emneID = $_SESSION['subject_id'];

    if($_SESSION['user_type'] == 2){
        global $conn; 

        $sql = "SELECT * FROM meldinger WHERE emnekode = (SELECT emnekode FROM emne where emnePIN = $emneID);";
        
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                ?>
                <div id="div-feed">
                    <?php
                    echo "<b>Spørmål - </b>" . $row["melding"] . "<br>" . "<b>Svar - </b>" .$row["svar"] ;
                    ?>
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
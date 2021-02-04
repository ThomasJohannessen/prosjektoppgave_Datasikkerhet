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
		<li><a href="approve.php">Approve users</a></li>
		<li><a href="reported.php">Reported questions</a></li>
        
		<form method="post"> 
       		<input type="submit" name="logout" class="button" value="Logout" /> 
		</form> 
	</nav>
    
    <?php

    include "../database.php" ;

    if (isset($_POST['logout'])){
        include "../functions.php";
        logout();
      }

    session_start();
    if($_SESSION['user_type'] == 1){
        global $conn; 

        $pinkode = $_POST['pinkode'];  
            
    $sql = "SELECT `avsenderID`, `melding`, `svar`, `Bilde`, `Navn`, `foreleserID` FROM meldinger, brukere WHERE meldinger.avsenderID = brukere.BrukerID OR meldinger.foreleserID = brukere.BrukerID";
        
        $result = $conn->query($sql);
            
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    if(empty($row["Bilde"])){
                        continue;
                    }
                    else {
                        ?>
                        <div id="div-feed">
                            <?php
                            echo "<b>Spørmål - </b>" . $row["melding"] . "<br>" . "<b>Svar - </b>" .$row["svar"]  . "<br>" . "<b>Skrevet av - </b>" .$row["Navn"]. "<br>";
                            echo "<img src=\"http://158.39.188.201/steg1/prosjektoppgave_Datasikkerhet/uploads/" . $row["Bilde"] . "\" alt=\"foreleser\">";
                            echo "<a href="deletemessage.php?id=<?php echo $row['sporsmalID']; ?>">Delete</a>"
	    		?>
                        </div>
                    <?php   
                    }  
                }
        } 
    }
    else{
        echo "Begone peasant. Admin only!";
    }
    ?>
</body>
</html>

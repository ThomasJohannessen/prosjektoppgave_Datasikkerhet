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

    global $conn; 

    $pinkode = $_POST['pinkode'];  
        
    $sql = "SELECT * FROM meldinger;";
        
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
    ?>
</body>
</html>
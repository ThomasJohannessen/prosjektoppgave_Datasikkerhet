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
<li><a href="meldingfeed.php">Feed</a></li>
<li><a href="studentside.php">Student - POV</a></li>
<li><a href="../foreleser/index.php">Foreleser - POV</a></li>
<li><a href="gjestfeed.php">Gjest - POV</a></li></ul>
</nav>



    
    <?php

    include "../database.php";

    $conn = mysqli_connect($db, $username, $password, $dbname);
    $sql = "SELECT * FROM meldingersporsmal where svar is not null order by sporsmalID desc;";

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }
    
    $result = $conn->query($sql);

    ?>

  

    <?php
      
    if ($result->num_rows > 0) {
          
      while($row = $result->fetch_assoc()) {

    ?>

              <div id="div-feed">
                <?php
                  echo "<b>Emnekode - </b>" . $row["emnekode"] . "<br>" . "<b>Spørmål - </b>" . $row["melding"] . "<br>" . "<b>Svar - </b>" .$row["svar"] ;
                ?>
            </div>

          <?php
            
          }
      }




    ?>

</body>
</html>
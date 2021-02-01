

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foreleser</title>
    <link rel="stylesheet" href="../style.css?v=<?php echo time(); ?>">
</head>
<body>
<nav ><ul class="navbar">
<li><a href="../student/meldingfeed.php">Feed</a></li>
<li><a href="../student/studentside.php">Student - POV</a></li>
<li><a href="index.php">Foreleser - POV</a></li>
<li><a href="gjestfeed.php">Gjest - POV</a></li></ul>
</nav>

<?php

include "../database.php" ;

$conn = mysqli_connect($db, $username, $password, $dbname);
// $sql = "SELECT * FROM meldingersporsmal JOIN meldingersvar ON meldingersporsmal.sporsmalID = meldingersvar.svarID where meldingersvar.svar = ' ';";
$sql = "SELECT * FROM meldingersporsmal where svar is null";
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

$result = $conn->query($sql);
  
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {

      ?>

      <div id="foreleser-spørsmål">
        <?php

            echo $row["emnekode"] . "<br>" . $row["melding"] . "<br>" ;


        ?>

        <form  method="POST" autocomplete="off">
          <input type="text" name="svar" id="field" placeholder="Answer here">
          <br>
          <input type="hidden" value="<?php echo $row["sporsmalID"]; ?>" name="messageID" id="msgID" require readonly>
          <br>
          <input type="submit" id="svar" value="Svar" name="svarbtn">
        </form>

      </div>


      

      <?php

      if (isset($_POST['svarbtn'])){

        $svar = $_POST['svar'];
        $messageID = $_POST['messageID'];

        if (empty($svar)){
          
          header("refresh:0.01; url=index.php");
          
        }

        else {

          $sql2 = "UPDATE meldingersporsmal SET svar = '$svar' WHERE sporsmalID = $messageID;";
          if (!mysqli_query($conn, $sql2)){
            echo "Incorrect id";
          }


          header("refresh:0.5; url=index.php");
          exit;

        }
      

      }


      ?>
        
        
    <?php


    }

  } 



?>

    
</body>
</html>


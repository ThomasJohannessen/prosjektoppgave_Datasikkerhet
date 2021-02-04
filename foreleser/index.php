

<!DOCTYPE html>
<html lang="nb">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foreleser</title>
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

if (isset($_POST['logout'])){
  include "../functions.php";
  logout();
}

session_start();
$foreleserID = $_SESSION['brukerID'];
$emneID = $_SESSION['subject_id'];


if ($_SESSION["user_type"] == 3 || $_SESSION["user_type"] == 1){
  echo "DU ER IKKE EN FORELESER";
  exit();
}

else {

include "../database.php" ;

global $conn;
$sql_emneID = "SELECT emnekode FROM emne where emnePIN = $emneID"; 

$resultEmneId = $conn->query($sql_emneID);

echo $resultEmneId;

$sql = "SELECT * FROM meldinger where svar is null AND emnekode = $resultEmneId";

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



        if (isset($_POST['logout'])){
            include "../functions.php";
            logout();
        }

      if (isset($_POST['svarbtn'])){

        $svar = $_POST['svar'];
        $messageID = $_POST['messageID'];

        if (empty($svar)){
          
          header("refresh:0.01; url=index.php");
          exit();
          
        }

        else {

          $sql2 = "UPDATE meldinger SET svar = '$svar', foreleserID='$foreleserID' WHERE sporsmalID = $messageID;";
          if (!mysqli_query($conn, $sql2)){
            echo "Incorrect id";
          }


          header("refresh:0.01; url=index.php");
          exit;

        }
      

      }


      ?>
        
        
    <?php


    }

  } 

}



?>

    
</body>
</html>


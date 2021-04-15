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
<li><a href="foreleserfeed.php">Messages feed</a></li>
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
  $emneID = $_SESSION['subject_id'];

  if (isset($_POST['logout'])){
    include "../functions.php";
    logout();
  }

  if($_SESSION['user_type'] != 2){
    echo "Du er ikke en foreleser!";
  }  
  else {

      include "../database.php" ;

      $db = new Database();
      $conn = $db->get_Connection("foreleser");
      
      $em = $_SESSION['user_email'];


      $stmt = $conn->prepare("CALL GetAllUnansweredQuestionsForSubjectLecturer(?)");
      $stmt->bind_param("s", $emneID);
      $stmt->execute();
      $result = $stmt->get_result();

      
        
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
                <input type="hidden" value="<?php echo $row["Hash"]; ?>" name="messageID" id="msgID" require readonly>
                <br>
                <input type="submit" id="svar" value="Svar" name="svarbtn">
              </form>
            </div>
<?php
    $db = new Database();
    $conn = $db->get_Connection("foreleser");
  
        if (isset($_POST['svarbtn'])){  

        $svar = $conn -> real_escape_string(trim(htmlspecialchars($_POST["svar"])));
        $messageID = $conn -> real_escape_string(trim(htmlspecialchars($_POST["messageID"])));

          if (empty($svar)){
            
            header("refresh:0.01; url=index.php");
            exit();
            
          }
          else {

              include "../AppLogger.php";

              $logg = new AppLogger("meldinger");
              $logger = $logg->getLogger();
              $logger->info("Lecturer with Email: " . $em . " for subject: " . $emneID . " answered question with ID: " . $messageID . ".", ["answer" => $svar]);


              $stmt2 = $conn->prepare("CALL AnswerAQuestionLecturer(?, ?, ?)");
              $stmt2->bind_param("ssi", $svar, $em, $messageID);

              if (!$stmt2->execute()) {
                  echo "Incorrect id";
              }else{

                  header("refresh:0.01; url=index.php");
                  exit;
              }
          }
        }
      }
    } 
  }
  ?>
</body>
</html>


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
        
    $db = new Database();
    $conn = $db->get_Connection("admin");
            
    $sql = "CALL GetAllMessagesWithLecturerPictureAdmin()";
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
	    		    ?>
	    		    	<form method="post">
	    		    		<input type="hidden" value="<?php echo $row["Hash"]; ?>" name="messageID"/>
	    		    		<input type="submit" name="delete" value="Delete" />
				</form>


                        </div>
                    <?php
                    if (isset($_POST['delete'])){  
                    	
                    	$db = new Database();
    			$conn = $db->get_Connection("admin");
    			
    			$id = $conn -> real_escape_string(trim(htmlspecialchars($_POST["messageID"])));
    			
    			echo $id;


        		$stmt2 = $conn->prepare("CALL DeleteAMessageAdmin(?)");
        		$stmt2->bind_param("s", $id);

        		if (!$stmt2->execute()) {
        		    header("location: register.php?error=stmtfailed");
        		    exit();
        		}


			$del = mysqli_query($conn, $sql);

			if($del)
			{
   				mysqli_close($conn);
    				header("location:adminfeed.php");
    				exit;	
			} 
			else
 				echo "Error deleting message";
            
          		}   
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

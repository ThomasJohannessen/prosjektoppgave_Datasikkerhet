<!DOCTYPE html>
<html>
	<body>
		<form action="index.php">
    			<input type="submit" value="Home" />
		</form>

		<br>
		
		<form action = "" method = "post" action="forgot.php">
			<label>Email  :</label>
    			<input type="text" name="email"/>
    			<br>
    			<br>
    			<input type="submit" name="send" value=" Send "/>
    			<br>
		</form>
<?php

	if(isset($_POST['send']))
		doesEmailExistInDatabase();
	
	
	function doesEmailExistInDatabase()
	{
		$email = htmlspecialchars(trim($_POST['email']));
		
		include "database.php";
		
		$sql = "SELECT BrukerID, Passord FROM brukere WHERE Epost='$email'";
		
		$result = $conn->query($sql);
		
		
		if (mysqli_num_rows($result) > 0) 
			generateAndSend($email, $conn);
		else 
 		{
  			echo "<script>
				alert('Email not registered!');
			</script>";
		}
				
	}
	

	function generateAndSend($email, $conn)
	{
		$characters = 8;
		$validChars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    		$password = substr(str_shuffle(str_repeat($validChars,ceil($characters/strlen($validChars)) )),1,$characters);
	
		$header = "From:forgotten@pass.word \r\n";
		$header .= "MIME-Version: 1.0\r\n";
		$header .= "Content-type: text/html\r\n";
	
		$retval = mail ($email,"Forgotten password!",$password,$header);
		
		
		if( $retval == true )
		{	
			$sqlUpdate = "UPDATE brukere SET Passord='$password' WHERE Epost='$email'";

			if ($conn->query($sqlUpdate) === FALSE)
  				echo "Error updating record: " . $conn->error;
  			else
  			{
  				echo "<script>
					alert('Email sent successfully, remember to check the spam folder!');
					window.location.href='login.php';
				</script>";
			}
		}
		else
		{
			echo "<script>
				alert('Email not sent because of an error!');
			</script>";
		}
		
		$conn->close();
	}
?>

	</body>
</html>

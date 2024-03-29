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
		
		include "database.php";
		$db = new Database();
		$conn = $db->get_Connection("guest");
		$email = $conn -> real_escape_string(trim(htmlspecialchars($_POST["email"])));


        $stmt = $conn->prepare("CALL DoesEmailExistInDb(?)");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
		
		
		if ($user != null)
			send($email, $conn);
		else 
 		{
  			echo "<script>
				alert('Email not registered!');
			</script>";
		}
				
	}
	
	function generateRandom()
	{
		$characters = 8;
		$validChars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    		$password = substr(str_shuffle(str_repeat($validChars,ceil($characters/strlen($validChars)) )),1,$characters);
    		
    		return $password;
	}
	

	function send($email, $conn)
	{
		$db = new Database();
		$conn = $db->get_Connection("student");
		
		$password = generateRandom();
		
		$uppercase = preg_match('@[A-Z]@', $password);
		$lowercase = preg_match('@[a-z]@', $password);
		$number    = preg_match('@[0-9]@', $password);

		while(!$uppercase || !$lowercase || !$number || strlen($password) < 8)
		{
  			$password = generateRandom();
		}
	
		$header = "From:forgotten@pass.word \r\n";
		$header .= "MIME-Version: 1.0\r\n";
		$header .= "Content-type: text/html\r\n";
	
		$retval = mail ($email,"Forgotten password!",$password,$header);
		
		$hashed = password_hash($password, PASSWORD_DEFAULT);
		
		if( $retval == true )
		{
            $stmt = $conn->prepare("CALL ChangePasswordOfAUser(?, ?)");
            $stmt->bind_param("ss", $email, $hashed);

            if (!$stmt->execute())
  				echo "Error updating record: " . $conn->error;
  			else
  			{
  				echo "<script>
					alert('Email sent successfully, remember to check the spam folder!');
					window.location.href='index.php';
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

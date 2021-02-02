<!DOCTYPE html>
<html>
	<body>
		<form action="index.php">
    			<input type="submit" value="Home" />
		</form>

		<br>
		
		<form action = "" method = "post" action="forgot.php">
			<label>Confirm email  :</label>
    			<input type="text" name="email"/>
    			<br>
			<label>Old password  :</label>
    			<input type="password" name="old"/>
    			<br>
			<label>New password  :</label>
    			<input type="password" name="new1"/>
    			<br>
    			<label>Retype new password  :</label>
    			<input type="password" name="new2"/>
    			<br>
    			<br>
    			<input type="submit" name="change" value=" Change "/>
    			<br>
		</form>
<?php

	session_start();
	if(isset($_POST['change']))
	{
		
		$email = htmlspecialchars(trim($_POST['email']));
		
		if ($_SESSION['user_email'] == $email) 
		{
			$old = htmlspecialchars(trim($_POST['old']));
			$new1 = htmlspecialchars(trim($_POST['new1']));
			$new2 = htmlspecialchars(trim($_POST['new2']));

			include "database.php";
		
			$emailChecker = "SELECT * FROM brukere WHERE Epost='$email'";
		
			$resultFromEmailCheck = $conn->query($emailChecker);
		
			if (mysqli_num_rows($resultFromEmailCheck) > 0) 
			{
				$row = $resultFromEmailCheck->fetch_assoc();
				$verify = password_verify($old, $row['Passord']);
				
				if ($new1 === $old)
					echo "The new password can't be the same as the old one!";
				else if(empty($new2) || empty($new1)){
					echo "Fields cant be empty";
				}
				else if ($new1 !== $new2)
					echo "The two new passwords don't match!";
				else if ($verify)
					change($email, $new1, $conn);
				else if (!$verify)
					echo "The old password is wrong!";
			}
			else
				echo "The email doesn't exist in the system!";
		}
		else
			echo "Can't change another user's password. Please write your own email!";
	}
	
	function change($email, $new1, $conn)
	{
		
		$hashed = password_hash($new1, PASSWORD_DEFAULT);
		
		$sqlUpdate = "UPDATE brukere SET Passord='$hashed' WHERE Epost='$email'";

		if ($conn->query($sqlUpdate) === FALSE)
  			echo "Error updating password: " . $conn->error;
  		else
  		{	
			if ($_SESSION['user_type'] == 3){

				header("location: student/studentside.php");
				exit();
			}

			else if ($_SESSION['user_type'] == 2){
				header("location: foreleser/index.php");
				exit();
			}

			else if ($_SESSION['user_type'] == 1){
				header("location: admin/updateusers.php");
				exit();
			}
		}
		
		$conn->close();
	}
?>

	</body>
</html>

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

	include "AppLogger.php";

	$logg = new AppLogger("brukertilgang");
	$logger = $logg->getLogger();

	session_start();
	if(isset($_POST['change']))
	{
		
		$email = htmlspecialchars(trim($_POST['email']));
		$attempt_failed = true;
		if ($_SESSION['user_email'] == $email) 
		{
			$old = htmlspecialchars(trim($_POST['old']));
			$new1 = htmlspecialchars(trim($_POST['new1']));
			$new2 = htmlspecialchars(trim($_POST['new2']));

			include "database.php";
			
			$db = new Database();
			$conn = $db->get_Connection();
		
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
				else if ($verify) {
					$attempt_failed = false;
					change($email, $new1, $conn, $logger);
				}
				else if (!$verify)
					echo "The old password is wrong!";
			}
			else
				echo "The email doesn't exist in the system!";
		}
		else
			echo "Can't change another user's password. Please write your own email!";
		if($attempt_failed) {
			//temp til inputvalidering er implementert
			$logger->notice("Attempt to change password", ["email" => $_SESSION["user_email"], "old_pw_input" => $old, "new1_pw_input" => $new1, "new2_pw_input" => $new2]);	
		}
	}
	
	function change($email, $new1, $conn, $logger)
	{
		$db = new Database();
		$conn = $db->get_Connection();
		$hashed = password_hash($new1, PASSWORD_DEFAULT);
		$ip = AppLogger::getIPAddress();
		
		$sqlUpdate = "UPDATE brukere SET Passord='$hashed' WHERE Epost='$email'";

		if ($conn->query($sqlUpdate) === FALSE)
  			echo "Error updating password: " . $conn->error;
  		else
  		{	
			if ($_SESSION['user_type'] == 3){
				$logger->info("Student password changed!", ["email" => $_SESSION["user_email"], "new_pw" => $hashed]);

				header("location: student/studentside.php");
				exit();
			}

			else if ($_SESSION['user_type'] == 2){
				$logger->info("Lecturer password changed!", ["email" => $_SESSION["user_email"], "new_pw" => $hashed]);

				header("location: foreleser/index.php");
				exit();
			}

			else if ($_SESSION['user_type'] == 1){
				$logger->alert("Admin password changed!", ["email" => $_SESSION["user_email"], "new_pw" => $hashed, "ip" => $ip]);
				header("location: admin/updateusers.php");
				exit();
			}

		}
		
		$conn->close();
	}
?>

	</body>
</html>

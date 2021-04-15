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
		include "database.php";
		
		$db = new Database();
		
		$conn = "";
		
		if ($_SESSION['user_type'] == 1)
			$conn = $db->get_Connection("admin");
		if ($_SESSION['user_type'] == 2)
			$conn = $db->get_Connection("foreleser");
		if ($_SESSION['user_type'] == 3)
			$conn = $db->get_Connection("student");
		
		$email = $conn -> real_escape_string(trim(htmlspecialchars($_POST["email"])));
		
		$attempt_failed = true;
		if ($_SESSION['user_email'] == $email) 
		{
			
			$old = $conn -> real_escape_string(trim(htmlspecialchars($_POST["old"])));
			$new1 = $conn -> real_escape_string(trim(htmlspecialchars($_POST["new1"])));
			$new2 = $conn -> real_escape_string(trim(htmlspecialchars($_POST["new2"])));
			
			$emailChecker = "";
		
			if ($_SESSION['user_type'] == 1)
				$emailChecker = "CALL GetEmailAndPassAllUsers(?)";

			elseif ($_SESSION['user_type'] == 2)
				$emailChecker = "CALL GetEmailAndPassAllLecturers(?)";

			elseif ($_SESSION['user_type'] == 3)
				$emailChecker = "CALL GetEmailAndPassAllStudents(?)";

            $stmt = $conn->prepare($emailChecker);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();


			if ($result->fetch_assoc() != null)
			{
				$verify = password_verify($old, $result['Passord']);
				
				$uppercase = preg_match('@[A-Z]@', $new1);
				$lowercase = preg_match('@[a-z]@', $new1);
				$number    = preg_match('@[0-9]@', $new1);

				if(!$uppercase || !$lowercase || !$number || strlen($new1) < 8)
  					echo "Password must contain at least 8 characters with minimum one number, one lowercase and one uppercase letter!.";
				else if ($new1 === $old)
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
			$logger->info("Change password attempt");
		}
	}
	
	function change($email, $new1, $conn, $logger)
	{
	    echo "1";
		$db = new Database();
		$conn = $db->get_Connection("student");
		$hashed = password_hash($new1, PASSWORD_DEFAULT);
		//$ip = (string) AppLogger::getIPAddress();
		//$ipAddress = $_SERVER['REMOTE_ADDR']?:($_SERVER['HTTP_X_FORWARDED_FOR']?:$_SERVER['HTTP_CLIENT_IP']);

		$sqlUpdate = "CALL ChangePasswordOfAUser(?, ?)";
		    $stmt = $conn->prepare($sqlUpdate);
		    $stmt->bind_param("ss", $email, $hashed);



		if (!$stmt->execute())
  			echo "Error updating password: " . $conn->error;
  		else
  		{	
			if ($_SESSION['user_type'] == 3){
				$logger->info("Student password changed!", ["email" => $_SESSION["user_email"], "new_pw" => $hashed]);

				//header("location: student/studentside.php");
				//exit();
			}

			else if ($_SESSION['user_type'] == 2){
				$logger->info("Lecturer password changed!", ["email" => $_SESSION["user_email"], "new_pw" => $hashed]);

				header("location: foreleser/index.php");
				exit();
			}

			else if ($_SESSION['user_type'] == 1){
				$logger->alert("Admin password changed!", ["email" => $_SESSION["user_email"], "new_pw" => $hashed]);
				header("location: admin/updateusers.php");
				exit();
			}

		}
		
		$conn->close();
	}
?>

	</body>
</html>

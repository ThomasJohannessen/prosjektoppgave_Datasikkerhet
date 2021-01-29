<!DOCTYPE html>
<html>
	<body>
		<! -- change to correct page -->
		<form action="index.php">
    			<input type="submit" value="Home" />
		</form>

		<br>
		
		<form action = "" method = "post" action="forgot.php">
			<label>Old password  :</label>
    			<input type="text" name="old"/>
    			<br>
			<label>New password  :</label>
    			<input type="text" name="new1"/>
    			<br>
    			<label>Retype new password  :</label>
    			<input type="text" name="new2"/>
    			<br>
    			<br>
    			<input type="submit" name="change" value=" Change "/>
    			<br>
		</form>
<?php

	if(isset($_POST['change']))
	{
		$old = trim($_POST['old']);
		$new1 = trim($_POST['new1']);
		$new2 = trim($_POST['new2']);
		
		if ($new1 === $old)
			echo "The new password can't be the same as the old one!";
		else if ($new1 !== $new2)
			echo "The two new passwords don't match!";
		else
			passwordUpdater($old, $new1);
	}
	
	function passwordUpdater($old, $new1)
	{
		include "dbconnection.php";

		$sql = "SELECT BrukerID, Passord, Epost FROM brukere WHERE Passord='$old'";
		
		$result = $conn->query($sql);
		
		
		if (mysqli_num_rows($result) > 0) 
			change($old, $new1, $conn);
		else 
 		{
  			echo "<script>
				alert('The old password is incorrect!');
			</script>";
		}
		
				
	}
	

	function change($old, $new1, $conn)
	{
		
		$sqlUpdate = "UPDATE brukere SET Passord='$new1' WHERE Passord='$old'";

		if ($conn->query($sqlUpdate) === FALSE)
  			echo "Error updating password: " . $conn->error;
  		else
  		{
  			echo "<script>
				alert('Password update OK!');
			</script>";
		}
		
		$conn->close();
	}
?>

	</body>
</html>

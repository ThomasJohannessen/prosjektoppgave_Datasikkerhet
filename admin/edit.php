<?php
	session_start();
	if($_SESSION['user_type'] == 1)
   	{
		include "../database.php";
		$db = new Database();
		$conn = $db->get_Connection();

		$epost = htmlspecialchars(trim($_GET['epost']));
		
		$navn = htmlspecialchars(trim($_GET['navn']));
			

		if(isset($_POST['update']))
		{
    			$name = htmlspecialchars(trim($_POST['name']));
    			$email = htmlspecialchars(trim($_POST['email']));
			
			$sql2 = "CALL UpdateAUserAdmin('$name', '$email', '$epost')";
			
    			$edit = mysqli_query($conn, $sql2);
	
    			if($edit)
    			{
        			mysqli_close($conn); 
        			header("location:updateusers.php"); 
        			exit;
    			}
    			else
        			echo mysqli_error();  	
		}
	}
	else
		echo "Begone peasant. Admin only!";
?>

<h3>Update Data</h3>

<form method="POST">
	<input type="text" name="name" value="<?php echo $navn ?>" placeholder="New Name" Required>
  	<input type="text" name="email" value="<?php echo $epost ?>" placeholder="New Email" Required>
  	<input type="submit" name="update" value="Update">
</form>

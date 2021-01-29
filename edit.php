<?php

	include "dbconnection.php";

	$id = $_GET['id'];

	$qry = mysqli_query($conn,"select * from brukere where BrukerID='$id'");

	$data = mysqli_fetch_array($qry);

	if(isset($_POST['update']))
	{
    		$name = $_POST['name'];
    		$email = $_POST['email'];
	
    		$edit = mysqli_query($conn,"update brukere set Navn='$name', Epost='$email' where BrukerID='$id'");
	
    		if($edit)
    		{
        		mysqli_close($conn); 
        		header("location:updateusers.php"); 
        		exit;
    		}
    	else
        	echo mysqli_error();  	
	}
?>

<h3>Update Data</h3>

<form method="POST">
	<input type="text" name="name" value="<?php echo $data['Navn'] ?>" placeholder="New Name" Required>
  	<input type="text" name="email" value="<?php echo $data['Epost'] ?>" placeholder="New Email" Required>
  	<input type="submit" name="update" value="Update">
</form>

<!DOCTYPE html>
<html>
	<head>
  		<title>Reported Messages</title>
		<link rel="stylesheet" href="../style.css">
	</head>
	<body>
	<nav ><ul class="navbar">
		<li><a href="adminfeed.php">Messages feed</a></li>
		<li><a href="approve.php">Approve users</a></li>
		<li><a href="updateusers.php">Edit users</a></li>
		<form method="post"> 
       		<input type="submit" name="logout" class="button" value="Logout" /> 
		</form> 
	</nav>

		<h2>A List Over All Reported Messages</h2>
	
		<table border="2" id="reported-questions">
  			<tr>
    				<td>Message ID</td>
    				<td>Processing ID</td>
    				<td>Comment From Admin</td>
    				<td>Comment From User</td>
  			</tr>

			<?php

				if (isset($_POST['logout'])){
					include "../functions.php";
					logout();
				}
				
				session_start();
				if($_SESSION['user_type'] == 1)
   				{

					include "../database.php";
					$db = new Database();
					$conn = $db->get_Connection();

					$records = mysqli_query($conn,"select * from rapportering");

					while($data = mysqli_fetch_array($records))
					{
			?>
  			<tr>
    				<td><?php echo $data['meldingID']; ?></td>
    				<td><?php echo $data['behandlingStatus']; ?></td>
    				<td><?php echo $data['adminKommentar']; ?></td>    
    				<td><?php echo $data['RapportKommentar']; ?></td>    
  			</tr>	
			<?php
					}
				}
				else
					echo "Begone peasant. Admin only!";		
			?>
		</table>
	

	</body>
</html>

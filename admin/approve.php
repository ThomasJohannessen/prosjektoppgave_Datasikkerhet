<!DOCTYPE html>
<html>
	<head>
		  <title>Approve Teacher Status</title>
		  <link rel="stylesheet" href="../style.css">
	</head>
	<body>

	<nav ><ul class="navbar">
		<li><a href="adminfeed.php">Messages feed</a></li>
		<li><a href="updateusers.php">Edit users</a></li>
		<li><a href="reported.php">Reported questions</a></li>
		<form method="post"> 
       		<input type="submit" name="logout" class="button" value="Logout" /> 
		</form> 
	</nav>

		<h2>Requests To Become Teacher</h2>

		<table border="2">
  			<tr>
    				<td>User ID</td>
    				<td>Name</td>
    				<td>Email</td>
    				<td>Approve</td>
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

					$records = mysqli_query($conn,"select * from brukere where (Brukertype='2' and Brukerstatus = '0')");

					while($data = mysqli_fetch_array($records))
					{
				?>
  				<tr>
    					<td><?php echo $data['BrukerID']; ?></td>
    					<td><?php echo $data['Navn']; ?></td>
    					<td><?php echo $data['Epost']; ?></td>    
    					<td><a href="commitapproval.php?id=<?php echo $data['BrukerID']; ?>">Approve</a></td>
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

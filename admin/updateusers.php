<!DOCTYPE html>
<html>
	<head>
  		<title>Display all records from Database</title>
		  <link rel="stylesheet" href="../style.css">
	</head>
	<body>

	<nav ><ul class="navbar">
		<li><a href="adminfeed.php">Messages feed</a></li>
		<li><a href="approve.php">Approve users</a></li>
		<li><a href="reported.php">Reported questions</a></li>
		<form method="post"> 
       		<input type="submit" name="logout" class="button" value="Logout" /> 
		</form> 
	</nav>

		<table border="2">
  			<tr>
    				<td>User ID</td>
    				<td>Name</td>
    				<td>Email</td>
    				<td>Update</td>
    				<td>Delete</td>
  			</tr>

			<?php
				include "../AppLogger.php";

				if (isset($_POST['logout'])){
					include "../functions.php";
					logout();
				}
				
				session_start();
				
				if($_SESSION['user_type'] != 1){
					echo "Du er ikke en Admin!";
				}  
				else {
   				
					include "../database.php";
					$db = new Database();
					$conn = $db->get_Connection();

					$records = mysqli_query($conn,"select * from brukere");

					while($data = mysqli_fetch_array($records))
					{
			?>
  			<tr>
    				<td><?php echo $data['BrukerID']; ?></td>
    				<td><?php echo $data['Navn']; ?></td>
    				<td><?php echo $data['Epost']; ?></td>    
					<td><a href="edit.php?id=<?php echo $data['BrukerID']; ?>">Edit</a></td>
    				<td><a href="delete.php?id=<?php echo $data['BrukerID']; ?>">Delete</a></td>
  			</tr>	
			<?php
					}
				}
			?>
		</table>
	</body>
</html>

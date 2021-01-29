<!DOCTYPE html>
<html>
	<head>
  		<title>Display all records from Database</title>
	</head>
	<body>

		<h2>Users</h2>
		
		<form action="approve.php">
    			<input type="submit" value="Approve Teacher Status" />
		</form>

		<table border="2">
  			<tr>
    				<td>User ID</td>
    				<td>Name</td>
    				<td>Email</td>
    				<td>Update</td>
    				<td>Delete</td>
  			</tr>

			<?php

				include "dbconnection.php";

				$records = mysqli_query($conn,"select * from brukere");

				while($data = mysqli_fetch_array($records))
				{
			?>
  			<tr>
    				<td><?php echo $data['BrukerID']; ?></td>
    				<td><?php echo $data['Navn']; ?></td>
    				<td><?php echo $data['Epost']; ?></td>    
    				<td><a href="edit.php?id=<?php echo $data['BrukerID']; ?>">Update</a></td>
    				<td><a href="delete.php?id=<?php echo $data['BrukerID']; ?>">Delete</a></td>
  			</tr>	
			<?php
				}
			?>
		</table>

	</body>
</html>

<!DOCTYPE html>
<html>
	<head>
  		<title>Reported Messages</title>
	</head>
	<body>

		<h2>A List Over All Reported Messages</h2>

		<table border="2">
  			<tr>
    				<td>Message ID</td>
    				<td>Processing ID</td>
    				<td>Comment From Admin</td>
    				<td>Comment From User</td>
  			</tr>

			<?php
				session_start();
				if($_SESSION['user_type'] === 1)
   				{

					include "dbconnection.php";

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

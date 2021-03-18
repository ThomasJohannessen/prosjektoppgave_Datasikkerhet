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
					$db = new Database();
					$conn = $db->get_Connection();
					
					$sql = "CALL GetAllLecturerRequests()";

					$records = mysqli_query($conn, $sql);

					while($data = mysqli_fetch_array($records))
					{
				?>
  				<tr>
  					<td><?php echo $data['Epost']; ?></td>
  					<td><?php echo $data['Navn']; ?></td>
    					<form method="post">
	    		    		<input type="hidden" value="<?php echo $data["Epost"]; ?>" name="email"/>
	    		    		<td><input type="submit" name="approve" value="Approve" /></td>
	    		    		</form>
  				</tr>	
				<?php
					if (isset($_POST['approve'])){
						include "../AppLogger.php";
						$db = new Database();
						$conn = $db->get_Connection();
	   		
						$epost = htmlspecialchars(trim($_POST['email']));


						$sql = "CALL CommitApprovalOfLecturerRequest('$epost')";

						$qry = mysqli_query($conn, $sql);
			

						if($qry)
						{
							$logg = new AppLogger("brukertilgang");
			
							$logger = $logg->getLogger();

							$logger->notice("Admin approved a lecturer", ["Admin" => $_SESSION["user_email"], "Approved_lecturer_Email" => $epost]);
	    						mysqli_close($conn);
	    						header("location:approve.php");
	    						exit;	
						}
						else
	    						echo "Error approving teacher status";
					
					}
						
					}
				}
   				else
   					echo "Begone peasant. Admin only!";
				?>

   				
				
		</table>

	</body>
</html>

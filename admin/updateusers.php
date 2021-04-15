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
    				<td>Name</td>
    				<td>Email</td>
    				<td>Update</td>
    				<td>Delete</td>
  			</tr>

			<?php

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
					$conn = $db->get_Connection("admin");

					$stmt = $conn->prepare("CALL GetNameAndEmailOfAllStudentsAndLecturers(?)");
					$stmt->bind_param("s", $email);
					$stmt->execute();
					$result = $stmt->get_result();
					$user = $result->fetch_assoc();
					


					while($user != null)
					{
			?>
  			<tr>
				<form method="post">
    					<td><input type="text" value="<?php echo $user["Navn"]; ?>" name="name"/></td>
    					<td><input type="text" value="<?php echo $user["Epost"]; ?>" name="updatedEmail"/></td>
    					<input type="hidden" value="<?php echo $user["Epost"]; ?>" name="originalEmail"/>
	    		    		<td><input type="submit" name="update" value="Update" /></td>
	    		    		<td><input type="submit" name="delete" value="Delete" /></td>
	    		    	</form>
  			</tr>	
			<?php
				if(isset($_POST['update'])) {
                    $db = new Database();
                    $conn = $db->get_Connection("admin");
                    $name = $conn->real_escape_string(trim(htmlspecialchars($_POST["name"])));

                    $email = $conn->real_escape_string(trim(htmlspecialchars($_POST["updatedEmail"])));
                    $epost = $conn->real_escape_string(trim(htmlspecialchars($_POST["originalEmail"])));
                    $sql2 = "CALL UpdateAUserAdmin(?, ?, ?)";

                    $edit = mysqli_query($conn, $sql2);

                    if ($edit) {
                        mysqli_close($conn);
                        header("location:updateusers.php");
                        exit;
                    } elseif (!$edit) {
                        echo mysqli_error();
                    } else {
                        mysqli_stmt_bind_param($edit, "sss", $name, $email, $epost);
                        mysqli_stmt_execute($edit);
                    }
                    if (isset($_POST['delete'])) {
                        include "../AppLogger.php";

                        $db = new Database();
                        $conn = $db->get_Connection("admin");

                        $epost = $conn->real_escape_string(trim(htmlspecialchars($_POST["originalEmail"])));

                        $stmt2 = $conn->prepare("CALL DeleteAUserAdmin(?)");
                        $stmt2->bind_param("s", $epost);



                        if ($stmt2->execute()) {
                            $logg = new AppLogger("brukertilgang");

                            $logger = $logg->getLogger();

                            $logger->notice("Admin deleted a user", ["Admin" => $_SESSION["user_email"], "Deleted_User_Email" => $epost]);
                            mysqli_close($conn);
                            header("location:updateusers.php");
                            exit;
                        } else {
                            echo "Error deleting user";
                        }
                    }
                }}}
			?>
		</table>
	</body>
</html>
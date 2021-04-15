<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feed</title>
    <link rel="stylesheet" href="../style.css?v=<?php echo time(); ?>">
</head>
<body>
<nav><ul class="navbar">
<li><a href="studentside.php">Skriv spørsmål</a></li>
<li><a href="../change.php">Change password</a></li>
    <form method="post"> 
        <input type="submit" name="logout" class="button" value="Logout" id="logout"/> 
    </form> 
</nav>

<?php
    include "../database.php";

    session_start();

    if (isset($_POST['logout'])){
        include "../functions.php";
        logout();
    }
    
    if($_SESSION['user_type'] == 3)
   	{
   	
   	$email = $_SESSION['user_email'];

        $db = new Database();
        $conn = $db->get_Connection("student");

        $sql = "CALL GetMessageFeedStudent(?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
            
?>
    <div id="div-feed">
        <?php
            echo "<b>Emnekode - </b>" . $row["emnekode"] . "<br>" . "<b>Spørmål - </b>" . $row["melding"] . "<br>" . "<b>Svar - </b>" .$row["svar"] . "<br>";
            echo "<img src=\"http://158.39.188.201/steg1/prosjektoppgave_Datasikkerhet/uploads/" . $row["Bilde"] . "\" alt=\"foreleser\">";
            
            $em = $row["Epost"];
            
            $sql_image = "CALL GetPictureOfALecturer(?)";
                $stmt = $conn->prepare($sql_image);
                $stmt->bind_param("s", $em);
                $stmt->execute();
                $result = $stmt->get_result();
                $user = $result->fetch_assoc();
            $image = mysqli_query($conn, $sql_image);

            if ($row = mysqli_fetch_assoc($image)) {
                echo "<img src=\"uploads/" . $image["Bilde"] . "\" alt=\"foreleser\">";
            }
        ?>
    </div>
<?php
        }
    }
    }
    else
        echo "Du er ikke en student";
?>
</body>
</html>

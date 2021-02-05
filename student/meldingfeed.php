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

    if($_SESSION['user_type'] == 3)
   	{
        $brukerId = $_SESSION['brukerID'];

        if (isset($_POST['logout'])){
        include "../functions.php";
        logout();
        }

        $db = new Database();
        $conn = $db->get_Connection();

        $sql = "SELECT `melding`, `svar`, `Bilde`, `foreleserID` FROM meldinger, brukere WHERE `avsenderID` = $brukerId AND meldinger.foreleserID = brukere.BrukerID";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
            
?>
    <div id="div-feed">
        <?php
            echo "<b>Emnekode - </b>" . $row["emnekode"] . "<br>" . "<b>Spørmål - </b>" . $row["melding"] . "<br>" . "<b>Svar - </b>" .$row["svar"] . "<br>";
            echo "<img src=\"http://158.39.188.201/steg1/prosjektoppgave_Datasikkerhet/uploads/" . $row["Bilde"] . "\" alt=\"foreleser\">";

            $sql_image = "SELECT `Bilde` FROM `brukere` WHERE `foreleserID`= '" . $row["foreleserID"] . "'";
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
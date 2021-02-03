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
<li><a href="studentside.php">Student - POV</a></li>
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

    global $conn;

    $sql = "SELECT * FROM meldinger where svar is not null order by sporsmalID desc;";

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {

?>
    <div id="div-feed">
        <?php
            echo "<b>Emnekode - </b>" . $row["emnekode"] . "<br>" . "<b>Spørmål - </b>" . $row["melding"] . "<br>" . "<b>Svar - </b>" .$row["svar"] ;

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
?>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Studentside</title>
    <link rel="stylesheet" href="../style.css?v=<?php echo time(); ?>">

</head>
<body>

<nav ><ul class="navbar"> 
<li><a href="meldingfeed.php">Feed</a></li>
<li><a href="studentside.php">Student - POV</a></li>
<li><a href="../foreleser/index.php">Foreleser - POV</a></li>
<li><a href="../gjest/gjestfeed.php">Gjest - POV</a></li></ul>
</nav>

    <?php

    include "../database.php";

    $conn = mysqli_connect($db, $username, $password, $dbname); 
    $sql = "SELECT distinct emnekode FROM emne;";
    $results = mysqli_query($conn, $sql);

    ?>


    <main>

    <div id="foreleser-spørsmål">

    <form action="insert.php" method="POST" autocomplete="off">

        <select name="emnekode" id="emnevalg">
                <?php
                    while($row = mysqli_fetch_array($results)) {
                        echo "<option name='" . $row["emnekode"] . "'>" . $row['emnekode'] . "</option>";
                    }
                ?>
        </select>  
                     <br>
                    <input type="text" name="messageID" placeholder="StudentID" class="student-input">
                    <br>
                    <input type="text" name="question" placeholder="Question" class="student-input">
                    <br>
                    <input type="submit" value="Send" id="send-question">

    </form>
    </div>

    </main>

</body>
</html>

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
<form method="post"> 
        <input type="submit" name="logout" class="button" value="Logout" /> 
    </form> 
    <a href="../change.php">Change password</a>
</nav>

    <?php

    include "../database.php";

    $conn = mysqli_connect($db, $username, $password, $dbname); 
    $sql = "SELECT distinct emnekode FROM emne;";
    $results = mysqli_query($conn, $sql);

    if (isset($_POST['logout'])){
        include "../functions.php";
        logout();
    }

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
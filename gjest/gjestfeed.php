<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feed</title>
    <link rel="stylesheet" href="../style.css?v=<?php echo time(); ?>">
</head>
<body>

    <nav ><ul class="navbar">
        <li><a href="../login.php">Log inn</a></li>
        <li><a href="../register.php">Registrer</a></li>
    </nav>

    <h1>Tast inn en firesifret pinkode</h1>

    <form  method='POST'>
        <input type="number" name="pinkode" id="pinkode"  placeholder="PIN" autocomplete="off">
        <input type='submit' value="ENTER" id="sendpin" name="sendbtn">
        <br>
        <br>
    </form>
    
    
    <?php

    include "../database.php" ;

    global $conn; 

    

    if (isset($_POST['sendbtn'])){

        $pinkode = $_POST['pinkode'];

        if ($pinkode > 9999 || $pinkode < 1000){
            echo "<h2>Jeg sa firesifret pin....</h2>";
            exit;
        }

        switch($pinkode) {
            case 1032 : 
                $emneKode = "ITF885";
                break;
            case 1033 : 
                $emneKode = "ITF886";
                break;
            case 1034 : 
                $emneKode = "ITF887";
                break;
            case 1035 : 
                $emneKode = "ITF888";
                break;
            default:
                echo "<h2>Denne pin-koden eksisterer ikke!</h2>";
                exit;
        }    
        
        //$sql = "SELECT * FROM meldinger WHERE emnekode = '$emneKode' order by emnekode asc;";
        $sql = "SELECT `sporsmalID`, `melding`, `svar`, `Bilde`, `foreleserID` FROM meldinger, brukere WHERE emnekode = '$emneKode' OR meldinger.foreleserID = brukere.BrukerID";
        
        $result = $conn->query($sql);

        echo "<h2>Dette er siden til faget $emneKode</h2>";
        
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                ?>
                <div id="div-feed">
                    <?php
                    echo "<b>Spørmål - </b>" . $row["melding"] . "<br>" . "<b>Svar - </b>" .$row["svar"] ;
                    echo "<img src=\"http://158.39.188.201/steg1/prosjektoppgave_Datasikkerhet/uploads/" . $row["Bilde"] . "\" alt=\"foreleser\">";
                    ?>
                    <form method="post" action="update.php" name="comment" id="kommentarForm">
                        <input type="text" placeholder="Kommentar" name="comment" autocomplete="off">
                        <input type="hidden" value="<?php echo $row["sporsmalID"]; ?>" name="messageID" require readonly>
                        <input type="submit" value="Send" name="commentbtn">
                    </form>
                
                    <form name="rapporter" action="report.php" method="post" >
                        <input type="submit" value="REPORT" name="rapporterbtn" id="report">
                        <input type="text" placeholder="Kommentar" name="repcomment" autocomplete="off">
                        <input type="hidden" value="<?php echo $row["sporsmalID"]; ?>" name="sporsmalID" require readonly>
                    </form>
                </div>
            <?php
                    
            }
        }
    }    
    ?>
</body>
</html>
<!doctype html>
<html lang="nb">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Logg inn som gjestebruker</title>
    </head>
    <body>
        <header>
            <h1>Logg inn som gjestebruker med PIN-kode:</h1>
        </header>

        <form method="post">                                                  
            <label for="guestPincode">Pin kode:</label><br>
            <input type="text" id="guestPincode" name="guestPincode"><br><br>
            <input type="submit" value="Logg inn" name="submitBtn">
        </form>
    
        <?php

        include "database.php";

        function checkIfPinExists(){
            $db = new Database();
            $conn = $db->get_Connection("guest");
            
            $input = $conn -> real_escape_string(trim(htmlspecialchars($_POST["guestPincode"])));
            
            $result = $conn->query("CALL GetAllSubjectCodesAndPins()");
            $row = $result -> fetch_array(MYSQLI_ASSOC);

            if($input == $row["emnePIN"]){
                $_SESSION['emnePIN'] = $input;
            }

            else
                echo '<script>alert("Det eksisterer ingen fag med denne koden.")</script>'; 

            $conn->close(); 
            $result -> free_result();
            $_POST = array();

        }
        if(isset($_POST['submitBtn'])) {
           checkIfPinExists();
           header("location: gjest/gjestfeed.php");
            exit();
        }

        ?>
    </body>
</html>

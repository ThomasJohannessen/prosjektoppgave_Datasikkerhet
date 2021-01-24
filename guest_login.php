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

        <form method="post" action="">
            <label for="guestPincode">Pin kode:</label><br>
            <input type="text" id="guestPincode" name="guestPincode"><br><br>
            <input type="submit" value="Logg inn" name="submit">
        </form>
    
        <?php
        function display(){
            $input = $_POST['guestPincode'];
            $mysqli = new mysqli(SERVER, DBUSER, DBPASS, DATABASE);                         // !!! trenger finne alert løsning
            $result = $mysqli->query("SELECT id FROM mytable WHERE city = 'c7'");           // !!! trenger finne alert løsning
            if($result->num_rows == 0) {
                // row not found
                //alert("Fag med kode: " + $input + " eksisterer ikke.");           !!! trenger finne alert løsning
            } 
            else {
                setcookie("guest_pin", $input);          
            }
        }
        if(isset($_POST['submit']))
        {
           display();
           $mysqli->close();
        }            
        ?>
    </body>
</html>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>
<body>
<?php
    //functions.php
    $mysqli = new mysqli('localhost', 'root', '', 'oblig1');

    //Print error message if no connection
    if($mysqli->connect_error) {
        die($mysqli->connect_errno. ": ".$mysqli->connect_error);
    }

    session_start();


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $mysqli -> real_escape_string(trim(htmlspecialchars($_POST["email"])));
        $password = $mysqli -> real_escape_string(trim(htmlspecialchars($_POST["password"])));

        $sql_register = "SELECT `Navn`, `Brukertype`, `EmneID`, `Studieretning`, `Brukerstatus` FROM `brukere` WHERE `Epost`= '" . $email . "' AND `Passord` = '" . $password . "'";
        $register_user = mysqli_query($mysqli, $sql_register);

        if (emptyInputLogin($email, $password) !== false) {
            header("location: ../login.php?error=emptyinput");
        }

        loginUser($email, $password);
    }

    function emptyInputLogin ($email, $password) {
        if (empty($email) || empty($password)) {
            $res = true;
        } else {
            $res = false;
        }
        return $res;
    }

    function mailTaken($email) {
        global $mysqli;

        $sql_user_exists = "SELECT * FROM `brukere` WHERE `Epost`= '" . $email . "'";

        $stmt = mysqli_stmt_init($mysqli);

        if (!mysqli_stmt_prepare($stmt, $sql_user_exists)) {
            header("location: register.php?stmtfailed");
            exit();
        }

        $user_exists = mysqli_query($mysqli, $sql_user_exists);

        if ($row = mysqli_fetch_assoc($user_exists)) {
            return $row;
        } else {
            $res = false;
            return $res;
        }
    }

    function loginUser($email, $password) {
        $mailTaken = mailtaken($email);

        if ($mailTaken === false) {
            header("location: login.php?error=wronglogin");
            exit();
        }

        $hashedPassword = $mailTaken["Passord"];
        $checkPassword = password_verify($password, $hashedPassword);


        if ($checkPassword === false) {
            header("location: login.php?error=wronglogin");
            exit();
        } elseif ($checkPassword === true) {
            if ($mailTaken["Brukerstatus"] == 0) {
                header("location: login.php?error=notapprovedaccount");
                exit();
            } else {
                session_start();

                $_SESSION["user_email"] = $mailTaken["Epost"];
                $_SESSION["username"] = $mailTaken["Navn"];
                $_SESSION["subject_id"] = $mailTaken["EmneID"];
                $_SESSION["user_type"] = $mailTaken["Brukertype"];
                $_SESSION["study_path"] = $mailTaken["Studieretning"];

                header("location: login.php?error=none");
                exit();
            }
        }
    }
    ?>
<form method="post" action="">
    <label for="email">Email:</label><br>
    <input type="email" name="email"><br><br>

    <label for="password">Password:</label><br>
    <input type="password" name="password"><br><br>

    <input type="submit" value="Submit">
</form><br>
<a href="guestlogin.php">Logg inn som gjest</a>
<?php
    if(isset($_GET["error"])) {
        if($_GET["error"] == "emptyinput") {
            echo "<p>Alle felter må fylles</p>";
        }
        elseif ($_GET["error"] == "wronglogin") {
            echo "<p>Velg et passende email</p>";
        }
        elseif ($_GET["error"] == "notapprovedaccount") {
            echo "<p>Kontoen din er under behandling. Vennligst prøv igjen senere eller logg inn som gjest.</p>";
        }
        elseif ($_GET["error"] == "stmtfailed") {
            echo "<p>Noe gikk galt, prøv igjen senere</p>";
        }
        elseif ($_GET["error"] == "none") {
            echo "<p>Du er nå logget inn</p>";
            echo "<p>Velkommen " . $_SESSION["username"] . "</p>";
        }
    }
?>
</body>
</html>
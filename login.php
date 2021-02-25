<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php

    

    session_start();
    include "database.php";
    $db = new Database();
    $conn = $db->get_Connection();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $db = new Database();
        $conn = $db->get_Connection();
        $email = $conn -> real_escape_string(trim(htmlspecialchars($_POST["email"])));
        $password = $conn -> real_escape_string(trim(htmlspecialchars($_POST["password"])));

        $sql_register = "SELECT `Navn`, `Brukertype`, `EmneID`, `Studieretning`, `Brukerstatus` FROM `brukere` WHERE `Epost`= '" . $email . "' AND `Passord` = '" . $password . "'";
        $register_user = mysqli_query($conn, $sql_register);

        if (emptyInputLogin($email, $password) !== false) {
            header("location: ../login.php?error=emptyinput");
        }
        loginUser($email, $password);
    }

    function emptyInputLogin ($email, $password) {
        
        $db = new Database();
        $conn = $db->get_Connection();
        if (empty($email) || empty($password)) {
            $res = true;
        } else {
            $res = false;
        }
        return $res;
    }

    function mailTaken($email) {
        $db = new Database();
        $conn = $db->get_Connection();

        $sql_user_exists = "SELECT * FROM `brukere` WHERE `Epost`= '" . $email . "'";

        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql_user_exists)) {
            header("location: register.php?error=stmtfailed");
            exit();
        }

        $user_exists = mysqli_query($conn, $sql_user_exists);

        if ($row = mysqli_fetch_assoc($user_exists)) {
            return $row;
        } else {
            $res = false;
            return $res;
        }
    }

    function loginUser($email, $password) {
        
        $db = new Database();
        $conn = $db->get_Connection();
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

                $_SESSION["brukerID"] = $mailTaken["BrukerID"];
                $_SESSION["user_email"] = $mailTaken["Epost"];
                $_SESSION["username"] = $mailTaken["Navn"];
                $_SESSION["subject_id"] = $mailTaken["EmneID"];
                $_SESSION["user_type"] = $mailTaken["Brukertype"];
                $_SESSION["study_path"] = $mailTaken["Studieretning"];

                if ($_SESSION['user_type'] == 3){
                    header("location: student/studentside.php");
                    exit();
                }

                else if ($_SESSION['user_type'] == 2){
                    header("location: foreleser/index.php");
                    exit();
                }

                else if ($_SESSION['user_type'] == 1){
                    header("location: admin/updateusers.php");
                    exit();
                }
            }
        }
    }
    ?>

    <div id="div-feed">
        <h1>Logg inn</h1>
        <form method="post" action="">
            <label for="email">E-mail:</label><br>
            <input type="email" name="email"><br><br>

            <label for="password">Passord:</label><br>
            <input type="password" name="password"><br><br>

            <input type="submit" value="Send inn" class="student-input">
        </form><br>
    </div>

<a href="gjest/gjestfeed.php" class="homescreen-choice">Logg inn som gjest</a>
<a href="forgot.php" class="homescreen-choice">Forgot password</a>
<?php
    include "logg/logger.php";
    if(isset($_GET["error"])) {
        if($_GET["error"] == "emptyinput") {
            echo "<p>Alle felter må fylles</p>";
        }
        elseif ($_GET["error"] == "wronglogin") {
            echo "<p>Feil logg inn</p>";
        }
        elseif ($_GET["error"] == "notapprovedaccount") {
            echo "<p>Kontoen din er under behandling. Vennligst prøv igjen senere eller logg inn som gjest.</p>";
        }
        elseif ($_GET["error"] == "stmtfailed") {
            echo "<p>Noe gikk galt, prøv igjen senere</p>";
        }
        elseif ($_GET["error"] == "none") {
                    
            $logger = getLogger();
            $logger->info("Test");
            
            echo "<p>Du er nå logget inn</p>";
            echo "<p>Velkommen " . $_SESSION["username"] . "</p>";
        }
    }
?>
</body>
</html>
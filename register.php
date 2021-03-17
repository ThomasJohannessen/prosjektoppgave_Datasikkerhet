<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Start</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php
    include "database.php";
    include "AppLogger.php";
    $db = new Database();
    $conn = $db->get_Connection();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $status = "";
        $hashed_password = "";
        $rand_filename = rand(100000,1000000);

        $name = $conn -> real_escape_string(trim(htmlspecialchars($_POST["name"])));
        $email = $conn -> real_escape_string(trim(htmlspecialchars($_POST["email"])));
        $password = $conn -> real_escape_string(trim(htmlspecialchars($_POST["password"])));
        $password_confirmed = $conn -> real_escape_string(trim(htmlspecialchars($_POST["password-confirmed"])));
        $user_type = $conn -> real_escape_string(trim(htmlspecialchars($_POST["user_type"])));
        $study_path = $conn -> real_escape_string(trim(htmlspecialchars($_POST["study_path"])));
        $year = $conn -> real_escape_string(trim(htmlspecialchars($_POST["year"])));
        $subject_id = $conn -> real_escape_string(trim(htmlspecialchars($_POST["subject"])));
        $image = $conn -> real_escape_string(trim(htmlspecialchars($_FILES["photo"]["name"])));
        $ext = pathinfo($image, PATHINFO_EXTENSION);

        if (emptyFields($name, $email, $password, $password_confirmed, $user_type, $study_path, $year, $subject_id, $image, $rand_filename) !== false) {
            header("location: register.php?error=missingfields");
            exit();
        }
        if (invalidEmail($email) !== false) {
            header("location: register.php?error=invalidemail");
            exit();
        }
        if (passwordsDontMatch($password, $password_confirmed) !== false) {
            header("location: register.php?error=passwordsdontmatch");
            exit();
        }
        if (mailTaken($email) !== false) {
            header("location: register.php?error=usernametaken");
            exit();
        }
        if (notSupportedUsertype($user_type) !== false) {
            header("location: register.php?error=usertypenotsupported");
            exit();
        }

        createUser($name, $email, $password, $user_type, $study_path, $year, $subject_id, $rand_filename . "." . $ext);
    }

    function emptyFields($name, $email, $password, $password_confirmed, $user_type, $study_path, $year, $subject_id, $image, $rand_filename) {
        if ($user_type === "foreleser") {
            if (empty($name) || empty($email) || empty($password) || empty($password_confirmed) || empty($user_type) || empty($user_type) || empty($subject_id) || empty($image)) {
                $res = true;
            } else {
                if (fileVerification($rand_filename) !== false) {
                    header("location: register.php?error=imageerror");
                    exit();
                }
                if (subjectTaken($subject_id) !== false) {
                    header("location: register.php?error=subjecttaken");
                    exit();
                }
                $res = false;
            }
        } elseif ($user_type === "student") {
            if (empty($name) || empty($email) || empty($password) || empty($password_confirmed) || empty($user_type) || empty($study_path) || empty($year)) {
                $res = true;
            } else {
                $res = false;
            }
        } else {
            $res = true;
        }
        return $res;
    }

    function invalidEmail ($email) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $res = true;
        } else {
            $res = false;
        }
        return $res;
    }

    function passwordsDontMatch($password, $password_confirmed) {
        if ($password !== $password_confirmed) {
            $res = true;
        } else {
            $res = false;
        }
        return $res;
    }

    function mailTaken($email) {
        $db = new Database();
        $conn = $db->get_Connection();

        $sql_user_exists = "CALL DoesEmailExistInDb('$email')";

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

    function subjectTaken($subject_id) {
        $db = new Database();
        $conn = $db->get_Connection();

        $sql_subject_exists = "CALL IsSubjectTaken('$subject_id')";

        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql_subject_exists)) {
            header("location: register.php?error=stmtfailed");
            exit();
        }

        $subject_exists = mysqli_query($conn, $sql_subject_exists);

        if ($row = mysqli_fetch_assoc($subject_exists)) {
            return $row;
        } else {
            $res = false;
            return $res;
        }
    }

    function notSupportedUsertype($user_type) {
        if (!(($user_type === "student") || ($user_type === "foreleser"))) {
            $res = true;
        } else {
            $res = false;
        }
        return $res;
    }

    function fileVerification ($rand_filename) {
        //$filenameAsEmail
        // Check if file was uploaded without errors
        if(isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0){
            $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
            $filename = $_FILES["photo"]["name"];
            $filetype = $_FILES["photo"]["type"];
            $filesize = $_FILES["photo"]["size"];

            // Verify file extension
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            if(!array_key_exists($ext, $allowed)) die("Error: Please select a valid file format.");

            // Verify file size - 5MB maximum
            $maxsize = 5 * 1024 * 1024;
            if($filesize > $maxsize) die("Error: File size is larger than the allowed limit.");

            // Verify MYME type of the file
            if(in_array($filetype, $allowed)){
                // Check whether file exists before uploading it
                if(file_exists("uploads/" . $filename)){
                    echo $filename . " already exists.";
                } else {
                    move_uploaded_file($_FILES["photo"]["tmp_name"], "uploads/" . $rand_filename . "." . $ext);
                    return false;
                }
            } else {
                return true;
            }
        } else {
            return true;
        }
    }

    function createUser($name, $email, $password, &$user_type, $study_path, $year, $subject_id, $image) {
        $db = new Database();
        $conn = $db->get_Connection();

        if ($user_type === "foreleser") {
            $user_type = 2;
            $status = 0;
            $study_path = "";
            $year = 0;
        } elseif ($user_type === "student") {
            $user_type = 3;
            $status = 1;
            $subject_id = 0;
            $image = "";
        }
        $logg = new AppLogger("brukertilgang");
        $logger = $logg->getLogger();
        
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        
        $sql_register = "CALL RegisterNewUser('$name', '$email', '$image', '$year', '$user_type', '$hashed', '$subject_id', '$study_path', '$status')";
        $register_user = mysqli_query($conn, $sql_register);
        if ($register_user) {
            header("location: register.php?error=none");

            $logger->notice("Registrering av bruker vellykket", ["user" => $name, "username" => $email, "password" => password_hash($password, PASSWORD_DEFAULT), "usertype" => $user_type, 
            "study path" => $study_path, "year" => $year, "subject_id" => $subject_id, "imagePath" => $image]);

            exit();
        } else {
            header("location: register.php?error=stmtfailed");

            $logger->notice("Registrering av bruker feilet", ["user" => $name, "username" => $email, "password" => password_hash($password, PASSWORD_DEFAULT), "usertype" => $user_type, 
            "study path" => $study_path, "year" => $year, "subject_id" => $subject_id, "imagePath" => $image]);
            
            exit();
        }
    }
?>

<div id="div-feed">
    <h1>Register</h1>
    <form method="post" action="" enctype="multipart/form-data">
        <label for="name">Username:</label><br>
        <input type="test" name="name"><br><br>

        <label for="email">Email:</label><br>
        <input type="email" name="email"><br><br>

        <label for="password">Password:</label><br>
        <input type="password" name="password"><br><br>

        <label for="password-confirmed">Repeat password:</label><br>
        <input type="password" name="password-confirmed"><br><br>

        <label for="user_type">Type bruker:</label><br>
        <input type="radio" id="student" name="user_type" value="student">
        <label for="student" id="label-student">Student</label>
        <br>
        <input type="radio" id="foreleser" name="user_type" value="foreleser">
        <label for="foreleser">Foreleser</label><br><br>

        <section id="foreleser_cont">
            <h3>Foreleser</h3>
            <label for="photo">Select image:</label><br>
            <input type="file" id="photo" name="photo" accept="image/*"><br><br>

            <label for="subject">Hvilket fag foreleser du i?</label>
            <select id="subject" name="subject">
                <?php
                    $sql = 'CALL GetAllSubjectCodesAndPins()';

                    $results = mysqli_query($conn, $sql);

                    while($row = mysqli_fetch_array($results)) {
                        echo "<option value='" . $row['emnePIN'] . "'>" . $row['emnekode'] . " " . $row['emnenavn'] . "</option>";
                    }
                ?>

            </select>
        </section>

        <section id="student_cont">
            <h3>Student</h3>
                <label for="study_path">Studieretning: </label><br>
                <input type="text" name="study_path"><br><br>

                <label for="year">Kull: </label><br>
                <input type="text" name="year"><br><br>
        </section>

        <input type="submit" value="Submit">
        <br>

    </form>
</div>

<?php
    if(isset($_GET["error"])) {
        if($_GET["error"] == "missingfields") {
            echo "<p>Alle felter må fylles</p>";
        }
        elseif ($_GET["error"] == "invalidemail") {
            echo "<p>Velg et passende email</p>";
        }
        elseif ($_GET["error"] == "passwordsdontmatch") {
            echo "<p>Passord samsvarer ikke med hverandre</p>";
        }
        elseif ($_GET["error"] == "stmtfailed") {
            echo "<p>Noe gikk galt, prøv igjen senere</p>";
        }
        elseif ($_GET["error"] == "usernametaken") {
            echo "<p>Epost er tatt, vennligst fyll inn feltene på nytt</p>";
        }
        elseif ($_GET["error"] == "subjecttaken") {
            echo "<p>Emnet er tatt, vennligst velg et annet emne</p>";
        }
        elseif ($_GET["error"] == "usertypenotsupported") {
            echo "<p>Brukertype finnes ikke. Vennligst prøv igjen</p>";
        }
        elseif ($_GET["error"] == "imageerror") {
            echo "<p>Feil ved bilde opplastning</p>";
        }
        elseif ($_GET["error"] == "filesaved") {
            echo "<p>Fil lagret</p>";
        }
        elseif ($_GET["error"] == "none") {
            echo "<p>Du er nå registrert</p>";
            echo "<a href=\"login.php\">Logg inn</a>";
        }
    }
?>
<style>
    #foreleser_cont {
        display:none;
    }

    #student_cont {
        display:none;
    }

    #foreleser:checked ~ #foreleser_cont {
        display: block;
    }

    #student:checked ~ #student_cont {
        display: block;
    }
</style>
</body>
</html>

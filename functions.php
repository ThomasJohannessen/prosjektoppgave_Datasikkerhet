<?php
//include "AppLogger.php";

function logout () {
    //$logg = new AppLogger("brukertilgang");
    //$logger = $logg->getLogger();
    //$logger->info("Utlogging av bruker", ["username" => $_SESSION["username"]]);

    session_destroy();
    header("location: ../index.php");
    exit();
}

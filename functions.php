<?php


function logout () {
    $_POST = array();
    header("location: register.php");
    exit();
}
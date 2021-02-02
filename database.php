<?php

$conn = new mysqli("localhost", "softsec", "password", "datasikkerhet_prosjekt");

if($conn->connect_error) {
    die($conn->connect_errno. ": ".$conn->connect_error);
}



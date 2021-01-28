<?php 

$json_file = file_get_contents("http://localhost/nettsider/api/query.php");
$json_decoded = json_decode($json_file);
$obj = $json_decoded[0];
echo "
BrukerID = ", $obj->BrukerID, "<br>
Navn = ", $obj->Navn, "<br>
Epost = ", $obj->Epost, "<br>
Brukertype = ", $obj->Brukertype, "<br>
Passord = ", $obj->Passord, "<br>
Brukerstatus = ", $obj->Brukerstatus;
?>

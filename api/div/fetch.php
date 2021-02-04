<?php 

$json_file = file_get_contents("http://localhost/nett/api-final/api_hentSvar.php");

echo $json_file;
$json_decoded = json_decode($json_file, true);
echo "<br>";
echo print_r($json_decoded);
echo "<br>";
echo "<br>";
foreach (array_values($json_decoded) as $array) {
    foreach($array as $key=>$value) {
        echo "<br>";
        echo "$key : $value";
    }
    
 }
?>

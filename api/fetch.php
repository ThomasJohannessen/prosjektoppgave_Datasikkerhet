<?php 

$json_file = file_get_contents("http://localhost/nett/query.php");

echo $json_file;
$json_decoded = json_decode($json_file, true);
echo "<br>";
echo print_r($json_decoded);
echo "<br>";
echo "decoded ";
echo $json_decoded;
echo "<br>";
/*foreach ($json_decoded as $k => $v) {
    echo $k, ' : ', $v;
 }*/
?>

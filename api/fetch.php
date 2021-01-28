<?php 

$json_file = file_get_contents("http://localhost/nett/query.php");

echo $json_file;
$json_decoded = json_decode($json_file);
echo "<br>";
echo print_r($json_decoded);
echo "<br>";
echo "<br>";
echo $json_decoded->medlemmer[0]->born;
echo "<br>";
echo "Name = ", $json_decoded->medlemmer[0]->name, "<br>Age = ", $json_decoded->medlemmer[0]->age, "<br>Born = ", $json_decoded->medlemmer[0]->born, "<br>Died = ", $json_decoded->medlemmer[0]->died;
$obj = $json_decoded->medlemmer[0];
echo "<br>";
echo "Name = ", $obj->name, "<br>Age = ", $obj->age, "<br>Born = ", $obj->born, "<br>Died = ", $obj->died;
?>

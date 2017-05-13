<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

$query = $_GET['query'];


$xml =  simplexml_load_file("File.xml");
$consulta = $xml->xpath($query);

print_r($consulta);

/*
foreach($consulta as $i)
{
   echo $i->asXML();
}
*/

echo "<br>";
echo "<br>";
print_r("Fin del archivo");
?>
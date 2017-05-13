<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);


$xml =  simplexml_load_file("File.xml");
$consulta = $xml->xpath('//Alumnos[count(Alumno)>3]/parent::Tutor');

$i = 0;

while($i < count($consulta)){
   echo ($consulta[$i]->Nombre_Tutor );
   echo "<br>";
   echo ($consulta[$i]->Apellido_Tutor );
   echo "<br>";
   echo "<p>";
   $i = $i + 1;
}

echo "<br>";
echo "<br>";
print_r("Fin del archivo");
?>


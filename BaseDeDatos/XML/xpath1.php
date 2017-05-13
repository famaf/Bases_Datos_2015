<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);


$xml =  simplexml_load_file("File.xml");
$consulta = $xml->xpath('//Escuela/Tutores/Tutor/Alumnos/Alumno[Apellido_Alumno="Perez"]');

$i = 0;

while($i < count($consulta)){
   echo ($consulta[$i]->Nombre_Alumno);
   echo ($consulta[$i]->Apellido_Alumno);
   echo "<br>";
   $i = $i + 1;
}

print_r("Fin del archivo");
?>
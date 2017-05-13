<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

$cant = $_GET['cantidad'];


$xml =  simplexml_load_file("File.xml");
$consulta = $xml->xpath("//Escuela/Cursos/Curso[Cantidad_de_Alumnos>$cant]");

$i = 0;

while($i < count($consulta)){
   echo ($consulta[$i]->Anio );
   echo "<br>";
   echo ($consulta[$i]->Grado );
   echo "<br>";
   echo ($consulta[$i]->Seccion );
   echo "<br>";
   echo ($consulta[$i]->Turno );
   echo "<br>";
   echo "<p>";
   echo "--------";
   echo "<p>";
   $i = $i + 1;
}

echo "<br>";
echo "<br>";
print_r("Fin del archivo");
?>
<?php

$db = new mysqli('localhost', 'ddubois_grupo10', 'lahermanademario', 'ddubois_grupo10');

if($db->connect_errno > 0)
{
    die('Unable to connect to database [' . $db->connect_error . ']');
}

$sql = "SELECT Grado, Seccion, Turno, Cantidad
        FROM Curso";

if(!$result = $db->query($sql))
{
    die('There was an error running the query [' . $db->error . ']');
}

$dtd = "<!DOCTYPE note
[
<!ELEMENT note (to,from,heading,body)>
<!ELEMENT to (#PCDATA)>
<!ELEMENT from (#PCDATA)>
<!ELEMENT heading (#PCDATA)>
<!ELEMENT body (#PCDATA)>
]>";

$cursos = new SimpleXMLElement($dtd . '<Cursos></Cursos>');

error_reporting(E_ALL);
ini_set('display_errors', 1);


while($row = $result->fetch_assoc())
{
    $curso =  $cursos->addChild('Curso');
    $grado = $curso->addChild('Grado', $row['Grado']);
    $seccion = $curso->addChild('Seccion', $row['Seccion']);
    $turno = $curso->addChild('Turno', $row['Turno']);
    $cantidad = $curso->addChild('Cantidad_de_Alumnos', $row['Cantidad']);
}

header("Content-type: text/xml");
echo $cursos->asXML();

?>
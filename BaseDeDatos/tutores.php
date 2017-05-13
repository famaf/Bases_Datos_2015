<?php

$db = new mysqli('localhost', 'ddubois_grupo10', 'lahermanademario', 'ddubois_grupo10');

if($db->connect_errno > 0)
{
    die('Unable to connect to database [' . $db->connect_error . ']');
}

$sql = "SELECT tab1.Nombre as Nombre, tab1.Apellido as Apellido, alu.Apellido as Apellido_Alumno, alu.Nombre as Nombre_Alumno 
	From Alumnos as alu inner join 
	(SELECT gf.ID_Alumno, gf.ID_Tutor, tut.Nombre, tut.Apellido From Grupo_Familiar as gf 
	inner join Tutores as tut on gf.ID_Tutor Where gf.ID_Tutor = tut.ID_Tutor) as tab1 
	on alu.ID_Alumno WHERE alu.ID_Alumno = tab1.ID_Alumno and tab1.ID_Tutor";

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

$tutores = new SimpleXMLElement($dtd . '<Tutores></Tutores>');

error_reporting(E_ALL);
ini_set('display_errors', 1);


while($row = $result->fetch_assoc())
{
    $tutor =  $tutores->addChild('Tutor');
    $nombre = $tutor->addChild('Nombre', $row['Nombre']);
    $apellido = $tutor->addChild('Apellido', $row['Apellido']);
    $apellido_alumno = $tutor->addChild('Apellido_Alumno', $row['Apellido_Alumno']);
    $nombre_alumno = $tutor->addChild('Nombre_Alumno', $row['Nombre_Alumno']);
    
}

header("Content-type: text/xml");
echo $tutores->asXML();

?>
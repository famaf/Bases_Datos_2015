<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

$db = new mysqli('localhost', 'ddubois_grupo10', 'lahermanademario', 'ddubois_grupo10');

if($db->connect_errno > 0)
{
    die('Unable to connect to database [' . $db->connect_error . ']');
}

$sql = "SELECT gf.ID_Tutor, tuto.Nombre as Nombre_Tutor, tuto.Apellido as Apellido_Tutor,
               gf.ID_Alumno, alu.Nombre as Nombre_Alumno, alu.Apellido as Apellido_Alumno
        from Grupo_Familiar gf inner join Alumnos alu on gf.ID_Alumno = alu.ID_Alumno
                               inner join Tutores tuto on gf.ID_Tutor = tuto.ID_Tutor";

$sql_curso = "SELECT Año, curso.Grado, curso.Seccion, curso.Turno, Cantidad
              from Cursando cursa inner join Curso curso on cursa.Grado = curso.Grado
                                                         and cursa.Seccion = curso.Seccion
                                                         and cursa.Turno = curso.Turno";

if(!$result = $db->query($sql))
{
    die('There was an error running the query_1 [' . $db->error . ']');
}

if(!$result1 = $db->query($sql_curso)){
    die('There was an error running the query_2 [' . $db->error . ']');  
}


$dtd = 
"
<!DOCTYPE Escuela [
    <!ELEMENT Escuela (Tutores, Cursos)>
    <!ELEMENT Tutores (Tutor+)>
    <!ELEMENT Tutor (ID_Tutor, Nombre_Tutor, Apellido_Tutor, Alumnos)>
    <!ELEMENT ID_Tutor (#PCDATA)>
    <!ELEMENT Nombre_Tutor (#PCDATA)>
    <!ELEMENT Apellido_Tutor (#PCDATA)>
    <!ELEMENT Alumnos (Alumno+)>
    <!ELEMENT Alumno (ID_Alumno, Nombre_Alumno, Apellido_Alumno)>
    <!ELEMENT ID_Alumno (#PCDATA)>
    <!ELEMENT Nombre_Alumno (#PCDATA)>
    <!ELEMENT Apellido_Alumno (#PCDATA)>
    <!ELEMENT Cursos (Curso+)>
    <!ELEMENT Curso (Anio, Grado, Seccion, Turno, Cantidad_de_Alumnos)>
    <!ELEMENT Anio (#PCDATA)>
    <!ELEMENT Grado (#PCDATA)>
    <!ELEMENT Seccion (#PCDATA)>
    <!ELEMENT Turno (#PCDATA)>
    <!ELEMENT Cantidad_de_Alumnos (#PCDATA)>
]>";


$escuela = new SimpleXMLElement($dtd . '<Escuela></Escuela>');

$ultimotutor = 0;

$tutores = $escuela->addChild('Tutores'); 

while($row = $result->fetch_assoc())
{
    if($ultimotutor != $row['ID_Tutor'])
    {
        $tutor =  $tutores->addChild('Tutor');
        $id_tutor = $tutor->addChild('ID_Tutor', 'T_'.$row['ID_Tutor']);
        $nombre = $tutor->addChild('Nombre_Tutor', $row['Nombre_Tutor']);
        $apellido = $tutor->addChild('Apellido_Tutor', $row['Apellido_Tutor']);
        $alumnos = $tutor->addChild('Alumnos');
        $ultimotutor = $row['ID_Tutor'];
    }
    $alumno = $alumnos->addChild('Alumno');
    $id_alumno = $alumno->addChild('ID_Alumno', 'A_'.$row['ID_Alumno']);
    $nombre_alumno = $alumno->addChild('Nombre_Alumno', $row['Nombre_Alumno']);
    $apellido_alumno = $alumno->addChild('Apellido_Alumno', $row['Apellido_Alumno']);
}

$cursos = $escuela->addChild('Cursos'); 

while($row = $result1->fetch_assoc())
{
    $curso =  $cursos->addChild('Curso');
    $anio = $curso->addChild('Anio', $row['Año']);
    $grado = $curso->addChild('Grado', $row['Grado']);
    $seccion = $curso->addChild('Seccion', $row['Seccion']);
    $turno = $curso->addChild('Turno', $row['Turno']);
    $cantidad = $curso->addChild('Cantidad_de_Alumnos', $row['Cantidad']);
}

$result = $escuela->asXML();

$file = fopen("File_DTD.xml", "w+");
fwrite($file, $result);
fclose($file);

echo " *** Guardado en archivo: File_DTD.xml ***";

?>
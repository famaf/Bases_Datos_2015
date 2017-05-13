<?php

$db = new mysqli('localhost', 'ddubois_grupo10', 'lahermanademario', 'ddubois_grupo10');

if($db->connect_errno > 0){
    die('Unable to connect to database [' . $db->connect_error . ']');
}

$sql="SELECT ID_Alumno
				FROM (SELECT Grado, Seccion, Turno
				FROM (SELECT cur.Grado, cur.Seccion, cur.Turno
				FROM (SELECT ID_Tutor
				 	  FROM Oficios of INNER JOIN Oficios_Tutores oft ON of.ID_Oficio = oft.ID_Oficio
				 	  WHERE Nombre = 'Dentista') tuden
				 	  INNER JOIN Grupo_Familiar gf ON tuden.ID_Tutor = gf.ID_Tutor
				 	  INNER JOIN Cursando cur ON gf.ID_Alumno = cur.ID_Alumno
				GROUP BY Grado, Seccion, Turno) tut
				WHERE Grado = ".$_POST["Grado"]." AND Seccion = '".$_POST["Seccion"]."' AND Turno = '".$_POST["Turno"]."') grasectu
				NATURAL JOIN Cursando";


/*"SELECT c.ID_Alumno
		FROM (SELECT * FROM Cursando WHERE Grado = ".$_POST["Grado"]." AND Seccion = '".$_POST["Seccion"]."' AND Turno = '".$_POST["Turno"]."')  AS c 
			 INNER JOIN Grupo_Familiar gf ON c.ID_Alumno = gf.ID_Alumno
			 INNER JOIN Oficios_Tutores ot ON gf.ID_Tutor = ot.ID_Tutor
			 INNER JOIN (SELECT ID_Oficio FROM Oficios WHERE Nombre = 'Dentista') ofi ON ot.ID_Oficio = ofi.ID_Oficio";
*/
if(!$result = $db->query($sql)){
    die('There was an error running the query [' . $db->error . ']');
}?>

<h4> Alumnos de un curso especifico de los cuales algún tutor es dentista.</h4>

<table border=4>
<tr>
<td>ID-Alumno</td>
</tr>

<?php
while($row = $result->fetch_assoc()){
?> 
 <tr>
<td><?php echo $row['ID_Alumno']; ?></td>
</tr>

<?php
}
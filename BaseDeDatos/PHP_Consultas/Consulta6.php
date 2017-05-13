<?php

$db = new mysqli('localhost', 'ddubois_grupo10', 'lahermanademario', 'ddubois_grupo10');

if($db->connect_errno > 0){
    die('Unable to connect to database [' . $db->connect_error . ']');
}

$sql = "SELECT Grado, Seccion, Turno, (Cantidad*100/Cantidad2014)-100 AS Evolucion
		FROM (
		        SELECT *
		        FROM (
		                SELECT Grado, Seccion, Turno, count(ID_Alumno) AS Cantidad
		                FROM Cursando
		                WHERE Año = 2015
		                GROUP BY Grado, Seccion, Turno
		            ) AS T2015

		            INNER JOIN (
		                SELECT Grado AS Grado2014, Seccion AS Seccion2014, Turno AS Turno2014, count(ID_Alumno) AS Cantidad2014
		                FROM Cursando 
		                WHERE Año = 2014
		                GROUP BY Grado2014, Seccion2014, Turno2014
		            ) AS T2014 ON T2014.Grado2014=T2015.Grado AND T2014.Seccion2014=T2015.Seccion AND T2014.Turno2014=T2015.Turno
		    ) AS Tabl" ;

if(!$result = $db->query($sql)){
    die('There was an error running the query [' . $db->error . ']');
}?>

<h4> Comparación de cantidad de alumnos por curso/división del año 2014 al 2015 con porcentaje de crecimiento/decrecimiento </h4>

<table border=4>
<tr>
<td>Grado</td><td>Seccion</td><td>Turno</td><td>Evolucion</td>
</tr>

<?php
while($row = $result->fetch_assoc()){
?> 
 <tr>
<td><?php echo $row['Grado']; ?></td>
<td><?php echo $row['Seccion']; ?></td>
<td><?php echo $row['Turno']; ?></td>
<td><?php echo $row['Evolucion']; ?></td>
</tr>

<?php
}

?>

</table>
<?php

$db->close();


?>
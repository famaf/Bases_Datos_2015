<?php

$db = new mysqli('localhost', 'ddubois_grupo10', 'lahermanademario', 'ddubois_grupo10');

if($db->connect_errno > 0){
    die('Unable to connect to database [' . $db->connect_error . ']');
}

$sql =  "SELECT `Grado`, `Seccion`, `Turno`, COUNT(`ID_Alumno`) as Cantidad
            FROM `Cursando`
            WHERE `Año` = " .$_POST["year"].
            " GROUP BY `Grado`, `Seccion`, `Turno`"  ;

//echo "<br/>--".$sql."--<br/>";

if(!$result = $db->query($sql)){
    die('There was an error running the query [' . $db->error . ']');
}?>
<table border=4>
<tr>
<td>Grado</td><td>Seccion</td><td>Turno</td><td>Cantidad Alumnos</td>
</tr>
<?php
while($row = $result->fetch_assoc()){
?> 
 <tr>
<td><?php echo $row['Grado']; ?></td>
<td><?php echo $row['Seccion']; ?></td>
<td><?php echo $row['Turno']; ?></td>
<td><?php echo $row['Cantidad']; ?></td>
</tr>

<?php
}

?>

</table>
<?php

$db->close();


?>
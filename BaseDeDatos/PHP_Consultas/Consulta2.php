<?php

$db = new mysqli('localhost', 'ddubois_grupo10', 'lahermanademario', 'ddubois_grupo10');

if($db->connect_errno > 0){
    die('Unable to connect to database [' . $db->connect_error . ']');
}

$sql="SELECT DISTINCT gf2.ID_Alumno AS Alumno, Tabla1.Cantidad_de_Hermanos-1 AS Cant_Hermanos FROM 
		(SELECT Nro_GrupoFamiliar, COUNT(ID_Alumno) AS Cantidad_de_Hermanos FROM 
		(SELECT DISTINCT Cursando.ID_Alumno, grupo.Nro_GrupoFamiliar FROM Cursando 
		INNER JOIN Grupo_Familiar As grupo ON Cursando.ID_Alumno = grupo.ID_Alumno WHERE Estado='Cursando') As Tabla 
		GROUP BY Tabla.Nro_GrupoFamiliar) AS Tabla1 INNER JOIN 
		Grupo_Familiar AS gf2 ON Tabla1.Nro_GrupoFamiliar = gf2.Nro_GrupoFamiliar ";



if(!$result = $db->query($sql)){
    die('There was an error running the query [' . $db->error . ']');
}?>

<h4> Cuotas de determinado mes teniendo en cuenta los grupos familiares </h4>

<table border=4>
<tr>
<td>ID_Alumno</td><td>Cantidad de Hermanos</td><td>Valor de Cuota</td>
</tr>

<?php
while($row = $result->fetch_assoc()){
?> 
 <tr>
<td><?php echo $row['Alumno']; ?></td>
<td><?php echo $row['Cant_Hermanos']; ?></td>
<td><?php 
	$value = $row['Cant_Hermanos'];
	if($value == 0){
		echo '$100';
	}elseif($value == 1){
		echo '$80';
	}elseif($value >= 2){
		echo '$60';	
	}

	; ?></td>
</tr>

<?php
}
?>


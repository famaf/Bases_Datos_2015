<?php

$db = new mysqli('localhost', 'ddubois_grupo10', 'lahermanademario', 'ddubois_grupo10');

if($db->connect_errno > 0){
    die('Unable to connect to database [' . $db->connect_error . ']');
}

$sql2="INSERT INTO `Movimientos`(`ID_Empleado`, `ID_Movimiento`, `Monto`, `Fecha`, `Descripcion`) VALUES (".$_POST["ID_Empleado"].",(SELECT MAX(ID_Movimiento) +1 FROM Movimientos AS C),".$_POST["Monto"].",now(),'".$_POST["Descripcion"]."')";
$sql="SELECT * FROM Empleado WHERE 1";



if(!$result1 = $db->query($sql2)){
    die('There was an error running the query [' . $db->error . ']');
}


if(!$result = $db->query($sql)){
    die('There was an error running the query [' . $db->error . ']');
}

?>

</body>
<h2> Cargar Movimiento </h2>

<table border=4>
<tr>
<td>ID_Empleado</td><td>Nombre</td><td>Apellido</td><td>Saldo</td>
</tr>



<?php
while($row = $result->fetch_assoc()){
?> 
<tr> 
<td><?php echo $row['ID_Empleado']; ?></td>
<td><?php echo $row['Nombre']; ?></td>
<td><?php echo $row['Apellido']; ?></td>
<td><?php echo $row['Saldo']; ?></td>
</tr>

<?php
}
?>
</table><br>
<a href="ver_movimiento.php"> Agregar Otro Movimiento </a>
</body>
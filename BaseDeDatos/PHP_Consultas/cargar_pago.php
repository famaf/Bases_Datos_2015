<?php

$db = new mysqli('localhost', 'ddubois_grupo10', 'lahermanademario', 'ddubois_grupo10');

if($db->connect_errno > 0){
    die('Unable to connect to database [' . $db->connect_error . ']');
}

$sql2="INSERT INTO `Pagos`(`ID_Alumno`, `ID_Empleado`, `Mes`, `Año`, `Importe`, `Fecha_Pago`) VALUES (".$_POST["ID_Alumno"].",".$_POST["ID_Empleado"].",'".$_POST["Mes"]."',".$_POST["Año"].",".$_POST["Importe"].",now())";

$sql="SELECT * FROM Empleado WHERE 1";



if(!$result1 = $db->query($sql2)){
    die('There was an error running the query [' . $db->error . ']');
}


if(!$result = $db->query($sql)){
    die('There was an error running the query [' . $db->error . ']');
}

?>

</body>
<h2> Cargar pago de cuota </h2>

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
<a href="pagocuota.php"> Agregar otro pago </a>
</body>
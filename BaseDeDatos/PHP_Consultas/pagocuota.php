<?php

$db = new mysqli('localhost', 'ddubois_grupo10', 'lahermanademario', 'ddubois_grupo10');

if($db->connect_errno > 0){
    die('Unable to connect to database [' . $db->connect_error . ']');
}

$sql="SELECT * FROM Empleado WHERE 1";


if(!$result = $db->query($sql)){
    die('There was an error running the query [' . $db->error . ']');
}

?>

    <h1> Carga de un pago de cuota</h1>
    <h4> Por favor ingrese los siguientes datos </h4>
    
    <form name=form2 id=pagar_cuota action=cargar_pago.php method="post">
    <p> Ingrese el ID_Alumno: <input type="text" name="ID_Alumno"> </p>
    <p> Ingrese el ID_Empleado: <input type="text" name="ID_Empleado"> </p>
    <p> Ingrese el Mes: <input type="text" name="Mes"> </p>
    <p> Ingrese el Año: <input type="text" name="Año"> </p>
    <p> Ingrese el Importe: <input type="text", name="Importe"> </p>
    <input type="submit" value="Submit Query">
    </form>
</body> 

<h2> Listado de Saldos personales </h2>

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
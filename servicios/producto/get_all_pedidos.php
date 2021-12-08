<?php
include('../_conexion.php');
$response=new stdClass();

$datos=[];
$i=0;
$sql="select * from pedido inner join producto on pedido.cod=producto.cod ";
$result=mysqli_query($con,$sql);
while($row=mysqli_fetch_array($result)){
	$obj=new stdClass();
	$obj->cod=$row['cod'];
	$obj->codped=$row['codped'];
	$obj->nom=$row['nom'];
	$obj->rutima=$row['rutima'];
	$obj->fechaped=$row['fechaped'];
	$obj->pre=$row['pre'];
	$obj->direccionA=$row['direccionA'];
	$obj->telefono=$row['telefono'];
	$datos[$i]=$obj;
	$i++;
}
$response->datos=$datos;

mysqli_close($con);
header('Content-Type: application/json');
echo json_encode($response);
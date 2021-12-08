<?php
include('../_conexion.php');
$response=new stdClass();

$datos=[];
$i=0;
$text=$_POST['text'];
$sql="select * from producto where nom like '%$text%'";
$result=mysqli_query($con,$sql);
while($row=mysqli_fetch_array($result)){
	$obj=new stdClass();
	$obj->cod=$row['cod'];
	$obj->nom=$row['nom'];
	$obj->des=$row['des'];
	$obj->pre=$row['pre'];
	$obj->rutima=$row['rutima'];
	$datos[$i]=$obj;
	$i++;
}
$response->datos=$datos;

mysqli_close($con);
header('Content-Type: application/json');
echo json_encode($response);
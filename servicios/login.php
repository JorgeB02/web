<?php
include('_conexion.php');
$email=$_POST['email'];
$sql="SELECT * FROM USUARIO WHERE email='$email'";
$result=mysqli_query($con,$sql);
if ($result) {
	$row=mysqli_fetch_array($result);
	$count=mysqli_num_rows($result);
	if ($count!=0) {
		$pass=$_POST['pass'];
		if ($row['pass']!=$pass) {
            //1: conexion err
            //2:email err
            //3: contra err
			header('Location: ../login.php?e=3');
		}else{
			session_start();
			
			$_SESSION['codUser']=$row['codUser'];
			$_SESSION['email']=$row['email'];
			$_SESSION['nomUser']=$row['nomUser'];
			header('Location: ../');
		}
	}else{
		header('Location: ../login.php?e=2');
	}
}else{
	header('Location: ../login.php?e=1');
}
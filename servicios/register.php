<?php
include('_conexion.php');


$name=$_POST['name'];
$apell=$_POST['apell'];
$email=$_POST['email'];
$pass=$_POST['pass'];
$conpass=$_POST['conpass'];


$sql="SELECT * FROM USUARIO WHERE email='$email'";
$result=mysqli_query($con,$sql);


if($email != ""){
	if ($result) {
		$row=mysqli_fetch_array($result);
		$count=mysqli_num_rows($result);
		if ($count!=0) {
			header('Location: ../register.php?e=2');
		}else if(!($pass == $conpass)){
			header('Location: ../register.php?e=3');
		}else if ($pass == ""){
			header('Location: ../register.php?e=4');
		}else{

			$addUser = "INSERT INTO usuario (`nomUser`, `apeUser`, `email`, `pass`)
			 VALUES ('$name', '$apell', '$email', '$pass')";
			$result=mysqli_query($con,$addUser);


			$sql="SELECT * FROM USUARIO WHERE email='$email'";
			$result=mysqli_query($con,$sql);

			$row=mysqli_fetch_array($result);
			$count=mysqli_num_rows($result);
			
			session_start();
			
			$_SESSION['codUser']=$row['codUser'];
			$_SESSION['email']=$row['email'];
			$_SESSION['nomUser']=$row['nomUser'];
			header('Location: ../');
		}
	}else{
		header('Location: ../register.php?e=1');
	}
}else{
	header('Location: ../register.php?e=5');

}

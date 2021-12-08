<?php
    session_start();
    $response=new stdClass();
    if(!isset($_SESSION['codUser'])){
        $response->state=false;
        $response->detail="Cuenta no iniciada";
        $response->open_login=true;
        
    }else{

        include_once('../_conexion.php');

        $codUser = $_SESSION['codUser'];
        $cod = $_POST['cod'];

        $addSQL = "INSERT INTO pedido (`codUser`, `cod`, `fechaped`, `direccionA`, `telefono`) VALUES ($codUser, $cod, now(), '', '')";
        
        $add = mysqli_query($con, $addSQL);

        if($add){
            $response->state=true;
            $response->detail="El producto se añadio";
        }else{
            $response->state=false;
            $response->detail="Error al añadir producto";
        }
    
        mysqli_close($con);  
    }

header('Content-Type: application/json');
echo json_encode($response);


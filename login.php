<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"> </script> 
    <script src="https://kit.fontawesome.com/7978518248.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="css/estilo.css">
    <link rel="stylesheet" type="text/css" href="css/productos.css">
    <link rel="stylesheet" type="text/css" href="css/inicio.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda Jorge</title>
</head>
<body>

    <header>
  	<!--Iria el logo pero no hay-->
      <div class="logo-place"><a href="index.php">Logo</a></div>
      <div class="options-place">

        <div class="item-option" title="Ingresar"><a href="register.php"><i class="fa fa-sign-in"></i></a></div>

      </div>
    </header>
	<div class="main-content">
		<div class="content-page">
            <form action="servicios/login.php" method="POST">
			    <h3>Iniciar sesion</h3>
                <input type="text" name="email" placeholder="Correo">
                <input type="password" name="pass" placeholder="Contraseña">
                <?php
                    if(isset($_GET['e'])){
                        switch($_GET['e']){
                            case '1':
                                echo '<p>Error de conexion</p>';
                                break;
                            case '2':
                                echo '<p>Email invalido</p>';
                                break;
                            case '3':
                                echo '<p>Contraseña incorrecta</p>';
                                break;
                            default:
                                break;
                        }
                    }
                
                ?>
                <button type="submit">Ingresar</button>
              
            </form>
		</div>
	</div>
    
</body>
</html>
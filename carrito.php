<?php
	session_start();
    if (!isset($_SESSION['codUser'])){
        header('location: index.php');
    }
?>
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
    <link rel="stylesheet" type="text/css" href="css/pedido.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda Jorge</title>
</head>
<body>
    
    <header>
  	<!--Iria el logo pero no hay-->
	  	<div class="logo-place"><a href="index.php">Logo</a></div>
    <!--Busqueda-->
        <div class="search-place">
            <input type="text" id="busqueda" placeholder="¿Que objeto desea buscar?">
            <button class="btn-main btn-search"><i class="fas fa-search"></i></button>
        </div>

    <!--Opciones-->
    <div class="options-place">
		  <?php
		  if (isset($_SESSION['codUser'])){
			echo '<div class="item-option" title="Registrar"><i class="far fa-user"></i>';
			echo '<p>';
			echo $_SESSION['nomUser'].'</p></div>'; 

            echo '<a href="cerrar_sesion.php"><button>Cerrar Sesion</button></a>';

		  }else{
		 ?>


        <div class="item-option" title="Registrar"><a href="login.php"><i class="far fa-user"></i></a></div>
        <div class="item-option" title="Ingresar"><a href="register.php"><i class="fa fa-sign-in"></i></a></div>


		<?php
		  }
		?>




      </div>
    </header>
	<div class="main-content">
		<div class="content-page">
          <h3>Mis pedidos</h3>
          <div class="body-pedidos" id="rellenar">
          
          </div>

          <input type="text" name="direccion" placeholder="Direccion a la que enviar">
          <input type="text" name="telefono" placeholder="Telefono para contactar">

          <button onclick="comprar()">Procesar compra</button>
		</div>
	</div>

    <script type="text/javascript">
        	$(document).ready(function(){
			$.ajax({
				url:'servicios/producto/get_all_pedidos.php',
				type:'POST',
				data:{},
				success:function(data){
					console.log(data);
					let html='';
					for (var i = 0; i < data.datos.length; i++) {
						html+=
                        '    <div class="item-pedido">'+
                    '<div class="pedido-img">'+
                    '<img src="assets/products/'+data.datos[i].rutima+'">'+
                  '</div>'+
                 '<div class="pedido-detalle">'+
                      '<h3>'+data.datos[i].nom+'</h3>'+
                      '<p><b>Precio:</b> '+data.datos[i].pre+'</p>'+
                      '<p><b>Fecha:</b> '+data.datos[i].fechaped+'</p>'+
                      '<p><b>Direccion:</b> '+data.datos[i].direccionA+'</p>'+
                      '<p><b>Telefono:</b> '+data.datos[i].telefono+'</p>'+
                  '</div>'+
              '</div>';


					}
					document.getElementById("rellenar").innerHTML=html;
				},
				error:function(err){
					console.error(err);
				}
			});
		});

        function comprar(){
            var direccion = document.getElementById("direccion").value;
            var telefono = document.getElementById("telefono").value;
            if(direccion == "" || telefono == ""){
                alert("Los campos direccion y telefono son obligatorios")
            }else{
                $.ajax({
                    url:'servicios/compra/actu.php',
                    type:'POST',
                    data:{
                        direccion:direccion,
                        telefono:telefono
                    },
                    success:function(data){
                        console.log(data);
                    },
                    error:function(err){
                        console.error(err);
                    }
		    	});
		    }
        }
        function cerrar_sesion(){
			session_destroy();
		}
    </script>
</body>
</html>
<?php
	session_start();
	
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
            <button class="btn-main btn-search" onclick="busqueda()"><i class="fas fa-search"></i></button>
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


        <div class="item-option" title="Compras">
			<a href="carrito.php"><i class="fa fa-shopping-cart"></i></a></div>


      </div>
    </header>
	<div class="main-content">
		<div class="content-page">
			<div class="title-section">Resultado de Busqueda</div>
			<div class="products-list" id="rellenar">
			</div>
		</div>
	</div>
		
	<script type="text/javascript" src="js/busqueda.js"></script>
    <script type="text/javascript">
        var text = "<?php echo $_GET['text'];?>";
		$(document).ready(function(){
			$.ajax({
				url:'servicios/producto/get_products.php',
				type:'POST',
				data:{
                    text:text
                },
				success:function(data){
					console.log(data);
					let html='';
					for (var i = 0; i < data.datos.length; i++) {
						html+=
						'<div class="product-box">'+
							'<a href="producto.php?p='+data.datos[i].cod+'">'+
								'<div class="producto">'+
									'<img src="assets/products/'+data.datos[i].rutima+'">'+
									'<div class="detail-title">'+data.datos[i].nom+'</div>'+
									'<div class="detail-description">'+data.datos[i].des+'</div>'+
									'<div class="detail-price">'+(data.datos[i].pre)+"€"+'</div>'+
								'</div>'+
							'</a>'+
							'<button onclick="iniciar_compra('+data.datos[i].cod+')">Comprar</button>'+
						'</div>';
					}
                    if (html == ''){
                        document.getElementById("rellenar").innerHTML="Este producto no existe";

                    }else{
                        document.getElementById("rellenar").innerHTML=html;

                    }
					
				},
				error:function(err){
					console.error(err);
				}
			});
		});
		function iniciar_compra(num){
			$.ajax({
				url:'servicios/compra/validar_inicio_compra.php',
				type:'POST',
				data:{
					cod:num
				},
				success:function(data){
					console.log(data);
					if (data.state) {
						alert(data.detail)
					}else{
						alert(data.detail);
						if (data.open_login) {
							open_login();
						}
					}
				},
				error:function(err){
					console.error(err);
				}
			});
		}
		function open_login(){
			window.location.href="login.php";
		}

		function cerrar_sesion(){
			session_destroy();
		}
	</script>
</body>
</html>
<?php
session_start();
include('conexion.php');

$idUnidad = $_POST["idUnidad"];

$consultaPreguntas = "SELECT * FROM preguntas WHERE id_unidades = '".$idUnidad."' ORDER BY RAND() LIMIT 20";
$resultado = mysql_query($consultaPreguntas);

$max = mysql_num_rows($resultado);


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Examenes_Test</title>
    <script src="js/bootstrap.js"></script>
    
    <link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
    <link rel="stylesheet" href="css/estilo.css" type="text/css" />
    
</head>
<body>
	<main>
            <header>
                <?php echo $_SESSION["usuarioNombre"];?>
                <a href="index.php">Cerrar sesión</a>
            </header>
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">

                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                  <div class="item active">
                    <div class="carousel-caption">
                      Probando
                    </div>
                  </div>
                  <div class="item">
                    <div class="carousel-caption">
                      Prueba
                    </div>
                  </div>
                  ...
                </div>
            </div>
            <?php
            while ($preguntas = mysql_fetch_array($resultado)){
                echo $preguntas["pregunta"]."<br>";
            }

            
            ?>
	</main>
<script src="js/jquery-1.11.0.min.js" ></script>
</body>
</html>
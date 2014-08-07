<?php
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
    <link rel="stylesheet" href="css/estilo.css" type="text/css">
</head>
<body>
	<main>
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">

                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                  <div class="item active">
                    <img src="..." alt="...">
                    <div class="carousel-caption">
                      ...
                    </div>
                  </div>
                  <div class="item">
                    <img src="..." alt="...">
                    <div class="carousel-caption">
                      ...
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
</body>
</html>
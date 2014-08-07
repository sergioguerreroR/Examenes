<?php
include('conexion.php');

$idUnidad = $_POST["idUnidad"];

$consultaPreguntas = "SELECT * FROM preguntas WHERE id_unidades = '".$idUnidad."'";
$resultado = mysql_query($consultaPreguntas);

$max = mysql_num_rows($resultado);

$preguntas = mysql_fetch_row($resultado);

var_dump($preguntas);
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
            <?php
            echo $preguntas[0];
            ?>
	</main>
</body>
</html>
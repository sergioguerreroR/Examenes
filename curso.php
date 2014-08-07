<?php
include('conexion.php');

$idCurso = $_POST["id"];

$consultaUnidades = "SELECT * FROM unidades WHERE id_cursos = '".$idCurso."'";
$resultadoUnidades = mysql_query($consultaUnidades);

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
                while ($unidad = mysql_fetch_array($resultadoUnidades)){
                    echo '<form method="POST" action="unidad.php">';
                    echo '<input type="hidden" name="id" value="'.$unidad["id"].'" />';
                    echo '<input type="submit" value="'.$unidad["nombre"].'" />';
                    echo '</form>';
                }
                
                ?>
	</main>
</body>
</html>
<?php
include('conexion.php');
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
                $consulta = "SELECT * FROM cursos";
                $resultado = mysql_query($consulta);
                while ($fila = mysql_fetch_array($resultado)){
                    echo '<p>'.$fila["nombre"].'</p>';
                }
                
                ?>
	</main>
</body>
</html>
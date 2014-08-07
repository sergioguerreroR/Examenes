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
                    echo '<form method="POST" action="curso.php">';
                    echo '<input type="hidden" name="id" value="'.$fila["id"].'" />';
                    echo '<input type="submit" value="'.$fila["nombre"].'" />';
                    echo '</form>';
                }
                
                ?>
	</main>
</body>
</html>
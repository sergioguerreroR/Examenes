<?php
include('conexion.php');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Examenes_Test</title>
    <script src="js/bootstrap.js"></script>
    <link rel="stylesheet" href="css/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="css/estilo.css" type="text/css">
</head>
<body>
	<main>
            <header></header>
            <section>
                <article>
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
                </article>
                <section>
            <footer>
                <article id="articleboton">
                <a href="index.php"><button type="button" class="btn btn-success">Volver</button></a>
                </article>
                <article id="articleubicacion">
                    <span id="ubica">Panel de cursos</span>
                </article>
            </footer>
	</main>
</body>
</html>
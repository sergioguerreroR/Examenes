<?php
session_start();
include('conexion.php');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Examenes_Test</title>
    <script src="js/bootstrap.js"></script>
    <script src="js/funciones.js"></script>
    <link rel="stylesheet" href="css/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="css/estilo.css" type="text/css">
</head>
<body>
	<main>
            <header>
                <div id="caraDali">
                    <img id="caraImagen" src="imagenes/cabeceraCDP.png">
                </div>
                <div id="nombreUsuarioRegistrado">
                    <p><?php echo $_SESSION["usuarioNombre"];?></p>
                    <p><a href="index.php">Cerrar sesión</a></p>
                </div>
            </header>
            <section>
                <h1>Cursos Disponibles</h1>
		<?php
                $consulta = "SELECT * FROM cursos";
                $resultado = mysql_query($consulta);
                while ($fila = mysql_fetch_array($resultado)){
                    echo '<article id="articlepanel">';
                    echo '<form method="POST" action="unidad.php">';
                    echo '<input type="hidden" name="id" value="'.$fila["id"].'" />';
                    echo '<br>';
                    echo '<button id="botontitulotranspor" type="submit"><span id="nombretitu"> '.$fila["nombre"].'</span></button>';
                    echo '</form>';
                    echo '</article>';
                }
                ?>
                </section>
            <footer>
                <article id="articleboton">
                </article>
                <article id="articleubicacion">
                    <span id="ubica">Panel de cursos</span>
                </article>
            </footer>
	</main>
</body>
</html>

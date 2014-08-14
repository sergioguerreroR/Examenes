<?php
session_start();
include('conexion.php');

$idUnidad = $_POST["id"];

$consultaUnidades = "SELECT * FROM unidades WHERE id='" .$idUnidad. "'";
$resultadoUnidades = mysql_query($consultaUnidades);
$unidad = mysql_fetch_array($resultadoUnidades);

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
    <link rel="stylesheet" href="css/estilo.css" type="text/css">
</head>
<body>
	<main>
            <header></header>
            <section id="sectionunidad">
                <h1>Tipos de test</h1>
                <article class="articleunidad">
            <form method="POST" action="test.php">
                <input type="hidden" name="idUnidad" value="<?php echo $idUnidad; ?>" />
                <button id="botontestprogramados" type="submit" value="Test Programados" />                
            </form>
                </article>
                <article class="articleunidad">
            <form method="POST" action="examen.php">
                <input type="hidden" name="idUnidad" value="<?php echo $idUnidad; ?>" />
                <input type="submit" value="Test de Examen" />                
            </form>
                </article>
                <article class="articleunidad">
            <form method="POST" action="practicos.php">
                <input type="hidden" name="idUnidad" value="<?php echo $idUnidad; ?>" />
                <input type="submit" value="Casos practicos" />                
            </form>
                </article>
            </section>
            <footer>
                <article id="articleboton">
                <a href="curso.php?id=<?php echo $unidad["id_cursos"]; ?>"><img src="imagenes/anterior.png" /></a>
                </article>
                <article id="articleubicacion">
                    <?php
                    echo '<span id="ubica">'.$unidad['nombre'].'</span>';
                    ?>
                </article>
            </footer>
	</main>
</body>
</html>

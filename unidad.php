<?php
session_start();
include('conexion.php');

if(isset($_POST["id"])){
    $idUnidad = $_POST["id"];
}
else{
    $idUnidad = $_GET["id"];
}

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
            <header>
                <?php echo $_SESSION["usuarioNombre"];?>
                <a href="index.php">Cerrar sesión</a>
            </header>
            <section id="sectionunidad">
                <article id="botonprogramados" class="articleunidad">
            <form method="POST" action="test.php">
                <input type="hidden" name="idUnidad" value="<?php echo $idUnidad; ?>" />
                <button id="botontestprogramados" type="submit" value="Test Programados" />                
            </form>
                </article>
                <article id="botonexamenes" class="articleunidad">
            <form method="POST" action="examen.php">
                <input type="hidden" name="idUnidad" value="<?php echo $idUnidad; ?>" />
                <button id="botontestexamenes" type="submit" value="Test Programados" />                
            </form>
                </article>
                <article class="articleunidad">
            <form method="POST" action="practicos.php">
                <input type="hidden" name="idUnidad" value="<?php echo $idUnidad; ?>" />
                <button id="botoncasospracticos" type="submit" value="Test Programados" />                
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

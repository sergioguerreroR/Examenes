<?php
session_start();
include('conexion.php');

if(isset($_POST["id"])){
    $idCurso = $_POST["id"];
}
else{
    $idCurso = $_GET["id"];
}

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
                <div id="caraDali">
                    <img id="caraImagen" src="imagenes/cabeceraCDP.png">
                </div>
                <div id="nombreUsuarioRegistrado">
                   <?php echo $_SESSION["usuarioNombre"];?>
                   <a href="index.php">Cerrar sesión</a>
                </div>
            </header>
            <section id="sectionunidad">
                <article id="botonprogramados" class="articleunidad">
            <form method="POST" action="curso.php">
                <input type="hidden" name="id" value="<?php echo $idCurso; ?>" />
                <button id="botontestprogramados" type="submit" value="Test Programados" />                
            </form>
                </article>
                <article id="botonexamenes" class="articleunidad">
            <form method="POST" action="examen.php">
                <input type="hidden" name="id" value="<?php echo $idCurso; ?>" />
                <button id="botontestexamenes" type="submit" value="Test Programados" />                
            </form>
                </article>
                <article class="articleunidad">
            <form method="POST" action="cursoPracticos.php">
                <input type="hidden" name="id" value="<?php echo $idCurso; ?>" />
                <button id="botoncasospracticos" type="submit" value="Test Programados" />                
            </form>
                </article>
            </section>
            <footer>
                <article id="articleboton">
                <a href="panel.php"><img src="imagenes/anterior.png" /></a>
                </article>
            </footer>
	</main>
</body>
</html>

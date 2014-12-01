<?php
session_start();
include('conexion.php');

if(isset($_POST["id"])){
    $idCurso = $_POST["id"];
}
else{
    $idCurso = $_GET["id"];
}

$consultaUnidades = "SELECT * FROM unidades WHERE id_cursos = '".$idCurso."'";
$resultadoUnidades = mysql_query($consultaUnidades);

$consultacurso = "SELECT * FROM cursos WHERE id='" .$idCurso. "'";
$resultadocurso = mysql_query($consultacurso);
$curso = mysql_fetch_array($resultadocurso);
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
                <article id="articlecurso">
                    <table id="tablatemas" class="table table-condensed">
                        <thead>
                        <tr>
                        <th>Tema</th>
                        <th></th>
                        <th></th>
                        </tr>
                        </thead>
                        <tbody>
		<?php
                while ($unidad = mysql_fetch_array($resultadoUnidades)){
                    echo '<tr>';
                    echo '<td>'.$unidad["nombre"].'</td>';
                    echo '<td></td>';
                    echo '<td></td>';
                    echo '<td></td>';
                    echo '<form method="POST" action="test.php">';
                    echo '<input type="hidden" name="idUnidad" value="'.$unidad["id"].'" />';
                    echo '<td><input type="submit" value="Entrar"/ class="btn btn-success btn-xs"></td>';
                    echo '</form>';
                    echo'</tr>';
                }
                ?>
                            </tbody>
                </table>
                </article>
                </section>
            <footer>
                <article id="articleboton">
                <a href="unidad.php?id=<?php echo $curso["id"]; ?>"><img src="imagenes/anterior.png" /></a>
                </article>
                <article id="articleubicacion">
                    <?php
                    echo '<span id="ubica">'.$curso['nombre'].'</span>';
                    ?>
                </article>
            </footer>
	</main>
</body>
</html> 

<?php
include('conexion.php');

$idCurso = $_POST["id"];

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
            <header></header>
            
            <section>
                <h1>Temas</h1>
                <article id="articlecurso">
                    <table id="tablatemas" class="table table-condensed">
                        <tr>
                        <th>Tema</th>
                        <th>Evaluación</th>
                        <th>Aciertos</th>
                        <th>Errores</th>
                        <th></th>
                        </tr>
		<?php
                    
                while ($unidad = mysql_fetch_array($resultadoUnidades)){
                    echo'<tr>';
                    echo '<td>'.$unidad["nombre"].'</td>';
                    echo '<td></td>';
                    echo '<td></td>';
                    echo '<td></td>';
                    echo '<form method="POST" action="unidad.php">';
                    echo '<input type="hidden" name="id" value="'.$unidad["id"].'" />';
                    echo '<td><input type="submit" value="Realizar Test"/ class="btn btn-success btn-xs"></td>';
                    echo '</form>';
                    echo'</tr>';
                }
                ?>
                </table>
                </article>
                </section>
            <footer>
                <article id="articleboton">
                <a href="index.php"><button type="button" class="btn btn-danger">Volver</button></a>
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


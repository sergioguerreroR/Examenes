<?php
session_start();
include('conexion.php');
//Recogida de datos necearios para actualizar la pagina
if(isset($_POST["idUnidad"])){
    $idUnidad = $_POST["idUnidad"];
}
 else {
    $idUnidad = $_SESSION["idUnidad"];
}
$usuarioId = $_SESSION["usuarioId"];
$evaluacion = "";

//Consulta preguntar de casos practicos según unidad
$consultaPreguntas = "SELECT * FROM preguntas WHERE id_unidades = '".$idUnidad."' AND tipo = 'p'";
$enumeracion = mysql_query($consultaPreguntas);
$num = mysql_num_rows($enumeracion);

//Consulta unidad actual
$consultaUnidades = "SELECT * FROM unidades WHERE id='" .$idUnidad. "'";
$resultadoUnidades = mysql_query($consultaUnidades);
$unidad = mysql_fetch_array($resultadoUnidades);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Examenes_Test</title>
    <script src="js/jquery-1.11.0.min.js" ></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/funciones.js"></script>
    <link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
    <link rel="stylesheet" href="css/estilo.css" type="text/css" />
    
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
            <section id="sectiontest">
                    <div id="carousel" class="carousel slide" data-ride="carousel">
                        
                        <div class="carousel-inner">
                <?php
                $consultaPreguntas = "SELECT * FROM preguntas WHERE id_unidades = '".$idUnidad."' AND tipo='p' ORDER BY id ASC";
                $resultado = mysql_query($consultaPreguntas);
                
                $consultaUltimo = "SELECT * FROM preguntas WHERE id_unidades = '".$idUnidad."' AND tipo='p' ORDER BY id DESC LIMIT 1";
                $resultadoUltimo  = mysql_query($consultaUltimo);
                $ultimo = mysql_fetch_array($resultadoUltimo);
                
                $i = 0;
                while (($preguntas = mysql_fetch_assoc($resultado)) && ($i<50)){
                    $i++;
                    
                ?>
                            <div class="item<?php if($i <= 1){echo " active"; }?>">
                                <div class="finlay-carousel-caption">
                                    <h3 id="practicos"><?php echo $preguntas['pregunta'];?></h3>
                                    <p><input id="resolver" class="btn btn-success btn-default" type="button" onclick="casosPracticos('respuesta_correcta<?php echo $i;?>');casosPracticos('explicacion<?php echo $i;?>');" value="Resolver"></p>
                                    <div class="respuestaCorrectaPracticos">
                                    <p  id="respuesta_correcta<?php echo $i;?>" style="display: none;"><?php echo $preguntas['respuesta_correcta']; ?></p>
                                    <p id="explicacion<?php echo $i;?>" style="display: none;"><?php if (!empty($preguntas['explicacion'])){echo "Explicación: ".$preguntas['explicacion'];}?></p>
                                    </div>
                                    <p>
                                        <?php 
                                        
                                        //echo $preguntas["id"][0];
                                        if($i == 50 || ($preguntas["id"] == $ultimo["id"])){
                                            echo "<form method='POST'>";
                                            echo "<input type='hidden' name='idUnidad' value='$idUnidad'/>";
                                            echo "<input type='hidden' name='testNumero' value='$testNumero'/>";
                                            echo "<input type='hidden' name='resultados' id='resultados'/>";
                                            echo "<button class='btn btn-primary btn-danger' type='submit' onclick='arrayResultados();'>Terminar</button>";
                                            echo "</form>";
                                        }
                                        else{
                                            echo '<a href="#carousel-example-generic" role="button" data-slide="next"><button id="resolver" class="btn btn-primary btn-default">Siguiente</button></a>';
                                        }
                                        ?>
                                    </p>
                                </div>
                            </div>
                <?php
                }
                ?>
                        </div>
                    </div>
            </section>
            <footer>
                <article id="articleboton">
                    <a href="cursoPracticos.php?id=<?php echo $unidad["id_cursos"]; ?>"><img src="imagenes/anterior.png" /></a>
                </article>
                <article id="articleubicacion">
                    <?php
                    echo '<span id="ubica">'.$unidad['nombre'].'</span>';
                    ?>
                </article>
            </footer>
	</main>
<script type="text/javascript">
    $('a[data-slide="next"]').click(function() {
        $('#carousel').carousel('next');
    });
    
    $('#carousel').each(function(){
        $(this).carousel({
            interval: false
        });
    });
</script>
</body>
</html>

<?php
include('conexion.php');

$idUnidad = $_POST["idUnidad"];
$consultaPreguntas = "SELECT * FROM preguntas WHERE id_unidades = '".$idUnidad."' AND tipo = 't'";
$enumeracion = mysql_query($consultaPreguntas);
$num = mysql_num_rows($enumeracion);



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
            <header></header>
            <?php
            if(!isset($_POST["test"])){
            ?>
            <section>
                <h1>Test</h1>
                <article id="articleTest">
                    <table id="tablatest" class="table table-condensed">
                        <thead>
                        <tr>
                        <th>Tema</th>
                        <th>Evaluación</th>
                        <th>Aciertos</th>
                        <th>Errores</th>
                        <th></th>
                        </tr>
                        </thead>
                        <tbody>
                <?php
                $numTest = 0;
                for ($i = 0;$i<=$num;$i++){
                    if ($i % 50 == 0){
                        ++$numTest;
                ?>
                        <tr>
                <form method="POST">
                    <input type="hidden" name="idUnidad" value="<?php echo $idUnidad;?>"/>
                    <input type="hidden" name="testNumero" value="<?php echo $i;?>"/>
                    <td>Test <?php echo $numTest?></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><input type="submit" name="test" value="Entrar" class="btn btn-success btn-xs"></td>
                </form>

                <?php
                    }
                                       echo '</tr>';
                    
                  

                }
                ?>
                        </tbody>
                        </table>
                </article>
            </section>
            <?php
            }
            else{
            ?>
            <section id="sectiontest">
                    <div id="carousel" class="carousel slide" data-ride="carousel">
                        
                        <div class="carousel-inner">
                <?php
                $consultaPreguntas = "SELECT * FROM preguntas WHERE id_unidades = '".$idUnidad."'";
                $resultado = mysql_query($consultaPreguntas);
                mysql_data_seek($resultado, $_POST["testNumero"]);
                $i = 0;
                function mover($numero){
                    mysql_data_seek($resultado, $numero);
                }
                while (($preguntas = mysql_fetch_array($resultado)) && ($i<50)){
                    $i++;
                ?>
                            <div class="item<?php if($i <= 1){echo " active"; }?>">
                                <div class="finlay-carousel-caption">
                                    <h3><?php echo $preguntas['pregunta'];?></h3>
                                    <input type="hidden" contador
                                    <input type="hidden" value="<?php echo $preguntas['respuesta_correcta']; ?>" name="correcta" id="respuesta_correcta<?php echo $i; ?>"/>
                                    <p><button onclick="valida(this.value);" value="respuesta1" class="respuesta"><?php echo $preguntas['respuesta1']; ?></button></p>
                                    <p><button onclick="valida(this.value);" value="respuesta2" class="respuesta"><?php echo $preguntas['respuesta2']; ?></button></p>
                                    <p><button onclick="valida(this.value);" value="respuesta3" class="respuesta"><?php echo $preguntas['respuesta3']; ?></button></p>
                                    <p><button onclick="valida(this.value);" value="respuesta4" class="respuesta"><?php echo $preguntas['respuesta4']; ?></button></p>
                                    <p id="explicacion" style="display: none;visibility: hidden;"><?php echo $preguntas['explicacion']; ?></p>
                                </div>
                            </div>
                <?php
                }
                ?>
                        </div>
                        <a href="#carousel-example-generic" role="button" data-slide="next"><button>Siguiente</button></a>
                    </div>
            </section>
            <?php
            }
            ?>
            <footer>
                <article id="articleboton">
                <a href="panel.php"><img src="imagenes/anterior.png" /></a>
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

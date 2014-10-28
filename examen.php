<?php
session_start();
include('conexion.php');

if(isset($_POST["id"])){
    $idCurso = $_POST["id"];
}

$usuarioId = $_SESSION["usuarioId"];
$evaluacion = "";


$consultaCurso = "SELECT * FROM cursos WHERE id = '".$idCurso."'";
$resultadoCurso = mysql_query($consultaCurso);
$curso = mysql_fetch_array($resultadoCurso);

$consultaUnidades = "SELECT * FROM unidades WHERE id_cursos = '".$curso["id"]."'";
$resultadoUnidades = mysql_query($consultaUnidades);
$unidades = mysql_fetch_array($resultadoUnidades);


$aciertos = 0;
$fallos = 0;
$blancos = 0;
if (isset($_POST["resultados"])){
    //Recogemos el String con los resultados
    $resultadosString = $_POST["resultados"];
    
    //Lo transformamos a array y buscamos los aciertos,fallos y blancos
    $resultados = explode(",", $resultadosString);
    foreach ($resultados as $value){
        if($value == "acierto"){
            $aciertos++;
        }
        elseif($value == "fallo"){
            $fallos++;
        }
        else{
            $blancos++;
        }
    }
    
    //Recogemos el resto de variables
    $numero = $_POST["testNumero"];
    $usuarioId = $_SESSION["usuarioId"];
    
    
    $consultaResultados = "INSERT into test(numero,aciertos,fallos,blancos,id_unidades,id_usuario) VALUES('".$numero."','".$aciertos."','".$fallos."','".$blancos."','".$idUnidad."','".$usuarioId."')";
    if(mysql_query($consultaResultados)){
        $_SESSION["idUnidad"] = $idUnidad;
        echo "<script>window.location.href='test.php'</script>";
    }
}

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
                <span class="headerUsuario"><p><?php echo $_SESSION["usuarioNombre"];?></p>
                    <p><a href="index.php">Cerrar sesión</a></p></span>
            </header>
            <section id="sectiontest">
                    <div id="carousel" class="carousel slide" data-ride="carousel">
                        
                        <div class="carousel-inner">
                <?php
                $totalPreguntas = "SELECT * FROM preguntas WHERE id_unidades IN(SELECT id FROM unidades WHERE id_cursos = '".$curso["id"]."') AND tipo = 't'";
                $resultadoTotal = mysql_query($totalPreguntas);
                $total = mysql_fetch_array($resultadoTotal);
                //Cantidad de preguntas totales,lo usaremos para calcular el porcentaje que corresponde a cada tema
                $num = mysql_num_rows($resultadoTotal);
                
                $consultaUnidades = "SELECT * FROM unidades WHERE id_cursos = '".$curso["id"]."'";
                $resultadoUnidades = mysql_query($consultaUnidades);
                while ($unidades = mysql_fetch_array($resultadoUnidades)){
                    $preguntaUnidades = "SELECT * FROM preguntas WHERE id_unidades = '".$unidades["id"]."' AND tipo = 't'";
                    $resultadopreguntaUnidades = mysql_query($preguntaUnidades);
                    $numPreguntas[] = mysql_num_rows($resultadopreguntaUnidades);
                }
                echo $num;
                foreach ($numPreguntas as $value) {
                    echo "Tema 1: ".$value."<br>";
                }
   
                $i = 0;
                /*while (($preguntas = mysql_fetch_assoc($resultado)) && ($i<50)){
                    $i++;                 
                ?>
                            <div class="item<?php if($i <= 1){echo " active"; }?>">
                                <div class="finlay-carousel-caption">
                                    <h3><?php echo $preguntas['pregunta'];?></h3>
                                    <input type="hidden" value="<?php echo $preguntas['respuesta_correcta']; ?>" name="correcta" id="respuesta_correcta<?php echo $i;?>"/>
                                    <p><button onclick="valida(this.value,<?php echo $i;?>);" value="respuesta1" class="pregunta<?php echo $i;?>"><?php echo $preguntas['respuesta1']; ?></button></p>
                                    <p><button onclick="valida(this.value,<?php echo $i;?>);" value="respuesta2" class="pregunta<?php echo $i;?>"><?php echo $preguntas['respuesta2']; ?></button></p>
                                    <p><button onclick="valida(this.value,<?php echo $i;?>);" value="respuesta3" class="pregunta<?php echo $i;?>"><?php echo $preguntas['respuesta3']; ?></button></p>
                                    <p><button onclick="valida(this.value,<?php echo $i;?>);" value="respuesta4" class="pregunta<?php echo $i;?>"><?php echo $preguntas['respuesta4']; ?></button></p>
                                    <p id="explicacion<?php echo $i;?>" style="display: none;"><?php echo $preguntas['explicacion']; ?></p>
                                    <p>
                                        <?php 
                                        
                                        //echo $preguntas["id"][0];
                                        if($i == 50 || ($preguntas["id"] == $ultimo["id"])){
                                            echo "<form method='POST'>";
                                            echo "<input type='hidden' name='idUnidad' value='$idUnidad'/>";
                                            echo "<input type='hidden' name='testNumero' value='$testNumero'/>";
                                            echo "<input type='hidden' name='resultados' id='resultados'/>";
                                            echo "<button type='submit' onclick='arrayResultados();'>Terminar</button>";
                                            echo "</form>";
                                        }
                                        else{
                                            echo '<a href="#carousel-example-generic" role="button" data-slide="next"><button>Siguiente</button></a>';
                                        }
                                        ?>
                                    </p>
                                </div>
                            </div>
                <?php
                    
                }*/
                ?>
                        </div>
                    </div>
            </section>
            <footer>
                <article id="articleboton">
                <a href="unidad.php?id=<?php echo $unidad["id_cursos"]; ?>"><img src="imagenes/anterior.png" /></a>
                </article>
                <article id="articleubicacion">
                    <?php
                    echo '<span id="ubica">'.$curso['nombre'].'</span>';
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

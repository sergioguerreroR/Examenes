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
    //Total de preguntas realizadas
    $numTotalPreg = $_POST["numTotalPreg"];
    //Recogemos el String con los resultados
    $resultadosString = $_POST["resultados"];
    
    //Lo transformamos a array y buscamos los aciertos,fallos y blancos
    $resultados = explode(",", $resultadosString);
    for ($i=1;$i<=$numTotalPreg;$i++){
        if(isset($resultados[$i]) && $resultados[$i] == "acierto"){
            $aciertos++;
        }
        elseif(isset($resultados[$i]) && $resultados[$i] == "fallo"){
            $fallos++;
        }
        else{
            $blancos++;
        }
    }
    /*foreach ($resultados as $value){
        if($value == "acierto"){
            $aciertos++;
        }
        elseif($value == "fallo"){
            $fallos++;
        }
        else{
            $blancos++;
        }
    }*/
    
    //Recogemos el resto de variables
    $usuarioId = $_SESSION["usuarioId"];
    
    
    $consultaResultados = "INSERT INTO examen(id_curso,id_alumno,aciertos,fallos,blancos) VALUES('".$idCurso."','".$usuarioId."','".$aciertos."','".$fallos."','".$blancos."')";
    mysql_query($consultaResultados);
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
            <header id="cabecera">
                <div id="caraDali">
                    <img id="caraImagen" src="imagenes/cabeceraCDP.png">
                </div>
                <div id="nombreUsuarioRegistrado">
                    <p><?php echo $_SESSION["usuarioNombre"];?></p>
                    <p><a href="index.php">Cerrar sesión</a></p>
                </div>
            </header>
            <?php
            //Se ejecutará este código si no estamos haciendo el examen
            if(!isset($_POST["test"])){
                $consultaAlumnoExamen = "SELECT * FROM examen WHERE id_alumno = '".$_SESSION["usuarioId"]."' ORDER BY ID DESC LIMIT 1";
                $resultadoAlumnoExamen = mysql_query($consultaAlumnoExamen);
                $cant = mysql_num_rows($resultadoAlumnoExamen);
                if ($cant == 0){
                    echo "<h2 style='text-align:center;padding-top:25px;'>Aún no has realizado ningún examen</h2>";
                }
                else{
                    echo "<h2 style='text-align:center;padding-top:25px;'>Examen Realizado</h2><br>";
             ?>
                    <article id="articleTest">
                    <table id="tablatest" class="table table-condensed">
                        <thead>
                        <tr>
                        <th>Aciertos</th>
                        <th>Errores</th>
                        <th>Blancos</th>
                        </tr>
                        </thead>
                        <tbody>
            <?php
                    $examen = mysql_fetch_array($resultadoAlumnoExamen);
                    echo "<tr>";
                    echo "<td>".$examen["aciertos"]."</td>";
                    echo "<td>".$examen["fallos"]."</td>";
                    echo "<td>".$examen["blancos"]."</td>";
                    echo "</tr>";
            ?>
                        </tbody>
                    </table>
                    </article>       
            <?php
                }
            ?>
            
            
            <form method="POST">
                <input type="hidden" name="id" value="<?php echo $idCurso;?>">
                <center><input type="submit" name="test" class="btn btn-warning" style="text-aling:center;" value="Empezar examen"></center>
            </form>
            
            <?php
            }
            else{
            ?>
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
                $i = 0;
                while ($unidades = mysql_fetch_array($resultadoUnidades)){
                    $preguntaUnidades = "SELECT * FROM preguntas WHERE id_unidades = '".$unidades["id"]."' AND tipo = 't'";
                    $resultadopreguntaUnidades = mysql_query($preguntaUnidades);
                    
                    //Número de preguntas que tiene cada unidad
                    $numPreguntas = mysql_num_rows($resultadopreguntaUnidades);
                    
                    //Número de preguntas que apaeceran en el examen
                    $numExamen = round(($numPreguntas/$num)*100);
                    
                    //Consulta para imprimir preguntas segun el numero que tiene que aparecer en el examen
                    $consultaExamen = "SELECT * FROM preguntas WHERE id_unidades = '".$unidades["id"]."' AND tipo = 't' ORDER BY RAND() LIMIT $numExamen";
                    $resultadoExamen = mysql_query($consultaExamen);
                    
                    while (($examen = mysql_fetch_assoc($resultadoExamen)) && ($i<100)){
                    $i++;
                    
                ?>
                    <div class="item<?php if($i <= 1){echo " active"; }?>">
                        <div class="finlay-carousel-caption">
                            <center><h3 id="practicos"><?php echo $i." - ".$examen['pregunta'];?></h3></center>
                            <input type="hidden" value="<?php echo $examen['respuesta_correcta']; ?>" name="correcta" id="respuesta_correcta<?php echo $i;?>"/>
                            <center><p><button id="botonProgramados" onclick="valida(this.value,<?php echo $i;?>);" value="respuesta1" class="pregunta<?php echo $i;?>"><?php echo $examen['respuesta1']; ?></button></p></center>
                            <center><p><button id="botonProgramados" onclick="valida(this.value,<?php echo $i;?>);" value="respuesta2" class="pregunta<?php echo $i;?>"><?php echo $examen['respuesta2']; ?></button></p></center>
                            <center><p><button id="botonProgramados" onclick="valida(this.value,<?php echo $i;?>);" value="respuesta3" class="pregunta<?php echo $i;?>"><?php echo $examen['respuesta3']; ?></button></p></center>
                            <center><p><button id="botonProgramados" onclick="valida(this.value,<?php echo $i;?>);" value="respuesta4" class="pregunta<?php echo $i;?>"><?php echo $examen['respuesta4']; ?></button></p></center>
                            <p id="explicacion<?php echo $i;?>" style="display: none;"><?php echo $examen['explicacion']; ?></p>
                            <p>
                                <?php 

                                //echo $preguntas["id"][0];
                                if($i == 100){
                                    echo "<form method='POST'>";
                                    echo "<input type='hidden' name='id' value='$idCurso'/>";
                                    echo "<input type='hidden' name='resultados' id='resultados'/>";
                                    echo "<input type='hidden' name='numTotalPreg' value='$i'/>";
                                    echo "<center><button class='btn btn-primary btn-danger' type='submit' onclick='arrayResultados();'>Terminar</button></center>";
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
                }
    

                
                ?>
                        </div>
                    </div>
            </section>
            <?php
            }
            ?>
            <footer>
                <?php
                if(!isset($_POST["test"])){
                ?>
                <article id="articleboton">
                <a href="unidad.php?id=<?php echo $curso["id"]; ?>"><img src="imagenes/anterior.png" /></a>
                </article>
                <?php
                }
                ?>
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

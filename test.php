<?php
session_start();
include('conexion.php');

//Recogida de datos necesarios para poder actualizar la pagina
if(isset($_POST["idUnidad"])){
    $idUnidad = $_POST["idUnidad"];
}
 else {
    $idUnidad = $_SESSION["idUnidad"];
}
$usuarioId = $_SESSION["usuarioId"];
$evaluacion = "";

//Preguntas tipo test según unidad
$consultaPreguntas = "SELECT * FROM preguntas WHERE id_unidades = '".$idUnidad."' AND tipo = 't'";
$enumeracion = mysql_query($consultaPreguntas);
$num = mysql_num_rows($enumeracion);

//Seleccionamos unidad actual
$consultaUnidades = "SELECT * FROM unidades WHERE id='" .$idUnidad. "'";
$resultadoUnidades = mysql_query($consultaUnidades);
$unidad = mysql_fetch_array($resultadoUnidades);

//Inicializamos variables necesarias
$aciertos = 0;
$fallos = 0;
$blancos = 0;

//Recogida de resultados
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
    
    //Hacemos el insert del resultado del test
    $consultaResultados = "INSERT into test(numero,aciertos,fallos,blancos,id_unidades,id_usuario) VALUES('".$numero."','".$aciertos."','".$fallos."','".$blancos."','".$idUnidad."','".$usuarioId."')";
    //Si se hace la consulta, entramos a la pagina de nuevo y enviamos la unidad por variable de sesión
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
                <?php echo $_SESSION["usuarioNombre"];?>
                <a href="index.php">Cerrar sesión</a>
            </header>
            <?php
            //Se ejecutará este código si no estamos haciendo un test
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
                //Variables para control de preguntas y resultados
                $numTest = 0;
                $totalPreguntas = $num;
                $necesario = 0;
                //Bucle que dividirá los test cada 50 preguntas
                for ($i = 0;$i<=$num;$i++){
                    if ($i % 50 == 0){
                        if($totalPreguntas-50 > 0){
                            $totalPreguntas = $totalPreguntas-50;
                            $numeroPreguntas = 50;
                        }
                        else{
                            $numeroPreguntas = $totalPreguntas;
                        }
                         
                        ++$numTest;
                ?>
                        <tr>
                <form method="POST">
                    <input type="hidden" name="idUnidad" value="<?php echo $idUnidad;?>"/>
                    <input type="hidden" name="testNumero" value="<?php echo $numTest;?>"/>
                    <input type="hidden" name="puntero" value="<?php echo $i;?>" />
                    <td>Test <?php echo $numTest?></td>
                    <?php
                    //Mostramos resultados si existen
                    $consultaTest = "SELECT * FROM test WHERE id_unidades = '".$idUnidad."' AND id_usuario = '".$usuarioId."' AND numero = '".$numTest."' ORDER BY id DESC LIMIT 1";
                    $resultadoTest = mysql_query($consultaTest);
                    $test = mysql_fetch_array($resultadoTest);
                    $evalua = mysql_num_rows($resultadoTest);
                    $necesario = round(($numeroPreguntas * 80) / 100);
                    if ($evalua != 0){
                        if ($test["aciertos"] >= $necesario){
                            $evaluacion = "APTO";
                        }
                        else {
                            $evaluacion = "NO APTO";
                        }
                    }
                    else{
                        $evaluacion = "";
                    }
                    ?>
                    <td><?php echo $evaluacion;?></td>
                    <td><?php echo $test["aciertos"];?></td>
                    <td><?php echo $test["fallos"];?></td>
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
                $testNumero = $_POST["testNumero"];
                $puntero = $_POST["puntero"];
                $consultaPreguntas = "SELECT * FROM preguntas WHERE id_unidades = '".$idUnidad."' AND tipo = 't' ORDER BY id ASC";
                $resultado = mysql_query($consultaPreguntas);
                
                $consultaUltimo = "SELECT * FROM preguntas WHERE id_unidades = '".$idUnidad."' AND tipo = 't' ORDER BY id DESC LIMIT 1";
                $resultadoUltimo  = mysql_query($consultaUltimo);
                $ultimo = mysql_fetch_array($resultadoUltimo);
                
                //Colocamos el puntero en el resultado indicado en el número de test
                mysql_data_seek($resultado, $puntero);
                
                $i = 0;
                while (($preguntas = mysql_fetch_assoc($resultado)) && ($i<50)){
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
                    
                }
                ?>
                        </div>
                        
                    </div>
            </section>
            <?php
            }
            ?>
            <footer>
                <article id="articleboton">
                <a href="unidad.php?id=<?php echo $unidad["id"]; ?>"><img src="imagenes/anterior.png" /></a>
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

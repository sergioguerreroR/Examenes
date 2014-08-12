<?php
include('conexion.php');

$idUnidad = $_POST["idUnidad"];
$consultaPreguntas = "SELECT * FROM preguntas WHERE id_unidades = '".$idUnidad."' AND tipo = 't'";
$enumeracion = mysql_query($consultaPreguntas);
$num = mysql_num_rows($enumeracion);
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
                <?php
                $numTest = 0;
                for ($i = 0;$i<=$num;$i++){
                    if ($i % 50 == 0){
                        ++$numTest;
                ?>
                <form method="POST">
                    <input type="hidden" name="idUnidad" value="<?php echo $idUnidad;?>"/>
                    <input type="hidden" name="testNumero" value="<?php echo $i;?>"/>
                    <input type="submit" name="test" value="TEST <?php echo $numTest?>"/>
                </form>
                <?php
                    }

                }
                ?>
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
                while (($preguntas = mysql_fetch_array($resultado)) && ($i<50)){
                    $i++;
                ?>
                            <div class="item<?php if($i <= 1){echo " active"; }?>">
                                <div class="finlay-carousel-caption">
                                    <h3><?php echo $preguntas['pregunta'];?></h3>
                                    <p><?php echo $preguntas['respuesta1']; ?></p>
                                    <p><?php echo $preguntas['respuesta2']; ?></p>
                                    <p><?php echo $preguntas['respuesta3']; ?></p>
                                    <p><?php echo $preguntas['respuesta4']; ?></p>
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
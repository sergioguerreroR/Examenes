<?php
include('conexion.php');

$idUnidad = $_POST["idUnidad"];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Examenes_Test</title>
    <script src="js/jquery-1.11.0.min.js" ></script>
    <script src="js/bootstrap.js"></script>
    
    <link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
    <link rel="stylesheet" href="css/estilo.css" type="text/css" />
    
</head>
<body>
	<main>
            <?php
            if(!isset($_POST["test"])){
            ?>
            <section>
                <form method="POST">
                    <input type="hidden" name="idUnidad" value="<?php echo $idUnidad;?>"/>
                    <input type="hidden" name="testNumero" value="0"/>
                    <input type="submit" name="test" value="TEST 1"/>
                </form>
                <form method="POST">
                    <input type="hidden" name="idUnidad" value="<?php echo $idUnidad;?>"/>
                    <input type="hidden" name="testNumero" value="50"/>
                    <input type="submit" name="test" value="TEST 2"/>
                </form>
            </section>
            <?php
            }
            else{
            ?>
            <section>
                <?php
                $consultaPreguntas = "SELECT * FROM preguntas WHERE id_unidades = '".$idUnidad."'";
                $resultado = mysql_query($consultaPreguntas);
                mysql_data_seek($resultado, $_POST["testNumero"]);
                $i = 0;
                while (($preguntas = mysql_fetch_array($resultado)) && ($i<50)){
                    $i++;
                    echo $i." - ".$preguntas["id"]."<br>";

                }
                ?>
            </section>
            <?php
            }
            ?>
	</main>
</body>
</html>
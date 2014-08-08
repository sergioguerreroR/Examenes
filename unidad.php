<?php
include('conexion.php');

$idUnidad = $_POST["id"];

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Examenes_Test</title>
    <link rel="stylesheet" href="css/estilo.css" type="text/css">
</head>
<body>
	<main>
            <form method="POST" action="test.php">
                <input type="hidden" name="idUnidad" value="<?php echo $idUnidad; ?>" />
                <input type="submit" value="Test Programados" />                
            </form>
            <form method="POST" action="examen.php">
                <input type="hidden" name="idUnidad" value="<?php echo $idUnidad; ?>" />
                <input type="submit" value="Test de Examen" />                
            </form>
            <form method="POST" action="practicos.php">
                <input type="hidden" name="idUnidad" value="<?php echo $idUnidad; ?>" />
                <input type="submit" value="Casos practicos" />                
            </form>
	</main>
</body>
</html>
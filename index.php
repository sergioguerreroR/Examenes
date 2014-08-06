<?php
include('conexion.php');

if (isset($_POST["iniciar"])) {
    $email = $_POST["email"];
    $pass = $_POST["pass"];
    
    $consulta = "SELECT * FROM usuarios WHERE email = '".$email."' AND pass = '".$pass."'";
    $resultado = mysql_query($consulta);
    $num = mysql_num_rows($resultado);
    if ($num == 1) {
        header("panel.php");
    }
    else{
        echo '<script>alert("No existe el usuario");</script>';
    }
    
}

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
            <header>Aquí va la imagen de cabecera</header>
            <section id="login">
            <a href="panel.php">Enlace a panel</a>
            </section>
            <section id="password">
                <a href="panel.php"><img src="imagenes/contra.png" /></a>
                <form method="POST">
                    <input type="text" name="email" placeholder="Email"/>
                    <input type="password" name="pass" placeholder="Contraseña"/>
                    <input type="submit" name="iniciar"/>
                ´</form>
            </section>
	</main>
</body>
</html>

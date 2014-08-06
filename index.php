<?php
include('conexion.php');

if (isset($_POST["iniciar"])) {
    $email = $_POST["email"];
    $pass = $_POST["pass"];
    
    $consulta = "SELECT * FROM usuarios WHERE email = '".$email."' AND pass = '".$pass."'";
    $resultado = mysql_query($consulta);
    $num = mysql_num_rows($resultado);
    if ($num == 1) {
        echo "<script>window.location.href='panel.php'</script>";
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
            <form method="POST">
                <section id="login">
                    <img src="imagenes/usuario2.png" />
                    <input type="text" name="email" placeholder="Email"/>
                 </section>
                <section id="password">
                    <img src="imagenes/contra.png" />
                    <input type="password" name="pass" placeholder="Contraseña"/>
                    <input type="submit" name="iniciar"/>
                </section>
            </form>
	</main>
</body>
</html>

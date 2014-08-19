<?php
session_start();
session_unset();
session_destroy();
session_start();
include('conexion.php');

if (isset($_POST["iniciar"])) {
    $email = $_POST["email"];
    $pass = $_POST["pass"];
    
    $consulta = "SELECT * FROM usuarios WHERE email = '".$email."' AND pass = '".$pass."'";
    $resultado = mysql_query($consulta);
    $usuario = mysql_fetch_array($resultado);
    $num = mysql_num_rows($resultado);
    if ($num == 1) {
        $_SESSION["usuarioId"] = $usuario["id"];
        $_SESSION["usuarioNombre"] = $usuario["nombre"];
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
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="js/bootstrap.js"></script>
    <link rel="stylesheet" href="css/estilo.css" type="text/css">
    <script src="js/funciones.js"></script>

</head>
<body>
	<main>
            <header>
                <?php echo $_SESSION["usuarioNombre"];?>
                <a href="index.php">Cerrar sesión</a>
            </header>
            <section id="sectionindex">
            <form method="POST">
                <article id="login">
                    <img src="imagenes/usuario2.png" />
                    <input type="text" name="email" placeholder="Email"/>
                 </article>
                <article id="password">
                    <img src="imagenes/contra.png" />
                    <input type="password" name="pass" placeholder="Contraseña"/>
                </article>
                <article id="btnentrar">
                    <input type="submit" name="iniciar" value="Entrar" class="btn btn-primary btn-lg">
                </article>
            </form>
            </section>
	</main>
</body>
</html>

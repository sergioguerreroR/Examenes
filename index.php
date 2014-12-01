<?php
session_start();
session_unset();
session_destroy();
session_start();
include('conexion.php');

//Inicializamos la variable error
$error=0;

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
       $error=1;  
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
                <div id="caraDali">
                    <img id="caraImagen" src="imagenes/cabeceraCDP.png">
                </div>
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
                <?php
                    if($error==1){
                        echo '<p id="colorError">Usuario o contraseña no válidos.</p>';
                    }
                ?>
                <article id="btnentrar">
                    <input type="submit" name="iniciar" value="Entrar" class="btn btn-primary btn-lg">
                </article>
            </form>
            </section>
	</main>
</body>
</html>

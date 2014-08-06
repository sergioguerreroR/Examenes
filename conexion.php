<?php  	
	$Usuario="root";  
        $Password="4321";
        //$Servidor="bbdd.cefocor.com";
        $Servidor="192.168.1.100"; 
        $BaseDeDatos="test";
        
	$db = mysql_connect($Servidor,$Usuario,$Password) or die ("Error al conectar con el servidor");
	mysql_select_db($BaseDeDatos)or die("Error al conectar con la base de datos"); 
	
	mysql_query("SET NAMES 'UTF8'");
?>

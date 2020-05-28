<?php


	$servidor='localhost';
	$usuario='root';
	$password='s1152951';
	$BD='trash';

	try {
		$con = mysqli_connect($servidor, $usuario, $password, $BD) or die("error al conectar".mysql_error());
	} catch (MYSQLException $Prueba_error) {
		echo "Error: " . $Prueba_error->getMessage();
	}
	
?>
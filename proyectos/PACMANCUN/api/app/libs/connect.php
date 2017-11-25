<?php if(!defined("SPECIALCONSTANT")) die("Acceso denegado");

function getConnection()
{
	try{
		/*$db_username = "root";
		$db_password = "root1234";*/
		$db_username = "ariffpj7_admin";
		$db_password = "C@ncun2017";
		$connection = new PDO("mysql:host=localhost;dbname=ariffpj7_hackatour", $db_username, $db_password);
		$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $e)
	{
		echo "Error: " . $e->getMessage();
	}
	return $connection;
} 
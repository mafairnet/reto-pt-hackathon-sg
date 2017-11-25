<?php
$app->post("/login/", function() use($app)
{
	$user = $app->request->post("usuario");
	$pass = $app->request->post("contrasena");
	try{
		$connection = getConnection();
		$dbh = $connection->prepare("CALL sp_Login (?,?)");
		$dbh->bindParam(1, $user);
		$dbh->bindParam(2, $pass);
		$dbh->execute();
		$elemento = $dbh->fetch();
		$connection = null;
		$respuesta = array();
    if( !empty($elemento)) {
      $respuesta= array('Token' => uniqid());
    }else{
    	$respuesta= array('Token' => '','mensaje'=>'Error en credenciales');
	}


    $app->response->headers->set("Content-type", "application/json");
    $app->response->status(200);
    $app->response->body(json_encode($respuesta));
	}
	catch(PDOException $e)
	{
		echo "Error: " . $e->getMessage();
	}
});
$app->get("/login/", function() use($app)
{
	$respuesta= array('Trabajando' => '.....');
	try{

	 $app->response->headers->set("Content-type", "application/json");
    $app->response->status(200);
    $app->response->body(json_encode($respuesta));
	}
	catch(PDOException $e)
	{
		echo "Error: " . $e->getMessage();
	}	
});
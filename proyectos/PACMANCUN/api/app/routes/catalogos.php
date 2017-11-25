<?php
if(!defined("SPECIALCONSTANT")) die("Acceso denegado");

$app->get("/tiposEventos/", function() use($app)
{
	try{
		$connection = getConnection();
		$id='';
		$dbh = $connection->prepare("CALL sp_ListaUsuarios (?)");
		$dbh->bindParam(1, $id);
		$dbh->execute();
		$elementos = $dbh->fetchAll();
		$connection = null;
		$respuesta = array();
    foreach ($elementos as $elemento) {
      $respuesta[] = array('idUsuario' => $elemento["idUsuario"]
        , 'nombre' => htmlentities(utf8_encode($elemento["nombre"]))
        , 'apellidos' => htmlentities(utf8_encode($elemento["apellidos"]))
        , 'correo' => htmlentities(utf8_encode($elemento["correo"]))
 		, 'edad' => $elemento["edad"]
        , 'idioma' => $elemento["idioma"]
        , 'nacional' => $elemento["nacional"]
        , 'estatus' => $elemento["estatus"]);
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

$app->get("/tiposEventos/:id", function($id) use($app)
{
	try{
		$connection = getConnection();
		$dbh = $connection->prepare("CALL sp_ListaUsuarios (?)");
		$dbh->bindParam(1, $id);
		$dbh->execute();
		$elemento = $dbh->fetch();
		$connection = null;
		$respuesta = array();
	    if(!empty($elemento)) {
	      $respuesta = array('idUsuario' => $elemento["idUsuario"]
	        , 'nombre' => htmlentities(utf8_encode($elemento["nombre"]))
	        , 'apellidos' => htmlentities(utf8_encode($elemento["apellidos"]))
	        , 'correo' => htmlentities(utf8_encode($elemento["correo"]))
	 		, 'edad' => $elemento["edad"]
	        , 'idioma' => $elemento["idioma"]
	        , 'nacional' => $elemento["nacional"]
	        , 'estatus' => $elemento["estatus"]);
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
$app->get("/tiposEventos/", function() use($app)
{
	try{
		$connection = getConnection();
		$id='';
		$dbh = $connection->prepare("CALL sp_ListaUsuarios (?)");
		$dbh->bindParam(1, $id);
		$dbh->execute();
		$elementos = $dbh->fetchAll();
		$connection = null;
		$respuesta = array();
    foreach ($elementos as $elemento) {
      $respuesta[] = array('idUsuario' => $elemento["idUsuario"]
        , 'nombre' => htmlentities(utf8_encode($elemento["nombre"]))
        , 'apellidos' => htmlentities(utf8_encode($elemento["apellidos"]))
        , 'correo' => htmlentities(utf8_encode($elemento["correo"]))
 		, 'edad' => $elemento["edad"]
        , 'idioma' => $elemento["idioma"]
        , 'nacional' => $elemento["nacional"]
        , 'estatus' => $elemento["estatus"]);
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

$app->get("/tiposEventos/:id", function($id) use($app)
{
	try{
		$connection = getConnection();
		$dbh = $connection->prepare("CALL sp_ListaUsuarios (?)");
		$dbh->bindParam(1, $id);
		$dbh->execute();
		$elemento = $dbh->fetch();
		$connection = null;
		$respuesta = array();
	    if(!empty($elemento)) {
	      $respuesta = array('idUsuario' => $elemento["idUsuario"]
	        , 'nombre' => htmlentities(utf8_encode($elemento["nombre"]))
	        , 'apellidos' => htmlentities(utf8_encode($elemento["apellidos"]))
	        , 'correo' => htmlentities(utf8_encode($elemento["correo"]))
	 		, 'edad' => $elemento["edad"]
	        , 'idioma' => $elemento["idioma"]
	        , 'nacional' => $elemento["nacional"]
	        , 'estatus' => $elemento["estatus"]);
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

/*$app->post("/usuarios/", function() use($app)
{
	$title = $app->request->post("title");
	$isbn = $app->request->post("isbn");
	$author = $app->request->post("author");

	try{
		$connection = getConnection();
		$dbh = $connection->prepare("INSERT INTO books VALUES(null, ?, ?, ?, NOW())");
		$dbh->bindParam(1, $title);
		$dbh->bindParam(2, $isbn);
		$dbh->bindParam(3, $author);
		$dbh->execute();
		$bookId = $connection->lastInsertId();
		$connection = null;
		$app->response->headers->set("Content-type", "application/json");
		$app->response->status(200);
		$app->response->body(json_encode($bookId));
	}
	catch(PDOException $e)
	{
		echo "Error: " . $e->getMessage();
	}
});

$app->put("/usuarios/", function() use($app)
{
	$title = $app->request->put("title");
	$isbn = $app->request->put("isbn");
	$author = $app->request->put("author");
	$id = $app->request->put("id");

	try{
		$connection = getConnection();
		$dbh = $connection->prepare("UPDATE books SET title = ?, isbn = ?, author = ?, created_at = NOW() WHERE id = ?");
		$dbh->bindParam(1, $title);
		$dbh->bindParam(2, $isbn);
		$dbh->bindParam(3, $author);
		$dbh->bindParam(4, $id);
		$dbh->execute();
		$connection = null;
		$app->response->headers->set("Content-type", "application/json");
		$app->response->status(200);
		$app->response->body(json_encode(array("res" => 1)));
	}
	catch(PDOException $e)
	{
		echo "Error: " . $e->getMessage();
	}
});

$app->delete("/usuarios/:id", function($id) use($app)
{
	try{
		$connection = getConnection();
		$dbh = $connection->prepare("DELETE FROM books WHERE id = ?");
		$dbh->bindParam(1, $id);
		$dbh->execute();
		$connection = null;
		$app->response->headers->set("Content-type", "application/json");
		$app->response->status(200);
		$app->response->body(json_encode(array("res" => 1)));
	}
	catch(PDOException $e)
	{
		echo "Error: " . $e->getMessage();
	}
});*/
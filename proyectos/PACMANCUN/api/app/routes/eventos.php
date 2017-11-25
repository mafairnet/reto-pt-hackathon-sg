<?php
if(!defined("SPECIALCONSTANT")) die("Acceso denegado");

$app->get("/eventos/", function() use($app)
{
	try{
		$connection = getConnection();
		$id=0;
		$dbh = $connection->prepare("CALL sp_Eventos (?)");
		$dbh->bindParam(1, $id);
		$dbh->execute();
		$elementos = $dbh->fetchAll();
		$connection = null;
		$respuesta = array();
    foreach ($elementos as $elemento) {
      $respuesta[] = array('idEvento' => $elemento["idEvento"]
        , 'evento' => htmlentities(utf8_encode($elemento["evento"]))
        , 'idTipoEvento' => htmlentities(utf8_encode($elemento["idTipoEvento"]))
        , 'idEstatus' => htmlentities(utf8_encode($elemento["idEstatus"]))
 		, 'idSitio' => $elemento["idSitio"]
        , 'fecha' => $elemento["fecha"]
        , 'horario' => $elemento["horario"]
        , 'tipoEvento' => $elemento["tipoEvento"]);
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

$app->get("/eventos/:id", function($id) use($app)
{
	try{
		$connection = getConnection();
		$dbh = $connection->prepare("CALL sp_Eventos (?)");
		$dbh->bindParam(1, $id);
		$dbh->execute();
		$elemento = $dbh->fetch();
		$connection = null;
		$respuesta = array();
	    if(!empty($elemento)) {
	      $respuesta = array('idEvento' => $elemento["idEvento"]
	        , 'evento' => htmlentities(utf8_encode($elemento["evento"]))
	        , 'idTipoEvento' => htmlentities(utf8_encode($elemento["idTipoEvento"]))
	        , 'idEstatus' => htmlentities(utf8_encode($elemento["idEstatus"]))
	 		, 'idSitio' => $elemento["idSitio"]
	        , 'fecha' => $elemento["fecha"]
	        , 'horario' => $elemento["horario"]
	        , 'tipoEvento' => $elemento["tipoEvento"]);
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

$app->post("/eventos/", function() use($app)
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

$app->put("/eventos/", function() use($app)
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

$app->delete("/eventos/:id", function($id) use($app)
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
});
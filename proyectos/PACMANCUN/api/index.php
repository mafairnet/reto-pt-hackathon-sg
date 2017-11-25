<?php
require 'Slim/Slim.php';

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();

define("SPECIALCONSTANT", true);
require 'app/libs/connect.php';
require 'app/routes/usuarios.php';
//require 'app/routes/login.php';
require 'app/routes/ofertas.php';
require 'app/routes/sitios.php';
require 'app/routes/catalogos.php';
require 'app/routes/eventos.php';

$app->run();
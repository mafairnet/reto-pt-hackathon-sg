<?php
//ob_start();
?><?php
/*include("lib/conector.php");
$api="http://192.168.1.52/";

$url = $api."login/"
echo $url;
$user=isset($_REQUEST["usuario"])?$_REQUEST["usuario"]:"";
$password=isset($_REQUEST["password"])?$_REQUEST["password"]:"";
if(!empty($user) && !empty($password)){

$http = new HttpConnection();
$User = json_decode($http->post($url,$arrayName = array('usuario' => $user,'usuario' => $password )));
session_start();*/
header('Location: perfil.php');
?>
<?php
//ob_end_flush();
?>
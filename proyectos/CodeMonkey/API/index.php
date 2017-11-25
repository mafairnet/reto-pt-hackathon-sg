<?php
// Asignamos un espacio de trabajo
namespace Hackaton;

// Permitimos la lectura de los archivos protegidos
define('_EXEC', 1);

// Definimos la extension de las clases php
define('CLASS_PHP', '.class.php');
// Definimos la ruta del index.php como directorio root
define('PATH_ROOT', __DIR__);
// Definimos la ruta para las clases php
define('PATH_CLASSES', PATH_ROOT . '/classes/');

class API
{
    private $_crud;
    private $_params;

    public function __construct()
    {
        header('Content-type: application/json');
        header("Access-Control-Allow-Origin: *");
    }

    public function execute()
    {
        if ( isset($_SERVER['PATH_INFO']) )
        {
            $url = str_replace('-', '_', $_SERVER['PATH_INFO']);
            $url = explode('/', $url);

            $_tmp_params = [];
            $file = $url[1];
            unset($url[1]);

            foreach ( $url as $key => $value )
            {
                if ( empty( $value ) ) :
                    unset($url[$key]);
                else :
                    $_tmp_params[] = $value;
                endif;
            }

            switch ( $_SERVER['REQUEST_METHOD'] )
            {
                case "GET":     // Consult
                    $this->_crud = "get";
                    $this->_params = $_tmp_params;
                    break;

                case "POST":    // Insert
                    $this->_crud = "insert";

                    if ( file_get_contents("php://input") )
                    {
                        $tmp = json_decode(file_get_contents("php://input"), true);
                        $this->_params = $tmp;
                    }
                    else
                        $this->_params = $_POST;
                    break;

                case "PUT":     // Update
                    $this->_crud = "update";
                    break;

                case "DELETE":  // Delete
                    $this->_crud = "delete";
                    break;

                default:        // Unknown
                    $this->_crud = "unknown";
                    break;
            }

            $route = PATH_CLASSES . ucwords($file) . CLASS_PHP;

            if ( file_exists($route) )
            {
                $class = ucwords( str_replace(' ', '_', $file) );

                require_once $route;
                $class = "\\Hackaton\\classes\\" . $class;
                $class = new $class( $this->_crud, $this->_params );

                $response = $class->response();

                $this->response($response);
            }
            else
                $this->response(false, 404, "404 Not found");
        }
        else
            $this->response(false, 404, "404 Not found");
    }

    private function response ( $data = "", $code = 200, $status = "OK", $message = "" )
    {
        http_response_code( $code );

        $argv = [
            "status" => $status
        ];

        if ( !empty( $data ) )
            $argv['data'] = $data;

        if ( !empty( $message ) )
            $argv['message'] = $message;

        echo json_encode($argv, JSON_PRETTY_PRINT);
    }
}

$api = new API();
echo $api->execute();

<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require_once './vendor/autoload.php';
require "./clases/verificadora.php";

$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;

$app = new \Slim\App(["settings" => $config]);

$app->get('[/]', function (Request $request, Response $response) {    
    $response->getBody()->write("GET => Bienvenido!!! a SlimFramework");
    return $response;

});

$app->post('[/]', function (Request $request, Response $response) {   
    $response->getBody()->write("POST => Bienvenido!!! a SlimFramework");
    return $response;

});

$app->put('[/]', function (Request $request, Response $response) {  
    $response->getBody()->write("PUT => Bienvenido!!! a SlimFramework");
    return $response;

});

$app->delete('[/]', function (Request $request, Response $response) {  
    $response->getBody()->write("DELETE => Bienvenido!!! a SlimFramework");
    return $response;

});

/********************************************************************************************* */
$app->group('/credenciales', function () {

    $this->get('/', function ($request, $response, $args) {
        $response->getBody()->write("grupo credenciales GET");
    });
 
    $this->post('/', function ($request, $response, $args) {      
        $response->getBody()->write("grupo credenciales POST");
    });
     /* AGREGO MIDDLEWARE AL GRUPO*/ 
})->add(function($request,$response, $next){
    if($request->isGet()) 
    {
        $response=$next($request,$response);
    }
    else
    {
        $datos=$request->getParsedBody();
        $response->getBody()->write("Verificando credenciales....\n");
        if($datos["tipo"]=="administrador")
        {
            $response->getBody()->write("Perfil ADMINISTRADOR nombre: ".$datos["nombre"]."\n");
            $response=$next($request,$response);
        }
        else
        {
            $response->getBody()->write("NO TIENE PERMISOS..");
        }
    }
    return $response;
});


/************************          MIDDLEWARE POO            ******************************** */

$app->group('/credenciales/POO', function () {

    $this->get('/', function ($request, $response, $args) {
        $response->getBody()->write("grupo credenciales GET");
    });

    $this->post('/', function ($request, $response, $args) {
        $response->getBody()->write("grupo credenciales POST");
    })->add(\Verificadora::class. "::ExisteUsuarioBD");
    
})->add(\Verificadora::class. ":verificoTipo");


$app->group('/funciones/POO', function () {

    $this->get('/', function ($request, $response, $args) {
        $response->getBody()->write("grupo credenciales GET");
    });

    $this->post('/', function ($request, $response, $args) {
        $response->getBody()->write("grupo credenciales POST");
    });
    
})->add(\Verificadora::class. ":metodos");

$app->run();


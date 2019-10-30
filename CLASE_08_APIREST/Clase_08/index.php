<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require_once './vendor/autoload.php';

$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;

/*
¡La primera línea es la más importante! A su vez en el modo de 
desarrollo para obtener información sobre los errores
 (sin él, Slim por lo menos registrar los errores por lo que si está utilizando
  el construido en PHP webserver, entonces usted verá en la salida de la consola 
  que es útil).

  La segunda línea permite al servidor web establecer el encabezado Content-Length, 
  lo que hace que Slim se comporte de manera más predecible.
*/

//*********************************************************************************************//
//INICIALIZO EL APIREST
//*********************************************************************************************//
$app = new \Slim\App(["settings" => $config]);

//*********************************************************************************************//
//CONFIGURO LOS VERBOS
//*********************************************************************************************//
$app->get('[/]', function (Request $request, Response $response) {    
    $response->getBody()->write("GET => Bienvenido!!! a SlimFramework");
    return $response;

});

//*********************************************************************************************//
//COMPLETAR POST, PUT Y DELETE (CON LA MISMA FUNCIONALIDAD DEL GET)
//*********************************************************************************************//
$app->post('[/]', function (Request $request, Response $response) {    
    $response->getBody()->write("POST => Bienvenido!!! a SlimFramework");
    return $response;

});

$app->put('[/]', function (Request $request, Response $response) {    
    $response->getBody()->write("PUT => Bienvenido!!! a SlimFramework");
    return $response;

});

$app->delete('[/]', function (Request $request, Response $response) {    
    $response->getBody()->write("Delete => Bienvenido!!! a SlimFramework");
    return $response;

});

//EN EL POSTMAN, DEBEMOS COLOCAR:  http://localhost/Clase_07/index.php o http://localhost/Clase_07/index.php/ (La barra / al final es opcional, podemos o no colocarla)

//ES NECESARIO COLOCAR EL NOMBRE DE LA PAGINA DE INICIO PARA QUE FUNCIONE BIEN 
//(si hacemos http://localhost/Clase_07 nada mas, ira al metodo Get siempre por mas que coloquemos un verbo que nunca usamos)
//(si hacemos http://localhost/Clase_07/ con la barra, funciona bien)

//*********************************************************************************************//
//CON PARAMETRO REQUERIDO
//*********************************************************************************************//
$app->get('/parametros/{nombre}', function($request, $response, $args){
    $nombre = $args['nombre'];
    $response->getBody()->write("Su nombre es: $nombre");

    return $response;
});

//EN EL POSTMAN, DEBEMOS COLOCAR:  http://localhost/Clase_07/index.php/parametros/Gina PARA QUE FUNCIONE, EN CASO DE NO COLOCAR UN VALOR, 
//POR EJEMPLO SI HACEMOS: http://localhost/Clase_07/index.php/parametros/, TIRA ERROR, NO ENCUENTRA AL VERBO, YA QUE EL PARAMETRO ES REQUERIDO

//*********************************************************************************************//
//CON PARAMETRO REQUERIDO Y OTRO OPCIONAL
//*********************************************************************************************//
$app->get('/parametrosVarios/{nombre}[/{apellido}]', function(Request $request, Response $response, $args){

    $mensaje = "Bienvenido!! Como estás ". $args["nombre"];

    if(isset($args["apellido"])){
        $mensaje .= " " . $args["apellido"];
    }

    $mensaje .= "?";

    $response->getBody()->write($mensaje);

    return $response;

});

//POSTMAN PODREMOS COLOCAR OPCONALMENTE SOLO EL NOMBRE: http://localhost/Clase_07/index.php/parametrosVarios/Gina (COMO MINIMO Y OBLIGATORIO) O EL NOMBRE Y APELLIDO: http://localhost/Clase_07/index.php/parametrosVarios/Gina/Pagotto
//(si colocamos http://localhost/Clase_07/index.php/parametrosVarios/Gina/ con la barra tira error, no encuentra la ruta)

//AGRREGANDO EL .HTACCESS PODEMOS OBVIAR EL INDEX.PHP. EN EL POSTMAN: http://localhost/Clase_07/parametros/Gina/Pagotto


//*********************************************************************************************//
//GRUPOS CON JSON
//*********************************************************************************************//
$app->group('/json', function(){
/*
    $this->post('/', function(Request $request, Response $response){

        return var_dump($request->getParsedBody());

    });
*/
    //EN EL POSTMAN COLOCAMOS EL METODO POST, Y LA RUTA: http://localhost/Clase_07/json/
    //YA NO PASAMOS LOS VALORES POR LA URL, SINO QUE AHORA LO PASAMOS POR EL BODY O CUERPO DE LA PETICION (FORM-DATA) INGRESAMOS CUANTOS PARES DE CLAVE/VALOR QUERRAMOS
    //ESTOS VALORES LOS RECUPERA CON EL getParsedBody() Y LOS TRANSFORMA EN UN ARRAY ASOCIATIVO, ESTO MUESTRA EL VAR_DUMP:
    //array(3) { ["nombre"]=> string(6) "Flavia" ["apellido"]=> string(6) "Garcia" ["edad"]=> string(2) "33" }

    $this->get('/', function(Request $request, Response $response){

        $ArrayDeParametros = $request->getParsedBody();

        $objeto= new stdclass();
        $objeto->nombre=$ArrayDeParametros['nombre'];
        $objeto->apellido=$ArrayDeParametros['apellido'];

        return $response->withJson($objeto, 200);
    });

    ////EN EL POSTMAN COLOCAMOS EL METODO GET, Y LA RUTA: http://localhost/Clase_07/json/
    //PASAMOS POR EL BODY LOS VALORES DE NOMBRE Y APELLIDO (RESPETANDO QUE LAS KEYS EN EL POSTAMAN SE LLAMEN IGUAL QUE LOS NAMES O INDICES DEL ARRAY)
    //ESTOS VALORES LOS RECUPERA CON EL getParsedBody() Y LOS TRANSFORMA EN UN ARRAY ASOCIATIVO, 
    //LUEGO CADA ATRIBUTO DEL ARRAY LO TRANSFORMAMAOS EN UN OBJETO Y ESE OBJETO LO CONVERTIMOS A FORMATO JSON, LA RESPUESTA SERA:
    //{"nombre":"Gina","apellido":"Pagotto"}

    $this->delete('/', function(Request $request, Response $response){

        //recibo del Postman la clave: json y el valor {"nombre":"Gina","apellido":"Pagotto"} o sea un Json
        $arrayJson = $request->getParsedBody();

        //transformo el json a un array asociativo
        $json = json_decode($arrayJson['json']);

        //invierto los valores de nombre y apellido
        $nombre = $json->nombre;
        $json->nombre = $json->apellido;
        $json->apellido = $nombre;

        //transformo nuevamente el array en un json y muestro
        $retornoJson = $response->withJson($json, 200);

        return $retornoJson;
    });

    //EN EL POSTMAN ELIJO EL METODO DELETE Y EN LA RUTA: http://localhost/Clase_07/json/
    //PASAMOS DENTRO DEL BODY (x-www-form-urlencoded, el form-data no anda) LA CLAVE json Y COMO VALOR UN JSON: {"nombre":"Gina","apellido":"Pagotto"}
    //NOS DEVUELVE UN JSON PERO CON LOS VALORES INVERTIDOS:
    //{"nombre":"Pagotto","apellido":"Gina"}

    //*********************************************************************************************//
    //TRAER UNA IMAGEN
    //*********************************************************************************************//
    $this->post('/', function(Request $request, Response $response){

        //recibo del Postman el nombre y el apellido
        $datos = $request->getParsedBody();

        //recibo del postman la imagen (para eso cambiamos dentro de Key, el text por el file)
        $archivos = $request->getUploadedFiles();

        //Creo un objeto, y le paso los valores que ingresamos
        $nombre = $datos['nombre'];
        $apellido = $datos['apellido'];

        //Elegimos el directorio donde se guardara la foto y cambiamos el nombre de la foto 
        //(getClientFilename TAMBIEN DEVUELVE LA EXTENSION, ERRORRRRRRRRRRRRRRRRRRRRRRRRRRRRR VER COMO SACARLA)
        $destino="./fotos/";
        $nombreAnterior = $archivos['foto']->getClientFilename();    
        $extension = explode(".", $nombreAnterior);
        $destino .= $nombreAnterior. "." .date("h-i-s_j-m-y"). "." . $extension[1];
        $archivos['foto']->moveTo($destino);

        //Mostramos la ruta de la foto
        return $response->withJson($destino, 200);
    });

    //SOLO FUNCIONA CON EL METODO POST (CON PUT NO ANDA)
    //EN EL POSTMAN ELIJO EL METODO POST Y EN LA RUTA: http://localhost/Clase_07/json/
    //PASAMOS DENTRO DEL BODY (form-data) LAS CLAVES nombre, apellido y foto (file, no text) Y SUS VALORES
    //NOS DEVUELVE SOLO EL PATH Y EL NOMBRE NUEVO DE LA FOTO (ADEMAS DE AGREGAR LA MISMA EN EL DIRECTORIO):
    //"./fotos/Chrysanthemum.jpg.25-10-19.jpg"

});

//Si esto no lo colocamos, ningun verbo se ejecuta, se lanza la aplicacion (conviene hacerlo al final, luego de los verbos)
$app->run();

?>
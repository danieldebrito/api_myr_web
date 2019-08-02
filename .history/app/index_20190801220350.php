<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../composer/vendor/autoload.php';
require './AccesoDatos.php';

///////////////////   ENTITIES  ///////////
require './entities/articulo/articuloApi.php';

$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;

$app = new \Slim\App(["settings" => $config]);

$app->get("/", function() {
  echo "
  <p style='font-size:50px;'>Hola mundo desde api_meyro_web_test</p> 
  <br> <br> 
  <p style='font-family:courier;'>Conexion ok con la API.</p>
  ";
});

$app->group('/articulos', function () {
  $this->get('/', \articuloApi::class . ':readAllApi');
  $this->get('/{id_articulo}', \articuloApi::class . ':readApi');
  $this->post('/', \articuloApi::class . ':createApi');
  $this->delete('/{id_articulo}[/]', \articuloApi::class . ':deleteApi');
  $this->post('/update', \articuloApi::class . ':updateApi');
});



// cors habilitadas
$app->add(function ($req, $res, $next) {
  $response = $next($req, $res);
  return $response
          ->withHeader('Access-Control-Allow-Origin', 'http://localhost:4200')
          ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
          ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
});

$app->run();
<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../composer/vendor/autoload.php';
require './AccesoDatos.php';

/////////////////////////////   entities  //////////////////////////////////
//-----------------------------------------------------------------------//
require './entities/_articulos/articulo/articuloApi.php';
require './entities/_articulos/aplicacion/aplicacionApi.php';
require './entities/_articulos/art_mar_mod_mot/art_mar_mod_motApi.php';
require './entities/_articulos/producto/productoApi.php';
//------------------------------------------------------------------------//
require './entities/_clientes/cliente/clienteApi.php';
require './entities/_clientes/cliente_sucursal/cliente_sucursalApi.php';
require './entities/_clientes/expreso/expresoApi.php';
require './entities/_clientes/pedido/pedidoApi.php';
require './entities/_clientes/pedido_detalle/pedido_detalleApi.php';
//-----------------------------------------------------------------------//
require './entities/usuario/userApi.php';
//-----------------------------------------------------------------------//


$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;

$app = new \Slim\App(["settings" => $config]);

$app->get("/", function() {
  echo "
  <p style='font-size:50px;'>Hola mundo desde api_meyro_web_test</p> 
  <br> <br> 
  <p style='font-family:courier;'>Conexion ok con la API.</p>

  http://localhost/api_myr_web/app/
  ";
});

$app->group('/aplicaciones', function () {
  $this->get('/', \aplicacionApi::class . ':readAllApi');
  $this->get('/{id_aplicacion}', \aplicacionApi::class . ':readApi');
  $this->post('/', \aplicacionApi::class . ':createApi');
  $this->delete('/{id_aplicacion}[/]', \aplicacionApi::class . ':deleteApi');
  $this->post('/update', \aplicacionApi::class . ':updateApi');
});

$app->group('/articulos', function () {
  $this->get('/', \articuloApi::class . ':readAllApi');
  $this->get('/{id_articulo}', \articuloApi::class . ':readApi');
  $this->post('/', \articuloApi::class . ':createApi');
  $this->delete('/{id_articulo}[/]', \articuloApi::class . ':deleteApi');
  $this->post('/update', \articuloApi::class . ':updateApi');
});

$app->group('/art_mar_mod_mot', function () {
  $this->get('/', \art_mar_mod_motApi::class . ':readAllApi');
  $this->post('/filtrar[/]', \art_mar_mod_motApi::class . ':readParamsApi');
});

$app->group('/user', function () {
  $this->get('/', \userApi::class . ':readAllApi');
  $this->get('/{id_user}', \userApi::class . ':readApi');
  $this->post('/', \userApi::class . ':createApi');
  $this->delete('/{id_user}[/]', \userApi::class . ':deleteApi');
  $this->post('/update', \userApi::class . ':updateApi');

  $this->post('/login[/]', \userApi::class . ':LoginUser');

  /* body + raw  + 
    {
      "userName":"ddebrito",
      "pass":"1388"
    } */
});

$app->group('/clientes', function () {
  $this->get('/', \clienteApi::class . ':readAllApi');
  $this->get('/{id}', \clienteApi::class . ':readApi');
  $this->post('/', \clienteApi::class . ':createApi');
  $this->delete('/{id}[/]', \clienteApi::class . ':deleteApi');
  $this->post('/update', \clienteApi::class . ':updateApi');

  $this->post('/login[/]', \clienteApi::class . ':LoginCliente');
});

$app->group('/cliente_sucursales', function () {
  $this->get('/', \cliente_sucursalApi::class . ':readAllApi');
  $this->get('/{id}', \cliente_sucursalApi::class . ':readApi');
  $this->post('/', \cliente_sucursalApi::class . ':createApi');
  $this->delete('/{id}[/]', \cliente_sucursalApi::class . ':deleteApi');
  $this->post('/update', \cliente_sucursalApi::class . ':updateApi');
});

$app->group('/expresos', function () {
  $this->get('/', \expresoApi::class . ':readAllApi');
  $this->get('/{id}', \expresoApi::class . ':readApi');
  $this->post('/', \expresoApi::class . ':createApi');
  $this->delete('/{id}[/]', \expresoApi::class . ':deleteApi');
  $this->post('/update', \expresoApi::class . ':updateApi');
});

$app->group('/pedidos', function () {
  $this->get('/', \pedidoApi::class . ':readAllApi');
  $this->get('/{id}', \pedidoApi::class . ':readApi');
  $this->post('/', \pedidoApi::class . ':createApi');
  $this->delete('/{id}[/]', \pedidoApi::class . ':deleteApi');
  $this->post('/update', \pedidoApi::class . ':updateApi');
});

$app->group('/pedidos_detalle', function () {
  $this->get('/', \pedido_detalleApi::class . ':readAllApi');
  $this->get('/{id}', \pedido_detalleApi::class . ':readApi');
  $this->post('/', \pedido_detalleApi::class . ':createApi');
  $this->delete('/{id}[/]', \pedido_detalleApi::class . ':deleteApi');
  $this->post('/update', \pedido_detalleApi::class . ':updateApi');
});

$app->group('/productos', function () {
  $this->get('/', \productoApi::class . ':readAllApi');
  $this->get('/{id}', \productoApi::class . ':readApi');
  $this->post('/', \productoApi::class . ':createApi');
  $this->delete('/{id}[/]', \productoApi::class . ':deleteApi');
  $this->post('/update', \productoApi::class . ':updateApi');
});

$app->add(function ($req, $res, $next) {
  $response = $next($req, $res);
  return $response
    ->withHeader('Access-Control-Allow-Origin', 'http://localhost:4200')
    ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
    ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
});

$app->run();
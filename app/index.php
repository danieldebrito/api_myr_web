<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../composer/vendor/autoload.php';
require './AccesoDatos.php';

///////////////////   MIDDLEWARE  ///////////
require_once './middleware/MWparaCORS.php';

/////////////////////////////   entities  /////////////////////////////////
//-----------------------------------------------------------------------//
require './entities/_articulos/articulo/articuloApi.php';
require './entities/_articulos/aplicacion/aplicacionApi.php';
require './entities/_articulos/art_mar_mod_mot/art_mar_mod_motApi.php';
require './entities/_articulos/producto/productoApi.php';
require './entities/_articulos/marca/marcaApi.php';
require './entities/_articulos/linea/lineaApi.php';
require './entities/_articulos/combustible/combustibleApi.php';
//------------------------------------------------------------------------//
require './entities/_clientes/cliente/clienteApi.php';
require './entities/_clientes/cliente_sucursal/cliente_sucursalApi.php';
require './entities/_clientes/expreso/expresoApi.php';
require './entities/_clientes/pedido/pedidoApi.php';
require './entities/_clientes/pedido_item/pedido_itemApi.php';
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

  http://localhost/api_myr_web/app/index.php/
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
})->add(\MWparaCORS::class . ':HabilitarCORSTodos');

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

  $this->get('/abierto/{id}[/]', \pedidoApi::class . ':traePedidoAbiertoApi');
  $this->get('/cliente/{id}[/]', \pedidoApi::class . ':readAllClienteApi');

});

$app->group('/pedidos_item', function () {
  $this->get('/', \pedido_itemApi::class . ':readAllApi');
  $this->get('/{id}', \pedido_itemApi::class . ':readApi');
  $this->post('/', \pedido_itemApi::class . ':createApi');
  $this->delete('/{id}[/]', \pedido_itemApi::class . ':deleteApi');
  $this->post('/update', \pedido_itemApi::class . ':updateApi');

  $this->get('/cliente/{id}[/]', \pedido_itemApi::class . ':readAllClienteApi');
  $this->get('/clienteAbierto/{id}[/]', \pedido_itemApi::class . ':readAllClienteAbiertoApi');
  $this->get('/updateItems[/]', \pedido_itemApi::class . ':updateItemsApi');
});

$app->group('/productos', function () {
  $this->get('/', \productoApi::class . ':readAllApi');
  $this->get('/{id}', \productoApi::class . ':readApi');
  $this->post('/', \productoApi::class . ':createApi');
  $this->delete('/{id}[/]', \productoApi::class . ':deleteApi');
  $this->post('/update', \productoApi::class . ':updateApi');
});

$app->group('/marcas', function () {
  $this->get('/', \marcaApi::class . ':readAllApi');
  $this->get('/{id}', \marcaApi::class . ':readApi');
  $this->post('/', \marcaApi::class . ':createApi');
  $this->delete('/{id}[/]', \marcaApi::class . ':deleteApi');
  $this->post('/update', \marcaApi::class . ':updateApi');
});

$app->group('/lineas', function () {
  $this->get('/', \lineaApi::class . ':readAllApi');
  $this->get('/{id}', \lineaApi::class . ':readApi');
  $this->post('/', \lineaApi::class . ':createApi');
  $this->delete('/{id}[/]', \lineaApi::class . ':deleteApi');
  $this->post('/update', \lineaApi::class . ':updateApi');
});

$app->group('/combustibles', function () {
  $this->get('/', \combustibleApi::class . ':readAllApi');
  $this->get('/{id}', \combustibleApi::class . ':readApi');
  $this->post('/', \combustibleApi::class . ':createApi');
  $this->delete('/{id}[/]', \combustibleApi::class . ':deleteApi');
  $this->post('/update', \combustibleApi::class . ':updateApi');
});

$app->add(function ($req, $res, $next) {
  $response = $next($req, $res);
  return $response
    ->withHeader('Access-Control-Allow-Origin', 'http://localhost:4200')
    ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
    ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
});

$app->run();
<?php
require_once 'pedido.php';
require_once 'IApiCRUD.php';

class pedidoApi extends pedido implements IApiCRUD {
	
	public function readAllApi($request, $response, $args) {
		$all=pedido::readAll();
	   	$response = $response->withJson($all, 200);  
		  
		return $response;
	}

	public function readApi($request, $response, $args) {
		$id=$args['id'];
		$art=pedido::read($id);
		$newResponse = $response->withJson($art, 200);  
		
		return $newResponse;
	}

	public function CreateApi($request, $response, $args) {
		$ArrayDeParametros = $request->getParsedBody();

	  	$entity = new pedido();
		// $entity->id_pedido = $ArrayDeParametros['id_pedido'];
		$entity->idClienteSucursal = $ArrayDeParametros['idClienteSucursal'];
		$entity->idCliente = $ArrayDeParametros['idCliente'];
		$entity->idExpreso = $ArrayDeParametros['idExpreso'];
	  	$entity->estado = $ArrayDeParametros['estado'];
		$entity->fecha = $ArrayDeParametros['fecha'];
		$entity->idDescuento = $ArrayDeParametros['idDescuento'];
		$entity->subtotalNeto = $ArrayDeParametros['subtotalNeto'];
	  	$entity->observaciones = $ArrayDeParametros['observaciones'];
		  
		$response = $entity->create();

	  	return $response;
	}

	public function updateApi($request, $response, $args)
    {
		$ArrayDeParametros = $request->getParsedBody();
		
		$entity = new pedido();
		$entity->idPedido = $ArrayDeParametros['idPedido'];
		$entity->idClienteSucursal = $ArrayDeParametros['idClienteSucursal'];
	  	$entity->idCliente = $ArrayDeParametros['idCliente'];
	 	$entity->idExpreso = $ArrayDeParametros['idExpreso'];
		$entity->estado = $ArrayDeParametros['estado'];
		$entity->fecha = $ArrayDeParametros['fecha'];
		$entity->idDescuento = $ArrayDeParametros['idDescuento'];
		$entity->subtotalNeto = $ArrayDeParametros['subtotalNeto'];
		$entity->observaciones = $ArrayDeParametros['observaciones'];

		$resultado = $entity->update();
		
        $objDelaRespuesta = new stdclass();
		$objDelaRespuesta->resultado = $resultado;
		
        return $response->withJson($objDelaRespuesta, 200);
	}
	
	public function deleteApi($request, $response, $args){
        $id = $args["id"];
        $respuesta = pedido::delete($id);
        $newResponse = $response->withJson($respuesta, 200);
        return $newResponse;
	}

	public function readAllClienteApi($request, $response, $args) {
		$id=$args['id'];
		$art=pedido::readAllCliente($id);
		$newResponse = $response->withJson($art, 200);  
		
		return $newResponse;
	}

	public function readAllClienteAbiertoApi($request, $response, $args) {
		$id=$args['id'];
		$art=pedido::readAllCliente($id);
		$newResponse = $response->withJson($art, 200);  
		
		return $newResponse;
	}

}




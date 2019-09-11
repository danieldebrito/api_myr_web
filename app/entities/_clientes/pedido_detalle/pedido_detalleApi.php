<?php
require_once 'pedido_detalle.php';
require_once 'IApiCRUD.php';

class pedido_detalleApi extends pedido_detalle implements IApiCRUD {
	
	public function readAllApi($request, $response, $args) {
		$all=pedido_detalle::readAll();
	   	$response = $response->withJson($all, 200);  
		  
		return $response;
	}

	public function readApi($request, $response, $args) {
		$id=$args['id'];
		$art=pedido_detalle::read($id);
		$newResponse = $response->withJson($art, 200);  
		
		return $newResponse;
	}

	public function CreateApi($request, $response, $args) {
		$ArrayDeParametros = $request->getParsedBody();

		$entity = new pedido_detalle();
		//$entity->id_pedido_detalle = $ArrayDeParametros['id_pedido_detalle'];
	  	$entity->id_pedido = $ArrayDeParametros['id_pedido'];
	  	$entity->id_articulo = $ArrayDeParametros['id_articulo'];
		$entity->cantidad = $ArrayDeParametros['cantidad'];
		  
		$response = $entity->create();

	  	return $response;
	}

	public function updateApi($request, $response, $args)
    {
		$ArrayDeParametros = $request->getParsedBody();
		
		$entity = new pedido_detalle();
		$entity->id_pedido_detalle = $ArrayDeParametros['id_pedido_detalle'];
	  	$entity->id_pedido = $ArrayDeParametros['id_pedido'];
	  	$entity->id_articulo = $ArrayDeParametros['id_articulo'];
		$entity->cantidad = $ArrayDeParametros['cantidad'];

		$resultado = $entity->update();
		
        $objDelaRespuesta = new stdclass();
		$objDelaRespuesta->resultado = $resultado;
		
        return $response->withJson($objDelaRespuesta, 200);
	}
	
	public function deleteApi($request, $response, $args){
        $id = $args["id"];
        $respuesta = pedido_detalle::delete($id);
        $newResponse = $response->withJson($respuesta, 200);
        return $newResponse;
    }
}
?>





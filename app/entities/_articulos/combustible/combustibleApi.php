<?php
require_once 'combustible.php';
require_once 'IApiCRUD.php';

class combustibleApi extends combustible implements IApiCRUD {
	
	public function readAllApi($request, $response, $args) {
		$all=combustible::readAll();
	   	$response = $response->withJson($all, 200);  
		  
		return $response;
	}

	public function readApi($request, $response, $args) {
		$id=$args['id'];
		$art=combustible::read($id);
		$newResponse = $response->withJson($art, 200);  
		
		return $newResponse;
	}
	
	public function CreateApi($request, $response, $args) {
		$ArrayDeParametros = $request->getParsedBody();

		$entity = new combustible();
		$entity->id_combustible = $ArrayDeParametros['id_combustible'];
		$entity->combustible = $ArrayDeParametros['combustible'];
		$response = $entity->create();

	  	return $response;
	}

	public function updateApi($request, $response, $args)
    {
		$ArrayDeParametros = $request->getParsedBody();
		
		$entity = new combustible();
		$entity->id_combustible = $ArrayDeParametros['id_combustible'];
		$entity->combustible = $ArrayDeParametros['combustible'];
		$resultado = $entity->update();
		
        $objDelaRespuesta = new stdclass();
		$objDelaRespuesta->resultado = $resultado;
		
        return $response->withJson($objDelaRespuesta, 200);
	}
	
	public function deleteApi($request, $response, $args){
        $id = $args["id"];
		$respuesta = combustible::delete($id);
		
        $newResponse = $response->withJson($respuesta, 200);
        return $newResponse;
    }
}
?>





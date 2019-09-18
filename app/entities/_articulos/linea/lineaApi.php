<?php
require_once 'linea.php';
require_once 'IApiCRUD.php';

class lineaApi extends linea implements IApiCRUD {
	
	public function readAllApi($request, $response, $args) {
		$all=linea::readAll();
	   	$response = $response->withJson($all, 200);  
		  
		return $response;
	}

	public function readApi($request, $response, $args) {
		$id=$args['id'];
		$art=linea::read($id);
		$newResponse = $response->withJson($art, 200);  
		
		return $newResponse;
	}
	
	public function CreateApi($request, $response, $args) {
		$ArrayDeParametros = $request->getParsedBody();

		$entity = new linea();
		$entity->id_linea = $ArrayDeParametros['id_linea'];
		$entity->linea = $ArrayDeParametros['linea'];
		  
		$response = $entity->create();

	  	return $response;
	}

	public function updateApi($request, $response, $args)
    {
		$ArrayDeParametros = $request->getParsedBody();
		
		$entity = new linea();
		$entity->id_linea = $ArrayDeParametros['id_linea'];
		$entity->linea = $ArrayDeParametros['linea'];
		$resultado = $entity->update();
		
        $objDelaRespuesta = new stdclass();
		$objDelaRespuesta->resultado = $resultado;
		
        return $response->withJson($objDelaRespuesta, 200);
	}
	
	public function deleteApi($request, $response, $args){
        $id = $args["id"];
		$respuesta = linea::delete($id);
		
        $newResponse = $response->withJson($respuesta, 200);
        return $newResponse;
    }
}
?>





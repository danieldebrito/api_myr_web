<?php
require_once 'cards.php';
// require_once 'IApiCRUD.php';

class cardsApi extends cards
{
    public function readAllApi($request, $response, $args)
    {
        $all = cards::readAll();
        $newResponse = $response->withJson($all, 200);

        return $newResponse;
    }

    public function readParamsApi ($request, $response, $args) {

		$ArrayDeParametros = $request->getParsedBody();

		$id_linea=$ArrayDeParametros['linea'];
		$id_marca=$ArrayDeParametros['marca'];
        $id_combustible=$ArrayDeParametros['combustible'];
        $motor=$ArrayDeParametros['motor'];
        $modelo=$ArrayDeParametros['modelo'];
        $cilindrada=$ArrayDeParametros['cilindrada'];
        $competicion=$ArrayDeParametros['competicion'];
        $id_producto=$ArrayDeParametros['producto'];
        $id_aplicacion=$ArrayDeParametros['aplicacion'];
		
		$all=cards::readParams(
			$id_linea, 
			$id_marca,
            $id_combustible,
            $motor,
            $modelo,
            $cilindrada,
            $competicion,
            $id_producto,
            $id_aplicacion
			);
		$newResponse = $response->withJson($all, 200);

		return $newResponse;
    }
    
	public function readByIdApi($request, $response, $args) {
		$id=$args['id_articulo'];
		$arts=cards::readById($id);
		$newResponse = $response->withJson($arts, 200);  
		
		return $newResponse;
    }
    
    public function buscarPorFraseApi($request, $response, $args) {
        $frase=$args['frase'];
        /*
		$arts=cards::buscarPorFrase($frase);
		$newResponse = $response->withJson($arts, 200);  
		
		return $newResponse;*/
    }
}

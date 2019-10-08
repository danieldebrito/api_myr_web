<?php
require_once 'art_mar_mod_mot.php';
// require_once 'IApiCRUD.php';

class art_mar_mod_motApi extends art_mar_mod_mot
{
    public function readAllApi($request, $response, $args)
    {
        $all = art_mar_mod_mot::readAll();
        $newResponse = $response->withJson($all, 200);

        return $newResponse;
    }

    public function readParamsApi ($request, $response, $args) {

		$ArrayDeParametros = $request->getParsedBody();

		$id_linea=$ArrayDeParametros['id_linea'];
		$id_marca=$ArrayDeParametros['id_marca'];
        $id_combustible=$ArrayDeParametros['id_combustible'];
        $motor=$ArrayDeParametros['motor'];
        $modelo=$ArrayDeParametros['modelo'];
        $cilindrada=$ArrayDeParametros['cilindrada'];
        $competicion=$ArrayDeParametros['competicion'];
        $id_producto=$ArrayDeParametros['id_producto'];
        $id_aplicacion=$ArrayDeParametros['id_aplicacion'];
		
		$all=art_mar_mod_mot::readParams(
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
}

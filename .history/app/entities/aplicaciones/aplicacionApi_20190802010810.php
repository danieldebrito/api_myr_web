<?php
require_once 'aplicacion.php';
require_once 'IApiCRUD.php';

class aplicacionApi extends aplicacion implements IApiCRUD
{
    public function readAllApi($request, $response, $args)
    {
        $all = aplicacion::readAll();
        $newResponse = $response->withJson($all, 200);
        return $newResponse;
    }

    public function readApi($request, $response, $args)
    {
        $id = $args['id_aplicacion'];
        $Ret = aplicacion::read($id);
        $newResponse = $response->withJson($Ret, 200);
        return $newResponse;
    }

    public function CreateApi($request, $response, $args)
    {
        $ArrayDeParametros = $request->getParsedBody();

        $entity = new aplicacion();
        $entity->id_aplicacion = $ArrayDeParametros['id_aplicacion'];
        $entity->codigo_app = $ArrayDeParametros['codigo_app'];
        $entity->aplicacion = $ArrayDeParametros['aplicacion'];
        $entity->activo = $ArrayDeParametros['activo'];

        $entity->create();
        $response->getBody()->write("true");

        return $response;
    }

    public function deleteApi($request, $response, $args)
    {
        $id = $args["id_aplicacion"];
        $respuesta = aplicacion::delete($id);
        $newResponse = $response->withJson($respuesta, 200);
        return $newResponse;
    }

    public function updateApi($request, $response, $args)
    {
        $ArrayDeParametros = $request->getParsedBody();
        $entity = new aplicacion();

        $entity->id_aplicacion = $ArrayDeParametros['id_aplicacion'];
        $entity->codigo_app = $ArrayDeParametros['codigo_app'];
        $entity->aplicacion = $ArrayDeParametros['aplicacion'];
        $entity->activo = $ArrayDeParametros['activo'];

        $resultado = $entity->update();
        $objDelaRespuesta = new stdclass();
        $objDelaRespuesta->resultado = $resultado;
        
        return $response->withJson($objDelaRespuesta, 200);
    }
}

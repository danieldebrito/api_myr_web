<?php
require_once 'usuario.php';
require_once 'IApiCRUD.php';

class usuarioApi extends usuario implements IApiCRUD
{
    public function readAllApi($request, $response, $args)
    {
        $all = mesa::readAll();
        $newResponse = $response->withJson($all, 200);
        return $newResponse;
    }

    public function readApi($request, $response, $args)
    {
        $id = $args['id_mesa'];
        $Ret = mesa::read($id);
        $newResponse = $response->withJson($Ret, 200);
        return $newResponse;
    }

    public function CreateApi($request, $response, $args)
    {
        $ArrayDeParametros = $request->getParsedBody();

        $id_mesa = $ArrayDeParametros['id_mesa'];
        $id_estado_mesa = $ArrayDeParametros['id_estado_mesa'];
        $url_foto = $ArrayDeParametros['url_foto'];
        $cant_comensales = $ArrayDeParametros['cant_comensales'];

        $entity = new mesa();
        $entity->id_mesa = $id_mesa;
        $entity->id_estado_mesa = $id_estado_mesa;
        $entity->url_foto = $url_foto;
        $entity->cant_comensales = $cant_comensales;

        $entity->create();
        $response->getBody()->write("true");

        return $response;
    }

    public function deleteApi($request, $response, $args)
    {
        $id = $args["id_mesa"];
        $respuesta = mesa::delete($id);
        $newResponse = $response->withJson($respuesta, 200);
        return $newResponse;
    }

    public function updateApi($request, $response, $args)
    {
        $ArrayDeParametros = $request->getParsedBody();
        $entity = new mesa();
        $entity->id_mesa = $ArrayDeParametros['id_mesa'];
        $entity->id_estado_mesa = $ArrayDeParametros['id_estado_mesa'];
        $entity->url_foto = $ArrayDeParametros['url_foto'];
        $entity->cant_comensales = $ArrayDeParametros['cant_comensales'];

        $resultado = $entity->update();
        $objDelaRespuesta = new stdclass();
        $objDelaRespuesta->resultado = $resultado;
        return $response->withJson($objDelaRespuesta, 200);
    }
}

    /*
        usuario
        usuarios

        id_usuario;
        nombre;
        apellido;
        usuario;
        pass;
        estado;
        rol;
    */


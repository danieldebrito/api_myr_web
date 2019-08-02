<?php
require_once 'articulo.php';
require_once 'IApiCRUD.php';

class articuloApi extends articulo implements IApiCRUD
{
    public function readAllApi($request, $response, $args)
    {
        $all = articulo::readAll();
        $newResponse = $response->withJson($all, 200);
        return $newResponse;
    }

    public function readApi($request, $response, $args)
    {
        $id = $args['id_articulo'];
        $Ret = articulo::read($id);
        $newResponse = $response->withJson($Ret, 200);
        return $newResponse;
    }

    public function CreateApi($request, $response, $args)
    {
        $ArrayDeParametros = $request->getParsedBody();

        $entity = new articulo();
        $entity->id_articulo = $ArrayDeParametros['id_articulo'];
        $entity->id_producto = $ArrayDeParametros['id_producto'];
        $entity->id_aplicacion = $ArrayDeParametros['id_aplicacion'];
        $entity->id_material = $ArrayDeParametros['id_material'];
        $entity->descripcion_corta = $ArrayDeParametros['descripcion_corta'];
        $entity->no_comercializable = $ArrayDeParametros['no_comercializable'];
        $entity->no_muestra_item = $ArrayDeParametros['no_muestra_item'];
        $entity->stock = $ArrayDeParametros['stock'];
        $entity->unid_pack_juego_tapa = $ArrayDeParametros['unid_pack_juego_tapa'];
        $entity->cant_kit = $ArrayDeParametros['cant_kit'];
        $entity->pack_venta = $ArrayDeParametros['pack_venta'];
        $entity->precio_lista = $ArrayDeParametros['precio_lista'];
        $entity->img_peq_url = $ArrayDeParametros['img_peq_url'];
        $entity->img_gde_url = $ArrayDeParametros['img_gde_url'];
        $entity->img_envase_url = $ArrayDeParametros['img_envase_url'];
        $entity->pdf_catalogo = $ArrayDeParametros['pdf_catalogo'];
        $entity->prioridad_busquedas = $ArrayDeParametros['prioridad_busquedas'];
        $entity->en_promocion = $ArrayDeParametros['en_promocion'];
        $entity->nuevo_lanzamiento = $ArrayDeParametros['nuevo_lanzamiento'];
        $entity->origen = $ArrayDeParametros['origen'];

        $entity->create();
        $response->getBody()->write("true");

        return $response;
    }

    public function deleteApi($request, $response, $args)
    {
        $id = $args["id_articulo"];
        $respuesta = articulo::delete($id);
        $newResponse = $response->withJson($respuesta, 200);
        return $newResponse;
    }

    public function updateApi($request, $response, $args)
    {
        $ArrayDeParametros = $request->getParsedBody();
        $entity = new articulo();

        $entity->id_articulo = $ArrayDeParametros['id_articulo'];
        $entity->id_producto = $ArrayDeParametros['id_producto'];
        $entity->id_aplicacion = $ArrayDeParametros['id_aplicacion'];
        $entity->id_material = $ArrayDeParametros['id_material'];
        $entity->descripcion_corta = $ArrayDeParametros['descripcion_corta'];
        $entity->no_comercializable = $ArrayDeParametros['no_comercializable'];
        $entity->no_muestra_item = $ArrayDeParametros['no_muestra_item'];
        $entity->stock = $ArrayDeParametros['stock'];
        $entity->unid_pack_juego_tapa = $ArrayDeParametros['unid_pack_juego_tapa'];
        $entity->cant_kit = $ArrayDeParametros['cant_kit'];
        $entity->pack_venta = $ArrayDeParametros['pack_venta'];
        $entity->precio_lista = $ArrayDeParametros['precio_lista'];
        $entity->img_peq_url = $ArrayDeParametros['img_peq_url'];
        $entity->img_gde_url = $ArrayDeParametros['img_gde_url'];
        $entity->img_envase_url = $ArrayDeParametros['img_envase_url'];
        $entity->pdf_catalogo = $ArrayDeParametros['pdf_catalogo'];
        $entity->prioridad_busquedas = $ArrayDeParametros['prioridad_busquedas'];
        $entity->en_promocion = $ArrayDeParametros['en_promocion'];
        $entity->nuevo_lanzamiento = $ArrayDeParametros['nuevo_lanzamiento'];
        $entity->origen = $ArrayDeParametros['origen'];

        $resultado = $entity->update();
        $objDelaRespuesta = new stdclass();
        $objDelaRespuesta->resultado = $resultado;
        
        return $response->withJson($objDelaRespuesta, 200);
    }
}

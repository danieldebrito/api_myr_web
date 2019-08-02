<?php
require_once 'articulos.php';
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

        $id_articulo = $ArrayDeParametros['id_articulo'];
        $id_producto = $ArrayDeParametros['id_producto'];
        $id_aplicacion = $ArrayDeParametros['id_aplicacion'];
        $id_material = $ArrayDeParametros['id_material'];
        $descripcion_corta = $ArrayDeParametros['descripcion_corta'];
        $no_comercializable = $ArrayDeParametros['no_comercializable'];
        $no_muestra_item = $ArrayDeParametros['no_muestra_item'];
        $stock = $ArrayDeParametros['stock'];
        $unid_pack_juego_tapa = $ArrayDeParametros['unid_pack_juego_tapa'];
        $cant_kit = $ArrayDeParametros['cant_kit'];
        $pack_venta = $ArrayDeParametros['pack_venta'];
        $precio_lista = $ArrayDeParametros['precio_lista'];
        $img_peq_url = $ArrayDeParametros['img_peq_url'];
        $img_gde_url = $ArrayDeParametros['img_gde_url'];
        $img_envase_url = $ArrayDeParametros['img_envase_url'];
        $pdf_catalogo = $ArrayDeParametros['pdf_catalogo'];
        $prioridad_busquedas = $ArrayDeParametros['prioridad_busquedas'];
        $en_promocion = $ArrayDeParametros['en_promocion'];
        $nuevo_lanzamiento = $ArrayDeParametros['nuevo_lanzamiento'];
        $origen = $ArrayDeParametros['origen'];

        $entity = new producto();
        $entity->id_articulo = $id_articulo;
        $entity->id_producto = $id_producto;
        $entity->id_aplicacion = $id_aplicacion;
        $entity->id_material = $id_material;
        $entity->descripcion_corta = $descripcion_corta;
        $entity->no_comercializable = $no_comercializable;
        $entity->no_muestra_item = $no_muestra_item;
        $entity->stock = $stock;
        $entity->unid_pack_juego_tapa = $unid_pack_juego_tapa;
        $entity->cant_kit = $cant_kit;
        $entity->pack_venta = $pack_venta;
        $entity->precio_lista = $precio_lista;
        $entity->img_peq_url = $img_peq_url;
        $entity->img_gde_url = $img_gde_url;
        $entity->img_envase_url = $img_envase_url;
        $entity->pdf_catalogo = $pdf_catalogo;
        $entity->prioridad_busquedas = $prioridad_busquedas;
        $entity->en_promocion = $en_promocion;
        $entity->nuevo_lanzamiento = $nuevo_lanzamiento;
        $entity->origen = $origen;

        $entity->create();
        $response->getBody()->write("true");

        return $response;
    }

    public function deleteApi($request, $response, $args)
    {
        $id = $args["id_producto"];
        $respuesta = producto::delete($id);
        $newResponse = $response->withJson($respuesta, 200);
        return $newResponse;
    }

    public function updateApi($request, $response, $args)
    {
        $ArrayDeParametros = $request->getParsedBody();
        $entity = new producto();
        $entity->id_producto = $ArrayDeParametros['id_producto'];
        $entity->id_sector = $ArrayDeParametros['id_sector'];
        $entity->producto = $ArrayDeParametros['producto'];
        $entity->tiempo_preparacion = $ArrayDeParametros['tiempo_preparacion'];
        $entity->precio = $ArrayDeParametros['precio'];

        $resultado = $entity->update();
        $objDelaRespuesta = new stdclass();
        $objDelaRespuesta->resultado = $resultado;
        return $response->withJson($objDelaRespuesta, 200);
    }
}

<?php
class articulo
{
    public $id_articulo;
    public $id_producto;
    public $id_aplicacion;
    public $id_material;
    public $descripcion_corta;
    public $no_comercializable;
    public $no_muestra_item;
    public $stock;
    public $unid_pack_juego_tapa;
    public $cant_kit;
    public $pack_venta;
    public $precio_lista;
    public $img_peq_url;
    public $img_gde_url;
    public $img_envase_url;
    public $pdf_catalogo;
    public $prioridad_busquedas;
    public $en_promocion;
    public $nuevo_lanzamiento;
    public $origen;

    public static function readAll(){
        try {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            $consulta = $objetoAccesoDato->RetornarConsulta("
			SELECT * FROM `articulos` 
			");
            $consulta->execute();
            $ret = $consulta->fetchAll(PDO::FETCH_CLASS, "articulo");
        } catch (Exception $e) {
            $mensaje = $e->getMessage();
            $respuesta = array("Estado" => "ERROR", "Mensaje" => "$mensaje");
        } finally {
            return $ret;
        }
    }

    public static function read($id_articulo){
        try {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            $consulta = $objetoAccesoDato->RetornarConsulta("
			SELECT *
			FROM `articulos`
			WHERE `id_articulo` = '$id_articulo'
			");
            $consulta->execute();
            $ret = $consulta->fetchObject('articulo');
        } catch (Exception $e) {
            $mensaje = $e->getMessage();
            $respuesta = array("Estado" => "ERROR", "Mensaje" => "$mensaje");
        } finally {
            return $ret;
        }
    }

    public function create()
    {
        try {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            $consulta = $objetoAccesoDato->RetornarConsulta("
			INSERT INTO `articulos`
				(`id_articulo`,
				`id_producto`,
				`id_aplicacion`,
                `id_material`,
                `descripcion_corta`,
				`no_comercializable`,
                `no_muestra_item`,
                `stock`,
				`unid_pack_juego_tapa`,
                `cant_kit`,
                `pack_venta`,
				`precio_lista`,
                `img_peq_url`,
                `img_gde_url`,
                `img_envase_url`,
                `pdf_catalogo`,
                `prioridad_busquedas`,
                `en_promocion`,
                `nuevo_lanzamiento`,
                `origen`)
			VALUES (
				:id_articulo,
				:id_producto,
				:id_aplicacion,
                :id_material,
                :descripcion_corta,
				:no_comercializable,
				:no_muestra_item,
                :stock,
                :unid_pack_juego_tapa,
				:cant_kit,
				:pack_venta,
                :precio_lista,
                :img_peq_url,
				:img_gde_url,
				:img_envase_url,
                :pdf_catalogo,
                :prioridad_busquedas,
				:en_promocion,
				:nuevo_lanzamiento,
                :origen)
		");

            $consulta->bindValue(':id_articulo', $this->id_articulo, PDO::PARAM_STR);
            $consulta->bindValue(':id_producto', $this->id_producto, PDO::PARAM_STR);
            $consulta->bindValue(':id_aplicacion', $this->id_aplicacion, PDO::PARAM_STR);
            $consulta->bindValue(':id_material', $this->id_material, PDO::PARAM_INT);
            $consulta->bindValue(':descripcion_corta', $this->descripcion_corta, PDO::PARAM_STR);
            $consulta->bindValue(':no_comercializable', $this->no_comercializable, PDO::PARAM_INT);
            $consulta->bindValue(':no_muestra_item', $this->no_muestra_item, PDO::PARAM_INT);
            $consulta->bindValue(':stock', $this->stock, PDO::PARAM_STR);
            $consulta->bindValue(':unid_pack_juego_tapa', $this->unid_pack_juego_tapa, PDO::PARAM_STR);
            $consulta->bindValue(':cant_kit', $this->cant_kit, PDO::PARAM_STR);
            $consulta->bindValue(':pack_venta', $this->pack_venta, PDO::PARAM_STR);
            $consulta->bindValue(':precio_lista', $this->precio_lista, PDO::PARAM_STR);
            $consulta->bindValue(':img_peq_url', $this->img_peq_url, PDO::PARAM_STR);
            $consulta->bindValue(':img_gde_url', $this->img_gde_url, PDO::PARAM_STR);
            $consulta->bindValue(':img_envase_url', $this->img_envase_url, PDO::PARAM_STR);
            $consulta->bindValue(':pdf_catalogo', $this->pdf_catalogo, PDO::PARAM_STR);
            $consulta->bindValue(':prioridad_busquedas', $this->prioridad_busquedas, PDO::PARAM_STR);
            $consulta->bindValue(':en_promocion', $this->en_promocion, PDO::PARAM_STR);
            $consulta->bindValue(':nuevo_lanzamiento', $this->nuevo_lanzamiento, PDO::PARAM_STR);
            $consulta->bindValue(':origen', $this->origen, PDO::PARAM_STR);

            $consulta->execute();
        } catch (Exception $e) {
            $mensaje = $e->getMessage();
            $respuesta = array("Estado" => "ERROR", "Mensaje" => "$mensaje");
        } finally {
            return $objetoAccesoDato->RetornarUltimoIdInsertado();
        }
    }

    public static function delete($id_articulo){
        try {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            $consulta = $objetoAccesoDato->RetornarConsulta("
                DELETE FROM `articulos` 
                WHERE `id_articulo` = '$id_articulo'
            ");
            $consulta->bindValue(':id_articulo', $id_articulo, PDO::PARAM_STR);
            $consulta->execute();
            $respuesta = array("Estado" => true, "Mensaje" => "Eliminado Correctamente");

        } catch (Exception $e) {
            $mensaje = $e->getMessage();
            $respuesta = array("Estado" => false, "Mensaje" => "$mensaje");

        } finally {
            return $respuesta;
        }
    }

    public function update()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("
                UPDATE `articulos` 
                SET 
				`id_producto`=:id_producto, 
                `id_aplicacion`=:id_aplicacion, 
                `id_material`=:id_material,
                `descripcion_corta`=:descripcion_corta, 
                `no_comercializable`=:no_comercializable, 
                `no_muestra_item`=:no_muestra_item, 
                `stock`=:stock, 
                `unid_pack_juego_tapa`=:unid_pack_juego_tapa, 
                `cant_kit`=:cant_kit, 
                `pack_venta`=:pack_venta, 
                `precio_lista`=:precio_lista, 
                `img_peq_url`=:img_peq_url, 
                `img_gde_url`=:img_gde_url, 
                `img_envase_url`=:img_envase_url, 
                `pdf_catalogo`=:pdf_catalogo, 
                `prioridad_busquedas`=:prioridad_busquedas, 
                `en_promocion`=:en_promocion, 
                `nuevo_lanzamiento`=:nuevo_lanzamiento, 
                `origen`=:origen
                WHERE id_articulo=:id_articulo");
                
                $consulta->bindValue(':id_articulo', $this->id_articulo, PDO::PARAM_STR);
                $consulta->bindValue(':id_producto', $this->id_producto, PDO::PARAM_STR);
                $consulta->bindValue(':id_aplicacion', $this->id_aplicacion, PDO::PARAM_STR);
                $consulta->bindValue(':id_material', $this->id_material, PDO::PARAM_INT);
                $consulta->bindValue(':descripcion_corta', $this->descripcion_corta, PDO::PARAM_STR);
                $consulta->bindValue(':no_comercializable', $this->no_comercializable, PDO::PARAM_INT);
                $consulta->bindValue(':no_muestra_item', $this->no_muestra_item, PDO::PARAM_INT);
                $consulta->bindValue(':stock', $this->stock, PDO::PARAM_STR);
                $consulta->bindValue(':unid_pack_juego_tapa', $this->unid_pack_juego_tapa, PDO::PARAM_STR);
                $consulta->bindValue(':cant_kit', $this->cant_kit, PDO::PARAM_STR);
                $consulta->bindValue(':pack_venta', $this->pack_venta, PDO::PARAM_STR);
                $consulta->bindValue(':precio_lista', $this->precio_lista, PDO::PARAM_STR);
                $consulta->bindValue(':img_peq_url', $this->img_peq_url, PDO::PARAM_STR);
                $consulta->bindValue(':img_gde_url', $this->img_gde_url, PDO::PARAM_STR);
                $consulta->bindValue(':img_envase_url', $this->img_envase_url, PDO::PARAM_STR);
                $consulta->bindValue(':pdf_catalogo', $this->pdf_catalogo, PDO::PARAM_STR);
                $consulta->bindValue(':prioridad_busquedas', $this->prioridad_busquedas, PDO::PARAM_STR);
                $consulta->bindValue(':en_promocion', $this->en_promocion, PDO::PARAM_STR);
                $consulta->bindValue(':nuevo_lanzamiento', $this->nuevo_lanzamiento, PDO::PARAM_STR);
                $consulta->bindValue(':origen', $this->origen, PDO::PARAM_STR);
        
        return $consulta->execute();
    }
}

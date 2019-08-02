<?php
class articulos
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
			SELECT * FROM `articulos` WHERE 1   
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

    public static function read($id_producto){
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

    /*
    articulo
    articulos
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

    */

    public function create()
    {
        try {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            $consulta = $objetoAccesoDato->RetornarConsulta("
			INSERT INTO `productos`
				(`id_producto`,
				`id_sector`,
				`producto`,
                `tiempo_preparacion`,
                `id_sector`,
				`producto`,
                `tiempo_preparacion`,
                `id_sector`,
				`producto`,
                `tiempo_preparacion`,
                `id_sector`,
				`producto`,
                `tiempo_preparacion`,
                `tiempo_preparacion`,
                `precio`)
			VALUES (
				:id_producto,
				:id_sector,
				:producto,
				:tiempo_preparacion,
                :precio)
		");

            $consulta->bindValue(':id_producto', $this->id_producto, PDO::PARAM_STR);
            $consulta->bindValue(':id_sector', $this->id_sector, PDO::PARAM_STR);
            $consulta->bindValue(':producto', $this->producto, PDO::PARAM_STR);
            $consulta->bindValue(':tiempo_preparacion', $this->tiempo_preparacion, PDO::PARAM_INT);
            $consulta->bindValue(':precio', $this->precio, PDO::PARAM_INT);

            $consulta->execute();
        } catch (Exception $e) {
            $mensaje = $e->getMessage();
            $respuesta = array("Estado" => "ERROR", "Mensaje" => "$mensaje");
        } finally {
            return $objetoAccesoDato->RetornarUltimoIdInsertado();
        }
    }

    public static function delete($id_producto){
        try {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            $consulta = $objetoAccesoDato->RetornarConsulta("
                DELETE FROM `productos` 
                WHERE `id_producto` = '$id_producto'
            ");
            $consulta->bindValue(':id_producto', $id_producto, PDO::PARAM_STR);
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
                UPDATE `productos` 
                SET 
				`id_sector`=:id_sector, 
                `producto`=:producto, 
                `tiempo_preparacion`=:tiempo_preparacion, 
                `precio`=:precio
                WHERE id_producto=:id_producto");
                
                $consulta->bindValue(':id_producto', $this->id_producto, PDO::PARAM_STR);
                $consulta->bindValue(':id_sector', $this->id_sector, PDO::PARAM_STR);
                $consulta->bindValue(':producto', $this->producto, PDO::PARAM_STR);
                $consulta->bindValue(':tiempo_preparacion', $this->tiempo_preparacion, PDO::PARAM_INT);
                $consulta->bindValue(':precio', $this->precio, PDO::PARAM_INT);
        
        return $consulta->execute();
    }
}
